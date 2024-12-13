
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../controller/CommandeController.php';
$commandeController = new CommandeController();
$commandeController->deleteCommande($_GET["id"]);
header('Location:Dash.php');
?>