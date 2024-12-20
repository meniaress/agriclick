<?php
// Inclure la configuration de la base de données
require_once '../database.php';


$con=config::getConnexion();


// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_ORG = $_POST['partnerName'];
    $nom = $_POST['fullname'];
    $prenom = $_POST['prename'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $formation = $_POST['formationName'];


    try {
        // Requête d'insertion dans la table inscriptions
        $sql = "INSERT INTO inscriptions (`Nom de l'organisation`,`Nom`, `Prénom`, `Numéro`, `Adresse e-mail`, `Nom de la formation`)
            VALUES (:nom_ORG,:nom, :prenom, :numero, :email, :formation)
        ";
        $stmt = $con->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':nom_ORG', $nom_ORG);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':formation', $formation);
        

        // Exécuter la requête
        $stmt->execute();

        // Message de succès
        echo "<h1>Insertion réussie</h1>";
    } catch (PDOException $e) {
        echo "<h1>Erreur d'insertion : " . $e->getMessage() . "</h1>";
    }
    $con = null;
}
?>