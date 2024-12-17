<?php 
include '../model/Categorie.php';
include 'database.php';

class CategorieC
{
    function getCategById($categ)
    {
        $sql = "SELECT * from categorie where idCategorie = :idCategorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':idCategorie', $categ, PDO::PARAM_INT);
            $query->execute();

            $categorie = $query->fetch();
            return $categorie;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function getCategByNom($categ)
    {
        $sql = "SELECT * from categorie where nomCategorie = :nomCategorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':nomCategorie', $categ, PDO::PARAM_STR);
            $query->execute();

            $categorie = $query->fetch();
            return $categorie;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function ajouterCategorie($Categorie)
    {
        $sql = "INSERT INTO categorie (nomCategorie, imageCategorie) VALUES (:nomCategorie, :imageCategorie)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomCategorie' => $Categorie->getNomCategorie(),
                'imageCategorie' => $Categorie->getImageCategorie()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function afficherCategorie()
    {
        $sql = "SELECT * FROM categorie";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function supprimerCategorie($id)
    {
        $sql = "DELETE FROM categorie WHERE idCategorie = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function modifierNomCategorie($idCategorie, $nomCategorie, $imageCategorie)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE categorie SET nomCategorie = :nomCategorie, imageCategorie = :imageCategorie WHERE idCategorie = :idCategorie');
            $query->bindValue(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
            $query->bindValue(':imageCategorie', $imageCategorie, PDO::PARAM_STR);
            $query->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    function trierCategorieParPremiereLettre()
    {
        $sql = "SELECT * FROM categorie ORDER BY nomCategorie ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
?>