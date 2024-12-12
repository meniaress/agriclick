<?php
require_once 'connexion.php'; // Votre fichier de connexion à la base de données

if (isset($_POST['partnerName'])) {
    $partnerName = $_POST['partnerName'];
    
    // Requête pour obtenir l'ID du partenaire
    $stmt = $pdo->prepare("SELECT id FROM partenariats WHERE nom = :partnerName");
    $stmt->bindParam(':partnerName', $partnerName);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(['id' => $result['id']]);
    } else {
        echo json_encode(['error' => 'Partenaire introuvable']);
    }
}
?>
