<?php
 require_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';
 include_once 'database.php';
$clientC = new ClientC();
$clientC->deleteclient($_GET["id"]);
header("Location: http://localhost/projet%202/view/back%20office/client_liste.php");
?>