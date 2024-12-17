<?php
include '../controllers/OffreC.php';

$message = "";
$OffreC = new OffreC();
$OffreC->supprimerOffre($_GET["idOffre"]);
header('Location:indexcategorie.php?message=Offre Supprimée avec succès');
?>