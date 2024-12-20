<?php
// Inclure la configuration de la base de données
require_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
try {
    $con = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les noms d'organisations
    $sql = "SELECT `Nom de l'organisation` FROM partenariats";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $organisations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Erreur de récupération des organisations : " . $e->getMessage());
}
?>