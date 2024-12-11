<?php
require_once 'database.php';
include_once '../model/Reclamation.php';

// Fonction pour supprimer une réclamation et ses réponses
function supprimerReclamation($id) {
    $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO

    // Supprimer d'abord les réponses associées à la réclamation
    $sqlDeleteResponses = "DELETE FROM reponse WHERE id_rec = :id_rec";
    $reqDeleteResponses = $db->prepare($sqlDeleteResponses);
    $reqDeleteResponses->bindValue(':id_rec', $id);
    try {
        $reqDeleteResponses->execute();
    } catch (Exception $e) {
        die('Erreur lors de la suppression des réponses: ' . $e->getMessage());
    }

    // Ensuite, supprimer la réclamation
    $sqlDeleteReclamation = "DELETE FROM reclamtion WHERE id = :id";
    $reqDeleteReclamation = $db->prepare($sqlDeleteReclamation);
    $reqDeleteReclamation->bindValue(':id', $id);
    try {
        $reqDeleteReclamation->execute();
    } catch (Exception $e) {
        die('Erreur lors de la suppression de la réclamation: ' . $e->getMessage());
    }
}

// Exemple d'utilisation
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    supprimerReclamation($id);
    header('Location: Reclamationlist.php'); // Redirigez vers la liste après la suppression
    exit();
}
?>