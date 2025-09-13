<?php

Class ControleurAdmin {

    public function __construct() {
//    // si on séparait les modèles, le constructeur donnerait son chemin
//     require_once Chemins::MODELES.'gestion_admin.class.php';
    }

    public function afficherIndex() {
        if (isset($_SESSION['login_admin'])){
            $lesCategories = GestionCategorie::getLesCategories();
            $lesFournisseur = GestionFournisseur::getLesFournisseur(); 
            $lesProduits = GestionProduit::getLesProduits();
    
            require Chemins::VUES_ADMIN . 'v_index_admin.inc.php';
        }
        else {
            require Chemins::VUES_ADMIN . 'v_connexion.inc.php';
        }
    }
    

    public function verifierConnexion() {

        if (ModelePDO::isRegistered($_POST['login'], $_POST['passe'])) {
            $_SESSION['login'] = $_POST['login'];

            if (ModelePDO::isAdminOK($_POST['login'], $_POST['passe'])) {
                $_SESSION['login_admin'] = $_POST['login'];
                if (isset($_POST['connexion_auto'])) {
                    setcookie('login_admin', $_POST['login'], time() + 7 * 24 * 3600, '/', ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false, false, true);
                }
                require Chemins::VUES_ADMIN . 'v_index_admin.inc.php';
                return; // Assurez-vous de ne pas continuer l'exécution
            }

            header("Location: index.php"); // Rediriger vers l'index si l'utilisateur n'est ni admin ni super admin
            exit;
        } else {
            require_once Chemins::VUES . 'v_erreur404.inc.php';
        }
    }

    public function seDeconnecter() {
        // Suppression des variables de session et de la session

        $_SESSION = array();
        session_destroy();
        setcookie('login_admin', '');
        header("Location:index.php");
    }

//Rewann = marines95640*
//tannou = Marines
}
