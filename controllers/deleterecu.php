<?php
require_once 'database.php';
include_once '../model/Reclamation.php';

// Fonction pour supprimer une réclamation
function supprimerReclamation($id) {
    $sql = "DELETE FROM reclamtion WHERE id = :id";
    $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id);
    try {
        $req->execute();
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

// Exemple d'utilisation
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    supprimerReclamation($id);
    header('Location: Listerecuser.php'); // Redirigez vers la liste après la suppression
    exit();
}
?>