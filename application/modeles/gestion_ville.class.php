<?php

//require_once '../../configs/mysql_config.class.php';
require_once 'ModelePDO.class.php';

class GestionVille extends ModelePDO{

    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    public static function getNbVille() {
        return self::getNbTupleByTable('client');
    }

    public static function CPVille($recherche) {
        self::seConnecter();
        self::$requete = "select distinct CP,Ville from codespostaux where CP like'$recherche%' or ville like '$recherche%' order by CP";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch(PDO::FETCH_OBJ);
        while ($ligne = self::$pdoStResults->fetch()) {
            $cp = $ligne->CP;
            $ville = $ligne->Ville;
            echo "$cp - $ville|$cp|$ville\n";
        }
        self::$pdoStResults->closeCursor();
        // </editor-fold>  
    }

    // </editor-fold>   
}

?>
