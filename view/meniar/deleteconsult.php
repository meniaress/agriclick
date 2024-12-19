<?php
include 'controllers\crudconsult.php';
$produitd = new Crudconsult();
$produitd->deleteconsult($_GET["id_consult"]);

header('Location:consult.php');

?>