<?php
include("database.php"); // Assurez-vous que le chemin est correct

class ReponseOfferC { 
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion(); // Obtenez la connexion PDO
    }

    public function add($offer) {
        // Préparez et exécutez la requête d'insertion
        $stmt = $this->db->prepare("INSERT INTO reponse (contenu) VALUES (?)"); 
        return $stmt->execute([$offer->getContenu()]); 
    } // Closing brace for the add method

    public function listReponse() { 
        // Préparez et exécutez la requête pour lister les réponses
        $stmt = $this->db->query("SELECT * FROM reponse");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Assurez-vous d'utiliser FETCH_ASSOC
    }

    // Autres méthodes si nécessaire
}
?>