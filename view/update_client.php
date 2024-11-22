<?php

include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\model\config.php';
require_once '../controller/clientc.php'; 

//  instance  ClientC
$clientC = new ClientC();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $choix = $_POST['choix'];
    $updateSuccess = $clientC->updateClient($id, $nom, $prenom, $nom_utilisateur, $email, $telephone, $choix);

    if ($updateSuccess) {
      
        header("Location: client_liste.php");
        exit();
    } else {
        // Si la mise à jour échoue, afficher un message d'erreur
        header("Location: client_liste.php");
    }
}

?>
