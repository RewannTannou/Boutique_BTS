<?php

class ControleurCategories {

    public function __construct() {
// si on séparait les modèles, le constructeur donnerait son chemin
 require_once Chemins::MODELES.'gestion_categorie.class.php';
    }

    public function afficher() {
        VariablesGlobales::$lesCategories = GestionCategorie::getLesCategories();
        require Chemins::VUES_PERMANENTES . 'v_menu.inc.php';
    }

    public function ajouterCategorie() {

        // Récupérer la valeur du champ nom_categorie du formulaire
        // Récupérez les données du formulaire

        $nomCategorie = $_POST["nom"];

        // Appeler la méthode pour ajouter la catégorie
        GestionCategorie::ajouter($nomCategorie);

        header('Location: index.php');
    }

    public function modifierCategorie() {

        $nouveauNom = $_POST["nouveau_nom_categorie"];

        $CategorieModifier = $_POST["categorie_a_modifier"];

        GestionCategorie::modifierCategorie($CategorieModifier,$nouveauNom );

        header('Location: index.php');
    }

    public function supprimer() {

        $nomCategoriesupprimer = $_POST["categorie_a_supprimer"];

        GestionCategorie::supprimerById($nomCategoriesupprimer);

        header('Location: index.php');
    }
}

?>
