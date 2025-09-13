<?php

class ModelePDO {

// <editor-fold defaultstate="collapsed" desc="Champs statiques"> 
//Attributs utiles pour la connexion
    protected static $serveur = MySqlConfig::SERVEUR;
    protected static $base = MySqlConfig::BASE;
    protected static $utilisateur = MySqlConfig::UTILISATEUR;
    protected static $passe = MySqlConfig::MOT_DE_PASSE;
//Attributs utiles pour la manipulation PDO de la BD
    protected static $pdoCnxBase = null;
    protected static $pdoStResults = null;
    protected static $requete = "";
    protected static $resultat = null;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Méthodes statiques">
    protected static function seConnecter() {
        if (!isset(self::$pdoCnxBase)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host=' . self::$serveur . ';dbname=' . self::$base, self::$utilisateur,
                        self::$passe);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoCnxBase->query("SET CHARACTER SET utf8"); //méthode de la classe PDO
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // méthode de la classe Exception
            }
        }
    }

    protected static function seDeconnecter() {
        self::$pdoCnxBase = null;
        // Si on n'appelle pas la méthode, la déconnexion a lieu en fin de script
    }

    protected static function getLesTuplesByTable($table) {
        self::seConnecter();
        self::$requete = "SELECT * FROM " . $table;
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStResults->closeCursor();
        return self::$resultat;
    }

    public static function getLeTupleTableById($table, $id) {
        self::seConnecter();
        self::$requete = "Select * FROM $table WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }
    public static function getLesTuplesByTableWithPagination($table, $limit, $page) {
        self::seConnecter();
    
        $offset = ($page - 1) * $limit; // Calcul de l'OFFSET pour paginer les résultats
    
        self::$requete = "SELECT * FROM $table  LIMIT :limit OFFSET :offset";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
    
        // Sécurisation des variables
        self::$pdoStResults->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        self::$pdoStResults->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll(PDO::FETCH_OBJ);
    
        self::$pdoStResults->closeCursor();
    
        return self::$resultat;
    }
    public static function getTotalPages($table, $limit) {
        self::seConnecter();
        self::$requete = "SELECT COUNT(*) as total FROM " . htmlspecialchars($table);
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        $row = self::$pdoStResults->fetch(PDO::FETCH_ASSOC);
        $totalPages = ceil($row['total'] / $limit);
        return $totalPages;
    }
    
    public static function getTupleByNom($table, $rechercher) {
        self::seConnecter();
        self::$requete = "SELECT * FROM " . $table . "  WHERE nom LIKE :rechercher"; 
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        
        // Ajoute les % directement ici
        self::$pdoStResults->bindValue(':rechercher', "%$rechercher%", PDO::PARAM_STR);
        
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll(PDO::FETCH_OBJ);
        self::$pdoStResults->closeCursor();
        
        return self::$resultat;
    }
    
    

    protected static function getPremierTupleByChamp($table, $nomChamp, $valeurChamp) {
        self::seConnecter();
        self::$requete = "SELECT * FROM " . $table . " WHERE " . $nomChamp . " = :valeurChamp";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue(':valeurChamp', $valeurChamp);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch(PDO::FETCH_OBJ);
        self::$pdoStResults->closeCursor();
        return self::$resultat; //un seul tuple retourné : utilisation de fetch()
    }

    protected static function getNbTupleByTable($table) {
        self::seConnecter();
        self::$requete = "SELECT Count(*) AS nbTuples FROM $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat->nbTuples;
    }

    protected static function supprimerTupleByChamp($table, $nomChamp, $valeurChamp) {
        self::seConnecter();
        self::$requete = "Delete FROM " . $table . " WHERE " . $nomChamp . " = :valeurChamp";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue(':valeurChamp', $valeurChamp);
        self::$pdoStResults->execute();
    }

    protected static function modifier($table, $nomChamp, $valeurChamp, $conditionChamp, $conditionValeur) {
        self::seConnecter();
        self::$requete = "UPDATE $table SET $nomChamp = :valeurChamp WHERE $conditionChamp = :conditionValeur";
        var_dump(self::$requete);
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue(':valeurChamp', $valeurChamp);
        self::$pdoStResults->bindValue(':conditionValeur', $conditionValeur);
        self::$pdoStResults->execute();
    }

    public static function isRegistered($login, $passe) {
        self::seConnecter();
        self::$requete = "SELECT * FROM client where login =:login and mdp =:passe";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('passe', sha1($passe));
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();

        return (self::$resultat != null);
    }

    protected static function execute($requete) {
        self::seConnecter();
        self::$requete = $requete;
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat->execute();
    }

    protected static function select($requete) {
        self::seConnecter();
        self::$requete = $requete;
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat->execute();
    }

    public static function isAdminOk($login, $passe) {
        self::seConnecter();

        self::$requete = "SELECT * FROM client where login=:login and mdp=:mdp";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('mdp', sha1($passe));

        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();

        if ((self::$resultat != null) and (self::$resultat->isAdmin)) {
            return true;
        } else {
            return false;
        }
    }
    // </editor-fold>
}
?>

