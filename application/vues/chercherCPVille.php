<?php

require_once '../../configs/mysql_config.class.php';
//require_once Chemins::CONFIGS . 'mysql_config.class.php';
require_once  '../modeles/gestion_boutique.class.php';
require_once  '../modeles/gestion_ville.class.php';
// Récupération du codepostal posté  

$recherche = strtolower($_GET["q"]);

if (!$recherche)
    return;
echo GestionVille::CPVille($recherche);
