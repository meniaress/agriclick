<?php


    include '../../controllers/crud.php';
    
$id=$_POST['id_ani'];
$nom_ani=$_POST['nom_ani'];
$espece=$_POST['espece'];
$genre=$_POST['genre'];
$race=$_POST['race'];
$poid=$_POST['poid'];
$age=$_POST['age'];
$date_nais=$_POST['date_nais'];


$animall = new CrudAnimals();
$animall->updateprod($id,$nom_ani,$espece,$genre,$race,$poid,$age,$date_nais);

header('Location:animal.php');

?>