<?php
try {
    // Connexion à la base de données
    $bddPDO = new PDO('mysql:host=localhost;dbname=projet web', 'root', '');
    $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'id est passé dans le POST
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        

        // Mettre à jour le statut du partenariat à "accepté"
        $query = "UPDATE partenariats SET Status = 'accepté' WHERE id = :id";
        $stmt = $bddPDO->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            
            // Rediriger vers index.php sans paramètres d'URL
            header("Location: ../Views/index.php");
            exit();
        } else {
            echo "Erreur lors de l'acceptation du partenariat.";
        }
    } else {
        echo "Aucun partenariat sélectionné.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
