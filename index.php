<?php

session_start(); // Pour éviter erreurs SESSIONS
ob_start(); // Pour éviter erreur COOKIES
//session_destroy();
//ini_set('display_errors', 0);
require_once 'configs/chemins.class.php';
require_once Chemins::CONFIGS . 'mysql_config.class.php';
require_once Chemins::MODELES . 'ModelePDO.class.php';
require_once Chemins::CONFIGS . 'variables_globales.class.php';
if (isset($_SESSION['login_admin'])) {
    // Inclure le menu admin
    require Chemins::VUES_PERMANENTES . 'v_header_admin.inc.php';
} else {
    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['login'])) {
        // Inclure le menu pour les utilisateurs connectés
        require Chemins::VUES_PERMANENTES . 'v_header_logs.inc.php';
    } else {
        // Inclure le menu par défaut pour les utilisateurs non connectés
        require Chemins::VUES_PERMANENTES . 'v_header.inc.php';
    }
}

require_once Chemins::CONTROLEURS . 'ControleurCategories.class.php';
require_once Chemins::CONTROLEURS . 'ControleurProduits.class.php';
require_once Chemins::MODELES . 'gestion_fournisseur.class.php';
require_once Chemins::MODELES . 'gestion_produit.class.php';
require_once Chemins::LIBS . 'Panier.class.php';

//Panier::detruire();
Panier::initialiser();
//Panier::vider();
//var_dump($_SESSION);

$controleurCategories = new ControleurCategories(); // Toujours instancier cela pour afficher les catégories

if (!isset($_REQUEST['controleur'])) {
    // Aucune action spécifiée, affichez la vue d'accueil
    $controleurCategories->afficher();
    $controleurProduits = new ControleurProduits();
    $controleurProduits->afficherProduitAccueil();
    require_once(Chemins::VUES . 'v_accueil.inc.php'); // Affichage de la vue d'accueil
} else {
    // Un contrôleur est spécifié
    if ($_REQUEST['controleur'] !== 'Admin') { // Évite d'appeler le menu de navigation pour la partie admin
        if ($_REQUEST['controleur'] !== 'Panier') {
            if ($_REQUEST['controleur'] !== 'Client') {
                $controleurCategories->afficher();
            }
        }
    }

    // Gestion dynamique du contrôleur
    $classeControleur = 'Controleur' . $_REQUEST['controleur']; // ex : ControleurProduits
    $fichierControleur = $classeControleur . ".class.php"; // ex : ControleurProduits.class.php
    require_once(Chemins::CONTROLEURS . $fichierControleur);

    // Vérifiez si l'action est définie
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action']; // ex : afficher
        $objetControleur = new $classeControleur(); // ex : $objetControleur = new ControleurProduits();
        // Vérifiez que l'action existe dans le contrôleur
        if (method_exists($objetControleur, $action)) {
            $objetControleur->$action(); // ex : $objetControleur->afficher();
        } else {
            // Gérer le cas où l'action n'existe pas
            echo "Action non valide : " . htmlspecialchars($action);
        }
    } else {
        // Gérer le cas où aucune action n'est spécifiée
        echo "Aucune action spécifiée.";
    }
}
require Chemins::VUES_PERMANENTES . 'v_pied.inc.php'; // Footer commun
