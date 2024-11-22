<?php
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\model\config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../controller/clientc.php';

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telephone = $_POST['telephone'];
    $choix = $_POST['choix'];

    // Création du client
    $client = new Client($nom, $prenom, $nom_utilisateur, $email, $password, $telephone, $choix);
    $clientC = new ClientC();
    // Ajouter client à la base
    $clientC->addClient($client);

    // Redirection vers la liste des clients après l'ajout
    header("Location: client_liste.php");
    header("Location: http://localhost/projet/view/farmfresh-1.0.0/index1.html");
    exit();
}
?>
