<?php
 require_once '../controller/clientc.php';
$clientC = new ClientC();
$clientC->deleteclient($_GET["id"]);
header("Location: client_liste.php");
