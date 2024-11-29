<?php
include_once("repofferc.php"); // Assurez-vous que le chemin est correct
include_once("../model/rep.php");

class ReponseController {
    private $reponseOfferC;

    public function __construct() {
        $this->reponseOfferC = new ReponseOfferC(); // Utilisez le nom de classe correct
    }

    public function addReponse($reponse) {
        return $this->reponseOfferC->add($reponse); // Assurez-vous que cette méthode existe dans ReponseOfferC
    }

    public function showReponseOffer() {
        $offers = $this->reponseOfferC->listReponse();
        echo "<table border='1'>
        <tr>
            <th>Contenu</th>
        </tr>";
        foreach ($offers as $offer) {
            echo "<tr>
                <td>{$offer['contenu']}</td>
            </tr>";
        }
        echo "</table>";
    }

    public function afficherReponse() {
        $sql = 'SELECT * FROM reponse';
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>