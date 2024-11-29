<?php
include("database.php"); // Assurez-vous que le chemin est correct

class reclamationofferc {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion(); // Obtenez la connexion PDO
    }

    public function add($offer) {
        // Préparez et exécutez la requête d'insertion
        $stmt = $this->db->prepare("INSERT INTO reclamtion (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$offer->getName(), $offer->getMail(), $offer->getSubject(), $offer->getMessage()]);
    }

    public function listreclamation() {
        // Préparez et exécutez la requête pour lister les réclamations
        $stmt = $this->db->query("SELECT * FROM reclamtion");
        return $stmt->fetchAll(); // PDO::FETCH_ASSOC est déjà défini dans Config
    }

    // Autres méthodes si nécessaire
}
?>