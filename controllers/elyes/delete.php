<?php
try {
    // Connect to the database
    $bddPDO = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
    $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare and execute the DELETE query
        $query = "DELETE FROM partenariats WHERE id = :id";
        $stmt = $bddPDO->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirect to the main page or a success page after deletion
            header("Location: ../../View/elyes/dash.php?success=1");
            exit();
        } else {
            echo "Erreur : La suppression a échoué.";
        }
    } else {
        echo "Erreur : Aucun identifiant spécifié.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
