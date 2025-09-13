<?php

//require_once '../../configs/mysql_config.class.php';
require_once 'ModelePDO.class.php';

Class GestionCategorie extends ModelePDO{
   
    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    public static function getNbCategorie() {
        return parent::getNbTupleByTable('Categorie');
    }
    
    public static function ajouter($libelleCateg) {
        self::seConnecter();
        self::$requete = "insert into categorie(libelle) values(:libelle)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
    }
    
    public static function supprimerByLibelle($libelleCateg) {
        self::seConnecter();
        self::$requete = "Delete FROM categorie WHERE libelle = :libelle";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
    }
    
    public static function supprimerById($idCateg) {
        self::seConnecter();
        self::$requete = "Delete FROM categorie WHERE id_Categorie = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idCateg);
        self::$pdoStResults->execute();
    }
    
    public static function modifierCategorie($idCategorieAChanger,$libelleCateg) {
        self::seConnecter();
        self::$requete = "update categorie set libelle = :libelle WHERE id_Categorie = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->bindValue('id', $idCategorieAChanger);
        self::$pdoStResults->execute();
    }
    public static function getLesCategories() {
        
        return self::getLesTuplesByTable("categorie");
    }
   
        // </editor-fold>
    
}
?>

