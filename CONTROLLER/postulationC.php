<?php 
include '../MODEL/postulation.php';
include '../Config.php';

class PostulationC
{
    function getPostulationById($idPostulation)
    {
        $sql = "SELECT * FROM postulation WHERE idPostulation = :idPostulation";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':idPostulation', $idPostulation, PDO::PARAM_INT);
            $query->execute();

            $postulation = $query->fetch();
            return $postulation;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function getPostulationByNom($nom)
    {
        $sql = "SELECT * FROM postulation WHERE nom = :nom";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':nom', $nom, PDO::PARAM_STR);
            $query->execute();

            $postulation = $query->fetch();
            return $postulation;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function ajouterPostulation($postulation)
    {
        $sql = "INSERT INTO postulation (nom, prenom, age, localisationp, idOffre) VALUES (:nom, :prenom, :age, :localisationp, :idOffre)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $postulation->getNom(),
                'prenom' => $postulation->getPrenom(),
                'age' => $postulation->getAge(),
                'localisationp' => $postulation->getLocalisationp(),
                'idOffre' => $postulation->getIdOffre()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function afficherPostulation()
    {
        $sql = "SELECT * FROM postulation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function supprimerPostulation($idPostulation)
    {
        $sql = "DELETE FROM postulation WHERE idPostulation = :idPostulation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idPostulation', $idPostulation, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function modifierPostulation($idPostulation, $nom, $prenom, $age, $localisationp, $idOffre)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE postulation SET nom = :nom, prenom = :prenom, age = :age, localisationp = :localisationp, idOffre = :idOffre WHERE idPostulation = :idPostulation');
            $query->bindValue(':nom', $nom, PDO::PARAM_STR);
            $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindValue(':age', $age, PDO::PARAM_INT);
            $query->bindValue(':localisationp', $localisationp, PDO::PARAM_STR);
            $query->bindValue(':idOffre', $idOffre, PDO::PARAM_INT);
            $query->bindValue(':idPostulation', $idPostulation, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function updatePostulationStatus($idPostulation, $etat)
    {
        $sql = "UPDATE postulation SET etat = :etat WHERE idPostulation = :idPostulation";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':etat', $etat, PDO::PARAM_STR);
            $query->bindValue(':idPostulation', $idPostulation, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function getPostulationsByOffre($idOffre, $searchNom = '')
    {
        $sql = "SELECT * FROM postulation WHERE idOffre = :idOffre";
        if ($searchNom) {
            $sql .= " AND nom LIKE :searchNom";
        }
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':idOffre', $idOffre, PDO::PARAM_INT);
            if ($searchNom) {
                $searchNom = '%' . $searchNom . '%';
                $query->bindValue(':searchNom', $searchNom, PDO::PARAM_STR);
            }
            $query->execute();

            $postulations = $query->fetchAll();
            return $postulations;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // New method to check if a combination of nom and prenom exists
    function checkIfExists($nom, $prenom)
    {
        $sql = "SELECT * FROM postulation WHERE nom = :nom AND prenom = :prenom";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $nom,
                'prenom' => $prenom
            ]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>