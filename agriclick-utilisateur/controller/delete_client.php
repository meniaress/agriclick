<?php
 require_once 'C:\xampp\htdocs\projet\controller\clientc.php';
 include_once 'C:\xampp\htdocs\projet\config.php';
$clientC = new ClientC();
$clientC->deleteclient($_GET["id"]);
header("Location: http://localhost/projet/view/back%20office/client_liste.php");
?>