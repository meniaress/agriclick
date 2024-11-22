<?php

if (isset($_POST['nom_ani']) && isset($_POST['espece']) && isset($_POST['genre']) && isset($_POST['race']) && isset($_POST['poid']) && isset($_POST['age'])&& isset($_POST['date_nais']) ) {
    
    include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\agriclick-v2\Front\Controller\crud.php';
include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\agriclick-v2\Front\Model\animals.php';

    $animal = new Animals($_POST['nom_ani'], $_POST['espece'], $_POST['genre'], $_POST['race'],$_POST['poid'], $_POST['age'], $_POST['date_nais']);

    $animalController = new CrudAnimals();
    $animalController->addAnimals($animal);
    
    header("Location: animal.php");
}
?>