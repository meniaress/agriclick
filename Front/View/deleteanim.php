<?php
include 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\agriclick-v2\Front\Controller\crud.php';
$produitd = new CrudAnimals();
$produitd->deleteAnimals($_GET["id_animal"]);

header('Location:animal.php');

?>