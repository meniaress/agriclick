<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../controllers/ServiceController.php';
$serviceController = new ServiceController();
$serviceController->deleteService($_GET["id"]);
header('Location:dash.php');