<?php

//require_once '../../configs/mysql_config.class.php';
require_once 'ModelePDO.class.php';

class GestionProduit extends ModelePDO{
    
 // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">
 
    public static function getNbProduit() {
        return self::getNbTupleByTable('produit');
    }
    
    public static function ajouter($nomProduit,$descriptionProduit,$prix,$image,$idcateg,$idfournisseur) {
        self::seConnecter();
        self::$requete = "insert into produit(nom,description,prix,image,idCategorie,idFournisseur) values(:nom ,:description, :prix, :image, :idCategorie, :idFournisseur) ";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('nom', $nomProduit);
        self::$pdoStResults->bindValue('description', $descriptionProduit);
        self::$pdoStResults->bindValue('prix', $prix);
        self::$pdoStResults->bindValue('image', $image);
        self::$pdoStResults->bindValue('idCategorie', $idcateg);
        self::$pdoStResults->bindValue('idFournisseur', $idfournisseur);
        self::$pdoStResults->execute();
    }
    
    public static function supprimerById($idProduit) {
        self::seConnecter();
        self::$requete = "Delete FROM produit WHERE id = :id ";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idProduit);
        self::$pdoStResults->execute();
    }
    
    public static function modifierProduit($idProduitAChanger,$nomProduit,$descriptionProduit,$prix,$image,$idCategorie,$idFournisseur) {
        self::seConnecter();
        self::$requete = "update produit set nom = :nom , description = :description , prix = :prix , image = :image , idCategorie = :idCategorie, idFournisseur = :idFournisseur WHERE id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idProduitAChanger);
        self::$pdoStResults->bindValue('nom', $nomProduit);
        self::$pdoStResults->bindValue('description', $descriptionProduit);
        self::$pdoStResults->bindValue('prix', $prix);
        self::$pdoStResults->bindValue('image', $image);
        self::$pdoStResults->bindValue('idCategorie', $idCategorie);
        self::$pdoStResults->bindValue('idFournisseur', $idFournisseur);
        self::$pdoStResults->execute();
    }
    
    public static function getLesProduitsByCateg($libelleCategorie){
        self::seConnecter();
        
        self::$requete = "SELECT * FROM produit P,categorie C WHERE P.idCategorie = C.id 
                            AND libelle = :libCateg";
        
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libCateg', $libelleCategorie);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();
        
        self::$pdoStResults->closeCursor();
        
        return self::$resultat;
    }
    public static function getLesProduits(){
        return self::getLesTuplesByTable('produit');
        
    }
    public static function getLeProduitsByID($id){
        return parent::getLeTupleTableById('produit',$id);
    }
    public static function getLesProduitsWithLimit($Limit,$offset){
        return parent::getLesTuplesByTableWithPagination('produit',$Limit,$offset);
    }




// </editor-fold>   

    
}
?>