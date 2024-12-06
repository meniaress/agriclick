<?php
include("database.php"); // Ensure the path is correct

class ReponseOfferC { 
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion(); // Get the PDO connection
    }

    public function add($offer) {
        try {
            // Begin a transaction
            $this->db->beginTransaction();

            // Prepare and execute the insert query for the response
            $stmt = $this->db->prepare("INSERT INTO reponse (contenu, type, admin, date_rep, id_rec) VALUES (?, ?, ?, NOW(), ?)"); 
            $result = $stmt->execute([
                $offer->getContenu(),
                $offer->getType(),
                $offer->getAdmin(),
                $offer->getIdRec() // Add the reclamation ID
            ]); 

            // Check if the response was added successfully
            if ($result) {
                // Update the status of the corresponding reclamation to 'traitée'
                $stmt = $this->db->prepare("UPDATE reclamtion SET status = 'traitée' WHERE id = ?");
                $stmt->execute([$offer->getIdRec()]); // Update the status based on the reclamation ID

                // Commit the transaction
                $this->db->commit();
                return true; // Indicate success
            } else {
                // Rollback the transaction if the insert failed
                $this->db->rollBack();
                return false; // Indicate failure
            }
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollBack();
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function listReponse() { 
        // Prepare and execute the query to list responses
        $stmt = $this->db->query("SELECT * FROM reponse");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ensure to use FETCH_ASSOC
    }

    // Other methods if necessary
}
public function recherchertype($type) {
    $sql = "SELECT * FROM reponse WHERE type = :type"; // Corrected the column name to 'type'
    $db = Config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC); // Ensure to use FETCH_ASSOC
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}
?>