<?php
require_once  '../../../configs/mysql_config.class.php';
require_once  '../../modeles/ModelePDO.class.php';
require_once  '../../modeles/gestion_client.class.php';
// Récupération du pseudo posté
$pseudoSaisi= $_POST['login'];
echo GestionClient::PseudoValide($pseudoSaisi);
?>

