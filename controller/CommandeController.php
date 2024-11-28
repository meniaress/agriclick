<?php
include_once '../model/Commandes.php';
include_once '../config/database.php';

class CommandeController
{
    function addCommande($commande)
    {
        $sql = "INSERT INTO commandes (id, date, paiement, idService)
                VALUES (NULL, NOW(), :paiement, :idService)";
        $db = (new config)->getConnection();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'paiement' => $commande->getPaiement(),
                'idService' => $commande->getIdService()
            ]);

            echo "Commande added successfully!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            exit;
        }
    }


    public function listCommandes()
    {
        $sql = "SELECT c.id, c.date, c.paiement, c.idService, s.title AS serviceTitle
                FROM commandes c
                JOIN services s ON c.idService = s.id";
        $db = (new config)->getConnection();

        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function updateCommandePayment($id, $newPaiement)
    {
        $sql = "UPDATE commandes SET paiement = :paiement WHERE id = :id";
        $db = (new config)->getConnection();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'paiement' => $newPaiement,
                'id' => $id,
            ]);

            echo "Payment method updated successfully!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteCommande($id)
    {
        $sql = "DELETE FROM commandes WHERE id = :id";
        $db = (new config)->getConnection();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            echo "Commande deleted successfully!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    public function getCommandeById($id)
    {
        $sql = "SELECT * FROM commandes WHERE id = :id";
        $db = (new config)->getConnection();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
}
