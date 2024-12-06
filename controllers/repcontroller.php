<?php
include_once("repofferc.php"); // Ensure the path is correct
include_once("../model/rep.php");

class ReponseController {
    private $reponseOfferC;

    public function __construct() {
        $this->reponseOfferC = new ReponseOfferC(); // Use the correct class name
    }

    public function addReponse($reponse) {
        return $this->reponseOfferC->add($reponse); // Ensure this method exists in ReponseOfferC
    }

    public function showReponseOffer() {
        $offers = $this->reponseOfferC->listReponse();
        echo "<table border='1'>
        <tr>
            <th>Contenu</th>
            <th>Admin</th>
            <th>Type</th>
            <th>Date de Réponse</th>
        </tr>";
        foreach ($offers as $offer) {
            echo "<tr>
                <td>{$offer['contenu']}</td>
                <td>{$offer['admin']}</td>
                <td>{$offer['type']}</td>
                <td>{$offer['date_rep']}</td>
            </tr>";
        }
        echo "</table>";
    }

    public function afficherReponse() {
        $sql = 'SELECT * FROM reponse';
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list->fetchAll(PDO::FETCH_ASSOC); // Fetch results as an associative array
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>