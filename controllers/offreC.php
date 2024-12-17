<?php 
include '../model/offre.php';
include 'database.php';

class OffreC
{
    function getOffreById($idOffre)
    {
        $sql = "SELECT * FROM offre WHERE idOffre = :idOffre";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':idOffre', $idOffre, PDO::PARAM_INT);
            $query->execute();

            $offre = $query->fetch();
            return $offre;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function getOffreByLocalisation($localisation)
    {
        $sql = "SELECT * FROM offre WHERE localisation = :localisation";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':localisation', $localisation, PDO::PARAM_STR);
            $query->execute();

            $offre = $query->fetch();
            return $offre;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function ajouterOffre($offre)
    {
        $sql = "INSERT INTO offre (localisation, travailOffre, salaire, idCategorie, imageOffre) VALUES (:localisation, :travailOffre, :salaire, :idCategorie, :imageOffre)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'localisation' => $offre->getLocalisation(),
                'travailOffre' => $offre->getTravailOffre(),
                'salaire' => $offre->getSalaire(),
                'idCategorie' => $offre->getIdCategorie(),
                'imageOffre' => $offre->getImageOffre()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function afficherOffre()
    {
        $sql = "SELECT * FROM offre";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function supprimerOffre($idOffre)
    {
        $sql = "DELETE FROM offre WHERE idOffre = :idOffre";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idOffre', $idOffre, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function modifierOffre($idOffre, $localisation, $travailOffre, $salaire, $idCategorie, $imageOffre)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE offre SET localisation = :localisation, travailOffre = :travailOffre, salaire = :salaire, idCategorie = :idCategorie, imageOffre = :imageOffre WHERE idOffre = :idOffre');
            $query->bindValue(':localisation', $localisation, PDO::PARAM_STR);
            $query->bindValue(':travailOffre', $travailOffre, PDO::PARAM_STR);
            $query->bindValue(':salaire', $salaire, PDO::PARAM_STR);
            $query->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $query->bindValue(':imageOffre', $imageOffre, PDO::PARAM_STR);
            $query->bindValue(':idOffre', $idOffre, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    function getOffresByCategorie($idCategorie, $minSalaire = null, $maxSalaire = null)
{
    $sql = "SELECT * FROM offre WHERE idCategorie = :idCategorie";
    
    if ($minSalaire !== null) {
        $sql .= " AND salaire >= :minSalaire";
    }
    if ($maxSalaire !== null) {
        $sql .= " AND salaire <= :maxSalaire";
    }
    
    $sql .= " ORDER BY salaire DESC";
    
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
        
        if ($minSalaire !== null) {
            $query->bindValue(':minSalaire', $minSalaire, PDO::PARAM_INT);
        }
        if ($maxSalaire !== null) {
            $query->bindValue(':maxSalaire', $maxSalaire, PDO::PARAM_INT);
        }
        
        $query->execute();
        $offres = $query->fetchAll();
        return $offres;
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}
}
?>
