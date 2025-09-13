<?php

Class ControleurClient {

    public function __construct() {
// si on séparait les modèles, le constructeur donnerait son chemin
require_once Chemins::MODELES.'gestion_client.class.php';
    }

    public function afficherSeConnecter() {

        require Chemins::VUES . 'v_connexionCompte.inc.php';
    }

    public  function inscriptionClient() {
        require Chemins::VUES . 'v_inscriptionClient.inc.php';
    }

    public function cherchepseudo() {
        if (isset($_POST['login'])) {
            // Récupération et validation du pseudo
            $loginSaisi = trim($_POST['login']);

            // Validation simple
            if (empty($loginSaisi)) {
                echo "0"; // Le pseudo est vide
                exit;
            }

            // Vérifie que la requête est bien une requête AJAX
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
                header('Location: index.php'); // Redirection si ce n'est pas AJAX
                exit;
            }

            // Efface le tampon de sortie pour éviter tout contenu non désiré
            ob_clean();

            // Vérification du pseudo
            $login = GestionClient::PseudoValide($loginSaisi);

            // Vérifie si le pseudo est valide
            if ($login) {
                echo "1"; // Le pseudo est valide, on renvoie 1
            } else {
                echo "0"; // Le pseudo n'est pas valide, on renvoie 0
            }
            exit(); // Terminer le script
        } else {
            echo "0"; // Si le pseudo n'est pas défini
            exit;
        }

        // Redirection par défaut si jamais cette partie est atteinte (normalement inutile)
        // (Removed unreachable code)
    }

    public static function enregistrerClient() {
        $nom = $_POST['nom'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $email = $_POST['email'];
        $codePostal = $_POST['codePostal'];
        $ville = $_POST['ville'];
        $rue = $_POST['rue'];
        $tel = $_POST['tel'];
        $prenom = $_POST['prenom'];

        GestionClient::ajouter($nom, $prenom, $rue, $codePostal, $ville, $tel, $email, $login, $mdp);
        header('Location : index.php');
    }
    public function seDeconnecter() {
        // Suppression des variables de session et de la session

        $_SESSION = array();
        session_destroy();
        setcookie('login_admin', '');
        header("Location:index.php");
    }
}
  
