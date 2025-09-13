<?php
//require_once '../../configs/mysql_config.class.php';
// Inclusion du fichier de configuration de la base de données (commenté ici)
require_once 'ModelePDO.class.php'; // Inclusion de la classe de gestion de la boutique

class GestionClient extends ModelePDO{
    
    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    // Méthode statique pour obtenir le nombre total de clients dans la table "client"
    public static function getNbClients() {
        return self::getNbTupleByTable('client');
    }

    // Méthode statique pour vérifier si un login est valide (existe dans la base)
    public static function PseudoValide($login){
        self::seConnecter(); // Connexion à la base de données

        // Requête pour rechercher un login précis dans la table "client"
        self::$requete = "Select login FROM client WHERE login like '" . $login ."'";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor(); // Fermeture du curseur de requête

        return self::$resultat; // Retourne le résultat de la requête
    }

    // Méthode statique pour ajouter un nouveau client dans la base
    public static function ajouter($nom, $prenom, $rue, $cp, $ville, $tel, $email, $login, $mdp) {
        self::seConnecter(); // Connexion à la base de données
        
        // Requête d'insertion avec des paramètres liés
        self::$requete = "insert into client(nom,prenom,rue,codePostal,ville,tel,email,login,mdp) values(:nom,:prenom,:rue,:cp,:ville,:tel,:email,:login,:mdp)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        
        // Liaison des paramètres à leurs valeurs
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->bindValue('prenom', $prenom);
        self::$pdoStResults->bindValue('rue', $rue);
        self::$pdoStResults->bindValue('cp', $cp);
        self::$pdoStResults->bindValue('ville', $ville);
        self::$pdoStResults->bindValue('tel', $tel);
        self::$pdoStResults->bindValue('email', $email);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('mdp', sha1($mdp)); // Hash du mot de passe avec SHA-1
        self::$pdoStResults->execute(); // Exécution de la requête
    }

    // Méthode statique pour supprimer un client par son nom
    public static function supprimerByNom($nom) {
        self::seConnecter(); // Connexion à la base de données
        
        // Requête de suppression par nom
        self::$requete = "Delete FROM client WHERE nom = :nom";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->execute(); // Exécution de la requête
    }

    // Méthode statique pour supprimer un client par son ID
    public static function supprimerById($idClient) {
        self::seConnecter(); // Connexion à la base de données
        
        // Requête de suppression par ID
        self::$requete = "Delete FROM client WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idClient);
        self::$pdoStResults->execute(); // Exécution de la requête
    }

    // Méthode statique pour modifier les informations d'un client
    public static function modifierClient($idAChanger, $nom, $rue, $cp, $ville, $tel, $email) {
        self::seConnecter(); // Connexion à la base de données
        
        // Requête de mise à jour des informations du client
        self::$requete = "update client set nom = :nom, rue = :rue, cp= :cp, ville = :ville , tel = :tel , email = :email WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        
        // Liaison des paramètres à leurs valeurs
        self::$pdoStResults->bindValue('id', $idAChanger);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->bindValue('rue', $rue);
        self::$pdoStResults->bindValue('cp', $cp);
        self::$pdoStResults->bindValue('ville', $ville);
        self::$pdoStResults->bindValue('tel', $tel); 
        self::$pdoStResults->bindValue('email', $email); 
        self::$pdoStResults->execute(); // Exécution de la requête
    }
    public static function getClientByLog()
    {
        self::seConnecter(); // Connexion à la base de données
        
        // Requête pour obtenir les informations d'un client par son login
        self::$requete = "Select id FROM client WHERE login = :login";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $_SESSION['login']);
        self::$pdoStResults->execute(); // Exécution de la requête
        $client = self::$pdoStResults->fetch(); // Récupération du résultat
        
        return $client; // Retourne le client trouvé
    }

    // </editor-fold>   
}
?>
