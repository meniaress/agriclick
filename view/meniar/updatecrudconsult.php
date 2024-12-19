<?php


    include 'controllers\crudconsult.php';
    
$id=$_POST['id_consult'];
$nom_ani=$_POST['nomanimal'];
$espece=$_POST['nomp'];
$genre=$_POST['telp'];
$race=$_POST['antmedicaux'];
$poid=$_POST['diagnostic'];
$age=$_POST['reco'];
$date_nais=$_POST['datec'];


$consultt = new Crudconsult();
$consultt->updateconsult($id,$nomanimal,$nomp,$telp,$antmedicaux,$diagnostic,$reco,$datec);

header('Location:consult.php');

?>