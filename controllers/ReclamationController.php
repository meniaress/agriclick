<?php
include_once("reclamationofferc.php"); // Assurez-vous que le chemin est correct
include_once("../model/Reclamation.php");

class ReclamationController {
    private $reclamationOfferC;

    public function __construct() {
        $this->reclamationOfferC = new reclamationofferc(); // Vérifiez que le nom de la classe est correct
    }
    public function addOffer($offer) {
        return $this->reclamationOfferC->add($offer); // Assurez-vous que cette méthode existe dans reclamationofferc
    }
    public function showReclamationOffer() {
        $offers = $this->reclamationOfferC->listreclamation();
        echo "<table border='1'>
        <tr>
            <td>nom</td>
            <td>email</td>
            <td>sujet</td>
            <td>message</td>
        </tr>";
        foreach ($offers as $offer) {
            echo "<tr>
                <td>{$offer['nom']}</td>
                <td>{$offer['email']}</td>
                <td>{$offer['sujet']}</td>
                <td>{$offer['message']}</td>
            </tr>";
        }
        echo "</table>";
    }
    public function AfficherReclamation()
        {
          $sql='select * from reclamtion';
          $db = config::getConnexion();
            try {$list= $db->query($sql);

                      return $list;
                    }
                    catch (Exception $e){
                     die('Erreur: '.$e->getMessage());
    }
        }
}
?>