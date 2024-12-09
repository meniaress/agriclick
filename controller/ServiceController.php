<?php
include(__DIR__ . '/../config/database.php');
include(__DIR__ . '/../Model/Services.php');

class ServiceController
{
    public function listServices()
    {
        
        $sql = "SELECT * FROM services";
        $db = (new config)->getConnection();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteService($id)
    {
        $sql = "DELETE FROM services WHERE id = :id";
        $db = (new config)->getConnection();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addService($service)
    {
        $sql = "INSERT INTO services  
        (id, title, description, localisation, tarif, type, category, date)
        VALUES (NULL, :title, :description, :localisation, :tarif, :type, :category, NOW())";
        $db = (new config)->getConnection();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $service->getTitle(),
                'description' => $service->getDescription(),
                'localisation' => $service->getLocalisation(),
                'tarif' => $service->getTarif(),
                'type' => $service->getType(),
                'category' => $service->getCategory(),
            ]);

            echo "Service added successfully!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function updateService($service)
    {
        $sql = "UPDATE services SET 
                title = :title, 
                description = :description, 
                category = :category, 
                localisation = :localisation, 
                tarif = :tarif, 
                type = :type 
                WHERE id = :id";
        $db = (new config)->getConnection();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $service->getId(),
                'title' => $service->getTitle(),
                'description' => $service->getDescription(),
                'category' => $service->getCategory(),
                'localisation' => $service->getLocalisation(),
                'tarif' => $service->getTarif(),
                'type' => $service->getType()
            ]);
            echo "Service updated successfully!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
   
    function getServiceById($id)
    {
        $sql = "SELECT * from services where id = $id";
        $db = (new config)->getConnection();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $offer = $query->fetch();
            return $offer;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
