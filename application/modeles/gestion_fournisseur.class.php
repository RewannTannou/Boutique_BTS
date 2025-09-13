<?php

//require_once '../../configs/mysql_config.class.php';
require_once 'ModelePDO.class.php';

Class GestionFournisseur extends ModelePDO{
   
    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    public static function getNbFornisseur() {
        return self::getNbTupleByTable('fournisseur');
    }
    
    public static function ajouter($nom,$rue,$cp,$ville,$tel,$email) {
        self::seConnecter();
        self::$requete = "insert into fournisseur(nom,rue,codePostal,ville,tel,email) values(:nom,:rue,:cp,:ville,:tel,:email)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->bindValue('rue', $rue);
        self::$pdoStResults->bindValue('cp', $cp);
        self::$pdoStResults->bindValue('ville', $ville);
        self::$pdoStResults->bindValue('tel', $tel);
        self::$pdoStResults->bindValue('email', $email);
        self::$pdoStResults->execute();
    }
    
    public static function supprimerByNom($nom) {
        self::seConnecter();
        self::$requete = "Delete FROM fournisseur WHERE nom = :nom";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->execute();
    }
    
    public static function supprimerById($idFournisseur) {
        self::seConnecter();
        self::$requete = "Delete FROM fournisseur WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idFournisseur);
        self::$pdoStResults->execute();
    }
    
    public static function modifierFournisseur($idAChanger,$nom,$rue,$cp,$ville,$tel,$email) {
        self::seConnecter();
        self::$requete = "update fournisseur set nom = :nom, rue = :rue, cp= :cp, ville = :ville , tel = :tel , email = :email WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idAChanger);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->bindValue('rue', $rue);
        self::$pdoStResults->bindValue('cp', $cp);
        self::$pdoStResults->bindValue('ville', $ville);
        self::$pdoStResults->bindValue('tel', $tel); 
        self::$pdoStResults->bindValue('email', $email); 
        self::$pdoStResults->execute();
    }
    public static function getLesFournisseur() {
        return self::getLesTuplesByTable("fournisseur");
    }
    
        // </editor-fold>
    
}
?>

