<!DOCTYPE html>
<!-- TITRE ET MENUS -->
<html lang="fr">


<title>REEVERRS BOUTIQUE</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo Chemins::STYLES . 'style.css'; ?>" rel="stylesheet"
    type="text/css">
<link href="<?php echo Chemins::STYLES . "styleform.css"; ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
<link rel="shortcut icon" type="image/jpeg" href="<?php
                                                    echo Chemins::IMAGES .
                                                        'logo.png';
                                                    ?>">
<!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type='text/javascript' src="<?php echo Chemins::JS . "jquery.autocomplete.js"; ?>"></script>
<script type="text/javascript" src="<?php echo Chemins::JS . "jquery.browser.js"; ?>"></script>



</head>

<body>
    <header>
        <!-- Images En-tête -->
        <div class="titre_pricipale">
            <a href="index.php"><img src="<?php echo Chemins::IMAGES . 'logo.jpeg'; ?>"
                    alt="ZiK'nCo" title="Revenir à l'accueil" /></a>
            <h1> REEVERRS BOUTIQUE </h1>
        </div>
        <form method="POST" action="index.php?controleur=Produits&action=rechercher" class="form_search">
            <div class="search-container">
                <i class="fas fa-search"></i> <!-- Icône de recherche -->
                <label for="search-bar" style="display: none;"></label>
                <input type="text" id="search-bar" name="search-bar" placeholder="Rechercher">
            </div>
        </form>

        <!-- Menu haut-->
        <nav id="menu_haut">
            <ul>

                <li><a href="index.php"> Accueil </a></li>
                <li><a href="index.php?controleur=Panier&action=afficherPanier"> Voir le panier </a></li>
                <li><a href="https://www.instagram.com/rewann_rtn/"> Nous contacter </a></li>
                <li><a href="index.php?controleur=Client&action=afficherSeConnecter"> Se connecter</a></li>
                <li><button id="darkModeToggle">🌙 Mode sombre</button></li>
            </ul>
        </nav>
    </header>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const darkModeToggle = document.getElementById("darkModeToggle");

            // Vérifie si le mode sombre est activé au démarrage
            if (localStorage.getItem("darkMode") === "enabled") {
                document.body.classList.add("dark-mode");
                darkModeToggle.textContent = "☀️ Mode clair"; // Texte du bouton en mode sombre
            }

            // Ajoute un écouteur d'événement pour changer le mode
            darkModeToggle.addEventListener("click", () => {
                document.body.classList.toggle("dark-mode");

                // Change le texte du bouton en fonction du mode
                if (document.body.classList.contains("dark-mode")) {
                    darkModeToggle.textContent = "☀️ Mode clair"; // Texte pour passer au mode clair
                    localStorage.setItem("darkMode", "enabled");
                } else {
                    darkModeToggle.textContent = "🌙 Mode sombre"; // Texte pour passer au mode sombre
                    localStorage.setItem("darkMode", "disabled");
                }
            });
        });
    </script>