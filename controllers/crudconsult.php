<?php
include_once 'database.php';
include_once 'C:\xampp\htdocs\projet 2\model\consults.php';
include_once 'C:\xampp\htdocs\projet 2\model\animals.php';

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

    public function addconsult($consult)
    {
        $sql = "INSERT INTO consultation ( id_ani,nomp, telp, antmedicaux, diagnostic, reco, datec) 
                VALUES ( :id_ani,:nomp, :telp, :antmedicaux, :diagnostic, :reco, :datec)";
        $db = config::getConnexion();
        
        try {
            $req = $db->prepare($sql);
            $req->execute([
                'id_ani' => $consult->getIdAni(),
                //'nom_ani' => $consult->getNomAnimal(),
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

    function updateconsult($id, $id_ani, $nomp, $telp, $antmedicaux, $diagnostic, $reco, $datec)
    {
        $sql = "UPDATE consultation SET id_ani = :id_ani, nomp = :nomp, telp = :telp, 
                antmedicaux = :antmedicaux, diagnostic = :diagnostic, reco = :reco, datec = :datec 
                WHERE id_consult = :id";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'id_ani' => $id_ani,
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
    $sql = "SELECT c.id_consult,c.nomp,c.telp,c.antmedicaux, c.diagnostic,c.reco, c.datec, a.nom_ani AS nom_ani
            FROM consultation c
            LEFT JOIN animal a ON c.id_ani = a.id_ani"; // Join consultation with animal
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all consultations with animal details
    } catch (Exception $e) {
        die('Error list: ' . $e->getMessage());
    }
}

public function getAllAnimals() {
    // SQL query to fetch id and name of all animals
    $sql = "SELECT id_ani, nom_ani FROM animal"; 
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