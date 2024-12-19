<?php
include 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\Agriclickk\Front\Controller\crudconsult.php';
$produitd = new Crudconsult();
$produitd->deleteconsult($_GET["id_consult"]);

header('Location:consult.php');

?>