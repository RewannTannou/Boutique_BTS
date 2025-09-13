<?php
//require_once '../../configs/mysql_config.class.php';
require_once 'ModelePDO.class.php'; 

class GestionCommande extends ModelePDO{
    
 // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">
 
    public static function getNbCommandes() {
        return self::getNbTupleByTable('commande');
    }
    
    public static function ajouter($idClient) {
        date_default_timezone_set('Europe/Paris');
        $today = date("Y-m-d"); // Format correct : ex. 2025-04-29
    
        self::seConnecter();
        self::$requete = "INSERT INTO commande(date, idClient) VALUES(:date, :idClient)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('date', $today);
        self::$pdoStResults->bindValue('idClient', $idClient);
        self::$pdoStResults->execute();
    }
    
    
    public static function supprimerById($idCommande) {
        self::seConnecter();
        self::$requete = "Delete FROM commande WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idCommande);
        self::$pdoStResults->execute();
    }
    
    public static function modifierCommande($idAChanger,$date,$idClient) {
        self::seConnecter();
        self::$requete = "update commande set date = :date , idClient = :idClient WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idAChanger);
        self::$pdoStResults->bindValue('date', $date); 
        self::$pdoStResults->bindValue('idClient', $idClient); 
        self::$pdoStResults->execute();
    }
    public static function getMaxIdCommande() {
        self::seConnecter();
        self::$requete = 'Select Max(id) as id From commande ';
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        $result = self::$pdoStResults->fetch(PDO::FETCH_ASSOC);
        return $result['id']; // retourne directement l'ID
    }
    
    
// </editor-fold>   

    
}
?>

