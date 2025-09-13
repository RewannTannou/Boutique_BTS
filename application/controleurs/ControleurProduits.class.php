<?php

class ControleurProduits
{

    public function __construct()
    {
        // si on séparait les modèles, le constructeur donnerait son chemin
        require_once Chemins::MODELES . 'gestion_produit.class.php';
    }

    public function afficher()
    {
        VariablesGlobales::$libelleCategorie = $_REQUEST['categorie'];
        VariablesGlobales::$lesProduits = GestionProduit::getLesProduitsByCateg($_REQUEST['categorie']);
        require Chemins::VUES . 'v_produits.inc.php';
    }

    public function afficherProduitAccueil()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Récupère la page actuelle (par défaut 1)
        $limit = 3; // Nombre de produits par page
        $totalPages = ModelePDO::getTotalPages('produit', $limit);

        VariablesGlobales::$lesProduits = ModelePDO::getLesTuplesByTableWithPagination('produit', $limit, $page);

        require Chemins::VUES . 'v_accueil.inc.php';
    }

    public function getProduitByid($idProduit)
    {
        GestionProduit::getLeProduitsByID($idProduit);
    }

    public function ajouterProduit()
    {

        // Récupérer la valeur du champ nom_categorie du formulaire
        // Récupérez les données du formulaire
        try {
            $nomProduit = $_POST["nom"];
            $description = $_POST["description"];
            $prix = $_POST["prix"];
            $image = $_POST["image"];
            $Categorie = $_POST["categorie_produit"];
            $Fournisseur = $_POST["fournisseur"];

            // Appeler la méthode pour ajouter le Produit
            GestionProduit::ajouter($nomProduit, $description, $prix, $image, $Categorie, $Fournisseur);

            header('Location: index.php');
        } catch (Exception $e) {
            $messageErreur = $e->getMessage(); // Récupère le message du trigger
            require_once Chemins::VUES . 'v_message_erreur.inc.php'; // Vue d'affichage
        }
    }

    public function ajouterProduitPanier()
    {
        Panier::initialiser();

        //      $qte = intval($_POST['quantite']);
        $qte = $_POST['quantite'];
        $idProduit = $_POST['id'];

        Panier::ajouterProduit($idProduit, $qte);

        header('Location: index.php');
    }

    public function modifierProduit()
    {


        $produitModifier = $_POST["produit_a_modifier"];
        $nouveauNom = $_POST["nouveau_nom_produit"];
        $description = $_POST["descrption_produit"];
        $prix = $_POST["prix_produit"];
        $image = $_POST["image_produit"];
        $Categorie = $_POST["categorie_produit_a_modifier"];
        $Fournisseur = $_POST["fournisseur_a_modifier"];

        GestionProduit::modifierProduit($produitModifier, $nouveauNom, $description, $prix, $image, $Categorie, $Fournisseur);

        header('Location: index.php');
    }
    public function rechercher()
    {
        $recherche = $_POST["search-bar"];
        VariablesGlobales::$lesProduitsRecherches = GestionProduit::getTupleByNom('produit', $recherche);
        require Chemins::VUES . 'v_produit_Recherche.inc.php';
    }
    public function getProductDetails()
    {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            header('Location: index.php'); // redirection vers l'accueil si ce n'est pas AJAX
            exit();
        }

        // Efface le tampon de sortie pour éviter tout contenu non désiré
        ob_clean();

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $idProduit = intval($_POST['id']);

            // Supposons que ta méthode récupère le produit par son ID
            $produit = GestionProduit::getLeProduitsByID($idProduit);

            // Vérifie si le produit a été trouvé
            if ($produit) {
                header('Content-Type: application/json'); // Définir le type de contenu
                echo json_encode([
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'description' => $produit->description,
                    'prix' => $produit->prix,
                    'image' => $produit->image,
                    'idCategorie' => $produit->idCategorie,
                    'idFournisseur' => $produit->idFournisseur
                ]);
                exit(); // Assure-toi de terminer le script après l'envoi de la réponse
            } else {
                // Produit non trouvé
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Produit non trouvé']);
                exit();
            }
        } else {
            // ID manquant
            header('Content-Type: application/json');
            echo json_encode(['error' => 'ID du produit manquant']);
            exit();
        }
    }

    public function supprimerProduit()
    {

        $nomProduitsupprimer = $_POST["produit_a_supprimer"];

        GestionProduit::supprimerById($nomProduitsupprimer);

        header('Location: index.php');
    }
}
