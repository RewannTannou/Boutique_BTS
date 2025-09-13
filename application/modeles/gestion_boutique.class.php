<?php

//require_once '../../configs/mysql_config.class.php';
require_once 'gestion_client.class.php';
require_once 'gestion_commande.class.php';
require_once 'gestion_categorie.class.php';
require_once 'gestion_fournisseur.class.php';
require_once 'gestion_lignedecommande.class.php';
require_once 'gestion_produit.class.php';

class GestionBoutique {
    // <editor-fold defaultstate="collapsed" desc="Champs statiques"> 

    /**
     * Objet de la classe PDO
     * @var PDO
     */
    public static $pdoCnxBase = null;

    /**
     * Objet de la classe PDOStatement
     * @var PDOStatement
     */
    public static $pdoStResults = null;
    public static $requete = ""; //texte de la requête
    public static $resultat = null; //résultat de la requête

    // </editor-fold>
    // 
    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    /**
     * Permet de se connecter à la base de données
     */
    public static function seConnecter() {
        if (!isset(self::$pdoCnxBase)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host=' . MysqlConfig::SERVEUR . ';dbname=' . MysqlConfig::BASE, MysqlConfig::UTILISATEUR, MysqlConfig::MOT_DE_PASSE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoCnxBase->query("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                // l’objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // méthode de la classe Exception
            }
        }
    }

    

    public static function seDeconnecter() {
        self::$pdoCnxBase = null; //base a null donc déconnecter
    }

    public static function getLesTuplesByTable($table) {
        self::seConnecter();

        self::$requete = "Select * FROM $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

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

    public static function getNbTupleByTable($table) {
        self::seConnecter();
        self::$requete = "SELECT Count(*) AS nbTuples FROM $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat->nbTuples;
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

    // </editor-fold>
}
?>

<?php

//GestionCategorie::ajouter('carte mère');18
//GestionCategorie::ajouter('carte graphique');19
//GestionCategorie::ajouter('RAM');20
//GestionCategorie::ajouter('processeur');21
//GestionCategorie::ajouter('boitier');22
//GestionCategorie::ajouter('alimentation');23
////GestionCategorie::supprimerById('1');
//GestionFournisseur::ajouter('José', '32 bis rue Avignon', 38000, 'Ragnaroc', '0650885566', 'José.rodrigez@gmail.com');3
//GestionFournisseur::ajouter('Dore', '2 Avenue Fabre', 91500, 'Saint-Gregoire du puit', '0785664125', 'Dore.entreprise@gmail.com');4
//GestionFournisseur::ajouter('Valentino', '5 rue de l apotre', 75030, 'Geneve', '0785654525', 'Valent.mail@gmail.com');5
//GestionClient::ajouter('Rodriguez', '6 rue de maldive', 45060, 'Mont-Part', '0750422686', 'Rodriguez@gmail.com');5
//GestionClient::ajouter('Dupont', '22 avenue des Tulipes', 75015, 'Paris', '0635874125', 'dupont@gmail.com');6
//GestionClient::ajouter('Martin', '10 rue Bonaparte', 69001, 'Lyon', '0658741203', 'martin@gmail.com');7
//GestionClient::ajouter('Petit', '8 chemin de la Meunière', 31000, 'Toulouse', '0645892571', 'petit@gmail.com');8
//GestionClient::ajouter('Dubois', '5 place de la République', 44000, 'Nantes', '0687451289', 'dubois@gmail.com');9 
//GestionClient::ajouter('Lefebvre', '12 avenue du Général de Gaulle', 59000, 'Lille', '0658741352', 'lefebvre@gmail.com');10
//GestionClient::ajouter('Robert', '14 rue Victor Hugo', 13002, 'Marseille', '0678529631', 'robert@gmail.com');11
//GestionClient::ajouter('Moreau', '9 boulevard Saint-Michel', 75005, 'Paris', '0658749012', 'moreau@gmail.com');12
//GestionClient::ajouter('Simon', '25 chemin de la Fontaine', 67000, 'Strasbourg', '0687451296', 'simon@gmail.com');13
//GestionClient::ajouter('Leroy', '2 rue des Primevères', 35000, 'Rennes', '0678456032', 'leroy@gmail.com');14
//GestionClient::ajouter('Laurent', '18 avenue de la Libération', 69003, 'Lyon', '0698475102', 'laurent@gmail.com');15
//GestionClient::ajouter('Garcia', '7 rue de la Paix', 75001, 'Paris', '0658743021', 'garcia@gmail.com');16
//GestionClient::ajouter('Roux', '15 boulevard du Temple', 69002, 'Lyon', '0698657412', 'roux@gmail.com');17
//GestionClient::ajouter('Marchand', '3 rue du Commerce', 44000, 'Nantes', '0658743026', 'marchand@gmail.com');18
//GestionClient::ajouter('Sanchez', '20 avenue des Champs-Élysées', 75008, 'Paris', '0698574130', 'sanchez@gmail.com');19
//GestionCommande::ajouter(5);
//GestionCommande::ajouter(15);
//GestionCommande::ajouter(10);
//GestionCommande::ajouter(14);
//GestionCommande::ajouter(13);
//GestionCommande::ajouter(8);
//GestionCommande::ajouter(15);
//GestionCommande::ajouter(16);
//GestionProduit::ajouter('Carte graphique 4070', '16Go ram, MSI', 549.99, 'image_cartegraphique.jpg', 19, 3);
//GestionProduit::ajouter('Ryzen 7 5800x', 'Processeur AMD Ryzen 7 5800X Socket AM4 (3,8 Ghz) (sans iGPU) ,Noir ', 216.19, 'image_processeur', 21, 3);
//GestionProduit::ajouter('Corsair Vengeance RGB PRO', 'Corsair Vengeance RGB PRO - Kit de Mémorie Enthousiaste (16Go (2x8Go), DDR4, 3200MHz, C16, XMP 2.0) - Noir ', 54.99, 'image_ram.jpg', 20, 4);
//GestionProduit::ajouter('MSI MPG B550 Gaming', 'MSI MPG B550 Gaming Plus Carte Mère ATX - pour Processeurs AMD Ryzen 3ème Gén., AM4, DDR4 Boost (4400MHz/OC), 1x PCIe 4.0/3.0 x16, 1x PCIe 3.0 x16, 1x M.2 Gen4 x4, 1x M.2 Gen3 x4, LAN Gigabit, Noir ', 131.59, 'image_cartemere.jpg',18, 5);
//GestionProduit::ajouter('MSI MAG A750GL', 'MSI MAG A750GL PCIE5 Bloc d alimentation, 750W 80 Plus Gold, Entièrement modulaire, ATX 3.0, Supporte GPU PCIe 5.0, Ventilateur FDB 120mm, LLC Full-Bridge, Câbles Plats Noirs ',107.95 , 'image_alimentation', 23, 3);
//GestionProduit::ajouter('AMANSON Boitier PC', 'AMANSON Boitier PC- avec 9 Ventilateurs ARGB pré-installés, Boitier de Jeu ATX Mid Tower avec Double Verre trempé Full View Boitier d ordinateur, H09,Noir', 99.99, 'image_boitier.jpg', 22, 5);
//GestionLigneDeCommande::ajouter(17, 17, 2);
//GestionLigneDeCommande::ajouter(18, 18, 1);
//GestionLigneDeCommande::ajouter(19, 18, 1);
//GestionLigneDeCommande::ajouter(20, 19, 1);
//GestionLigneDeCommande::ajouter(21, 22, 1);
//GestionLigneDeCommande::ajouter(22, 20, 1);
//GestionLigneDeCommande::ajouter(23, 20, 1);
//GestionLigneDeCommande::ajouter(24, 21, 1);
?>