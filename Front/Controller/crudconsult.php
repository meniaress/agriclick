<?php
include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\Agriclickk\config.php';
include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\Agriclickk\Front\Model\conuslts.php';
include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\Agriclickk\Front\Model\animals.php';

class Crudconsult
{
    public function listconsult()
    {
        $sql = "SELECT * FROM consultation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(); // Assuming you want to fetch all results
        } catch (Exception $e) {
            die('Error list: ' . $e->getMessage());
        }
    }

    public function addconsult($consult,$id_ani)
    {
        $sql = "INSERT INTO consultation (id_ani,nomanimal, nomp, telp, antmedicaux, diagnostic, reco, datec) 
                VALUES (:id_ani,:nomanimal, :nomp, :telp, :antmedicaux, :diagnostic, :reco, :datec)";
        $db = config::getConnexion();
        
        try {
            $req = $db->prepare($sql);
            $req->execute([
                'id_ani' => $id_ani,
                'nomanimal' => $consult->getNomAnimal(),
                'nomp' => $consult->getNomP(),
                'telp' => $consult->getTelP(),
                'antmedicaux' => $consult->getAntMedicaux(),
                'diagnostic' => $consult->getDiagnostic(),
                'reco' => $consult->getReco(),
                'datec' => $consult->getDateC()->format('Y-m-d') // Assuming datec is a DateTime object
            ]);
        } catch (Exception $e) {
            die('Error add: ' . $e->getMessage());
        }
    }

    function deleteconsult($id)
    {
        $sql = "DELETE FROM consultation WHERE id_consult = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('delete Error: ' . $e->getMessage());
        }
    }

    function listconsultsolo($idd)
    {
        $sql = "SELECT * FROM consultation WHERE id_consult = :idd";
        $db = config::getConnexion();
        try {
            $liste = $db->prepare($sql);
            $liste->bindValue(':idd', $idd);
            $liste->execute();
            return $liste->fetch(); // Fetch a single result
        } catch (Exception $e) {
            die('Error list: ' . $e->getMessage());
        }
    }

    function updateconsult($id, $nomanimal, $nomp, $telp, $antmedicaux, $diagnostic, $reco, $datec)
    {
        $sql = "UPDATE consultation SET nomanimal = :nomanimal, nomp = :nomp, telp = :telp, 
                antmedicaux = :antmedicaux, diagnostic = :diagnostic, reco = :reco, datec = :datec 
                WHERE id_consult = :id";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'nomanimal' => $nomanimal,
                'nomp' => $nomp,
                'telp' => $telp,
                'antmedicaux' => $antmedicaux,
                'diagnostic' => $diagnostic,
                'reco' => $reco,
                'datec' => $datec->format('Y-m-d') // Assuming datec is a DateTime object
            ]);
        } catch (Exception $e) {
            die('Error update: ' . $e->getMessage());
        }
    }
    public function listConsultations()
{
    $sql = "SELECT c.id_consult, c.diagnostic, c.datec, a.name AS nom_animal 
            FROM consultation c
            JOIN animal a ON c.id_animal = a.id_animal"; // Join consultation with animal
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        return $query->fetchAll(); // Fetch all consultations with animal details
    } catch (Exception $e) {
        die('Error list: ' . $e->getMessage());
    }
}

public function getAllAnimals() {
    // SQL query to fetch id and name of all animals
    $sql = "SELECT id_ani, name FROM animal"; 
    $db = config::getConnexion();
    
    try {
        $query = $db->query($sql); // Execute the query
        return $query->fetchAll(); // Fetch all rows
    } catch (Exception $e) {
        echo 'Error fetching animals: ' . $e->getMessage();
        return []; // Return an empty array on error
    }
}


}
?>