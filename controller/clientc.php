<?php
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\model\config.php';
// ClientC.php
class ClientC {

    public function addClient($client) {
        
        $db = Config::getConnexion();
        $query = 'INSERT INTO client (nom, prenom, nom_utilisateur, email, password, telephone, choix) 
                  VALUES (:nom, :prenom, :nom_utilisateur, :email, :password, :telephone, :choix)';
        
        $stmt = $db->prepare($query);
        
        
        $stmt->bindValue(':nom', $client->getNom());
        $stmt->bindValue(':prenom', $client->getPrenom());
        $stmt->bindValue(':nom_utilisateur', $client->getNomUtilisateur());
        $stmt->bindValue(':email', $client->getEmail());
        $stmt->bindValue(':password', $client->getPassword());
        $stmt->bindValue(':telephone', $client->getTelephone());
        $stmt->bindValue(':choix', $client->getChoix());

        
        return $stmt->execute();
    }

    public function getClients() {
        
        $db = Config::getConnexion();
        $query = 'SELECT * FROM client';
        $stmt = $db->prepare($query);
        $stmt->execute();

        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientById($id) {
        
        $db = Config::getConnexion();
        
       
        $query = 'SELECT * FROM client WHERE id = :id';
        
        
        $stmt = $db->prepare($query);
    
        $stmt->bindValue(':id', $id);
      
        $stmt->execute();
      
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function deleteclient($id)
    {
        $sql = "DELETE FROM client WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function updateClient($id, $nom, $prenom, $nom_utilisateur, $email, $telephone, $choix) {
        
        $db = Config::getConnexion();
        
    
        $query = 'UPDATE client SET nom = :nom, prenom = :prenom, nom_utilisateur = :nom_utilisateur, 
                  email = :email, telephone = :telephone, choix = :choix WHERE id = :id';
        
       
        $stmt = $db->prepare($query);
        
        
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':telephone', $telephone);
        $stmt->bindValue(':choix', $choix);
        
        return $stmt->execute();
    }
}


?>
