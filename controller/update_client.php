<?php
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $choix = $_POST['choix'];

    $clientC = new ClientC();

    
    $clientC->updateClient($id, $nom_utilisateur, $email, $telephone, $choix);

    header("Location: http://localhost/projet/view/back%20office/client_liste.php");
    exit();
}
?>
