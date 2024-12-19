<?php
include '../../controllers/crud.php';
$produitd = new CrudAnimals();
$produitd->deleteAnimals($_GET["id_animal"]);

header('Location:animal.php');

?>