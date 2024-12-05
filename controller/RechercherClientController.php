<?php
include_once 'model/Client.php';

class RechercherClientController {
    public function rechercherClient($role) {
        $clientModel = new Client();
        $clients = $clientModel->rechercheClientsParRole($role);
        include 'views/recherche_client.php'; // Passer les résultats à la vue
    }
}
?>