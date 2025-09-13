<?php

//require_once '../../configs/mysql_config.class.php';
require_once 'ModelePDO.class.php';

class GestionLigneDeCommande extends ModelePDO{
    
 // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">
 
    
    public static function ajouter($idCommande, $idProduit, $quantite) {
        self::seConnecter();
        self::$requete = "insert into lignedecommande(idCommande,idProduit,quantite) values(:idCommande,:idProduit,:quantite)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('quantite', $quantite);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->bindValue('idProduit', $idProduit);
        self::$pdoStResults->execute();
    }
    
    public static function supprimer($idCommande) {
        self::seConnecter();
        self::$requete = "Delete FROM lignedecommande WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idCommande);
        self::$pdoStResults->execute();
    }
    
    public static function modifierLigneCommande($idAChanger,$quantite) {
        self::seConnecter();
        self::$requete = "update lignedecommande set quantite = :quantite WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('quantite', $quantite);
        self::$pdoStResults->bindValue('id', $idAChanger);
        self::$pdoStResults->execute();
    }
    
// </editor-fold>   

    
}
?>
