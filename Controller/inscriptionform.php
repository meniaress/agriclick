<?php
// Inclure la configuration de la base de données
require_once '../connexion.php';

// Requête SQL pour récupérer les noms des partenaires (organisations) avec leur ID
$sql = "
    SELECT p.id, p.nom 
    FROM partenariats p
    JOIN formations f ON p.formation_id = f.id
";
$stmt = $con->prepare($sql);
$stmt->execute();
$partenariats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données du formulaire
    $nom = $_POST['fullname'];
    $prénom = $_POST['prename'];
    $numero = $_POST['numero'];
    $e_mail = $_POST['email'];
    $formation = $_POST['formationName'];
    $partenaireId = $_POST['partnerName'];  // ID du partenaire sélectionné

    try {
        // Requête d'insertion dans la table inscriptions avec l'ID du partenaire
        $sql = "
            INSERT INTO inscriptions (`Nom`, `Prénom`, `Numéro`, `Adresse e-mail`, `Nom de la formation`, `partenaire_id`)
            VALUES (:nom, :prenom, :numero, :email, :formation, :partenaireId)
        ";

        // Préparer la requête
        $stmt = $con->prepare($sql);

        // Lier les paramètres aux variables
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prénom);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':email', $e_mail);
        $stmt->bindParam(':formation', $formation);
        $stmt->bindParam(':partenaireId', $partenaireId);

        // Exécuter la requête
        $stmt->execute();

        // Message de succès
        echo "<h1>Insertion réussie</h1>";
    } catch(PDOException $e) {
        // Affichage de l'erreur en cas d'échec
        echo "<h1>Erreur d'insertion : " . $e->getMessage() . "</h1>";
    }

    // Fermer la connexion à la base de données
    $con = null;
}
?>
