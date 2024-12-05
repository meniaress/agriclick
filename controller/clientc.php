<?php
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\config.php';

class ClientC {

    public function addClient($client) {
        $db = Config::getConnexion();

        $query = 'INSERT INTO client (nom, prenom, nom_utilisateur, email, password, telephone, choix, photo) 
                  VALUES (:nom, :prenom, :nom_utilisateur, :email, :password, :telephone, :choix, :photo)';
    
        $stmt = $db->prepare($query);
    
        $stmt->bindValue(':nom', $client->getNom());
        $stmt->bindValue(':prenom', $client->getPrenom());
        $stmt->bindValue(':nom_utilisateur', $client->getNomUtilisateur());
        $stmt->bindValue(':email', $client->getEmail());
        $stmt->bindValue(':password', $client->getPassword());
        $stmt->bindValue(':telephone', $client->getTelephone());
        $stmt->bindValue(':choix', $client->getChoix());
        $stmt->bindValue(':photo', $client->getPhoto()); // Ajout du champ photo
    
        $stmt->execute();
      
        $lastId = $this->getLastInsertedClientId();
        
        return $lastId; 
    }

    public function getLastInsertedClientId() {
        $db = Config::getConnexion();
        return $db->lastInsertId();  
    }
    

public function getClientsByUsername($nom_utilisateur) {
    $sql = "SELECT * FROM client WHERE nom_utilisateur = :nom_utilisateur";
    $db = Config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['nom_utilisateur' => $nom_utilisateur]);
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    } catch (Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
}


public function getClientsByUsernameAndEmail($username, $email) {
    try {
        $db = Config::getConnexion();
        $query = "SELECT * FROM client WHERE nom_utilisateur = :username AND email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
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
   
    
    
    public function updateClient($id, $nom_utilisateur, $email, $telephone, $choix) {
        $db = Config::getConnexion();
    
        $query = 'UPDATE client SET nom_utilisateur = :nom_utilisateur, 
                  email = :email, telephone = :telephone, choix = :choix WHERE id = :id';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':telephone', $telephone);
        $stmt->bindValue(':choix', $choix);
        return $stmt->execute();
    }

    
    public function updateProfil($id, $nom, $prenom, $nom_utilisateur, $email, $telephone, $choix, $photo) {
        $db = config::getConnexion();
    
  
        $query = "UPDATE client
                  SET nom = :nom, prenom = :prenom, nom_utilisateur = :nom_utilisateur, 
                      email = :email, telephone = :telephone, choix = :choix, photo = :photo 
                  WHERE id = :id";
    
        $stmt = $db->prepare($query);
    
       
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':choix', $choix);
        $stmt->bindParam(':photo', $photo);  
    
        
        $stmt->execute();
    }
    
    
    
    
    public function rechercherClientsParRole($role) {
        $sql = "SELECT * FROM client WHERE choix = :role";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':role', $role, PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    
    public function searchClients($role, $nom_utilisateur) {
        $db = config::getConnexion();
        $sql = "SELECT * FROM client WHERE 1=1";
    
        // Ajouter des conditions dynamiques
        if (!empty($role)) {
            $sql .= " AND choix = :role";
        }
        if (!empty($nom_utilisateur)) {
            $sql .= " AND nom_utilisateur LIKE :nom_utilisateur";
        }
    
        try {
            $query = $db->prepare($sql);
    
           
            if (!empty($role)) {
                $query->bindValue(':role', $role);
            }
            if (!empty($nom_utilisateur)) {
                $query->bindValue(':nom_utilisateur', '%' . $nom_utilisateur . '%');
            }
    
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }

    
    
    
}


?>
