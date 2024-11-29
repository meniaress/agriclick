<?php
require_once 'database.php';
include_once '../model/rep.php';

// Fonction pour supprimer une réponse
function supprimerreponse($id) {
    // Use 'id_rep' instead of 'id' in the SQL query
    $sql = "DELETE FROM reponse WHERE id_rep = :id_rep"; 
    $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO
    $req = $db->prepare($sql);
    $req->bindValue(':id_rep', $id);
    try {
        $req->execute();
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

// Exemple d'utilisation
if (isset($_GET['id_rep'])) {
    $id = $_GET['id_rep'];
    supprimerreponse($id);
    header('Location: listrep.php'); // Redirigez vers la liste après la suppression
    exit();
}
?>