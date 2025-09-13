<?php
require_once Chemins::MODELES . 'ModelePDO.class.php';
require_once Chemins::MODELES . 'gestion_client.class.php';
require_once Chemins::MODELES . 'gestion_commande.class.php';
require_once Chemins::MODELES . 'gestion_lignedecommande.class.php';
Class ControleurPanier {

    public function __construct() {
// si on séparait les modèles, le constructeur donnerait son chemin

    }

    public function afficherPanier() {
        VariablesGlobales::$lesProduitsPaniers = Panier::getProduits();
        $idProduit = 0;
        $unProduit = GestionProduit::getLeProduitsByID($idProduit);
        require Chemins::VUES . 'v_panier.inc.php';
    }
    public function retirerProduitsPanier(){
        $idProduit =  $_POST['id'];
        Panier::retirerProduit($idProduit);
        if($_SESSION['produits']== null){
            Panier::detruire();
        }
        header("Location:index.php?controleur=Panier&action=afficherPanier");
    }
    public function validerCommande(){
        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['login'])) {
            // Redirige vers la page de connexion ou affiche une erreur
            header("Location: index.php?controleur=Client&action=afficherSeConnecter");
            exit;
        }
    
        $idClient = GestionClient::getClientByLog();
        GestionCommande::ajouter(strval($idClient->id));
        $idCommande = GestionCommande::getMaxIdCommande();
        
        foreach ($_SESSION['produits'] as $idProduit => $quantite) {
            GestionLigneDeCommande::ajouter($idCommande, $idProduit, $quantite);    
        }
    
        Panier::detruire();
        header("Location: index.php?controleur=Panier&action=afficherMessageCommande");
        exit;
    }
    
    public function afficherMessageCommande(){
        require Chemins::VUES . 'v_confirmationCommande.php';
    }

   
}
