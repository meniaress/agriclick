<?php
session_start();
include_once("repcontroller.php");
include_once("../model/rep.php");

$reponseController = new ReponseOfferC();
$results = []; // To hold search results
$notification = null; // Variable for notifications

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type_reponse = trim($_POST["type"]); // Get the response type from the form

    // Validate the input
    if (!empty($type_reponse)) {
        $results = $reponseController->recherchertype($type_reponse); // Call the search method
    } else {
        $notification = "Erreur : Veuillez sélectionner un type de réponse.";
    }
}
?>