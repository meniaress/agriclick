<?php 
include '../MODEL/Categorie.php';
include '../Config.php';
class CategorieC
{
    
    function getCategById($categ){
        $sql="SELECT * from categorie where idCategorie=$categ";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $categorie=$query->fetch();
            return $categorie;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function getCategByNom($categ){
        $sql="SELECT * from categorie where nomCategorie=$categ";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $categorie=$query->fetch();
            return $categorie;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function ajouterCategorie($Categorie)
    {
        $sql = "INSERT INTO categorie
        VALUES (NULL, :np)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'np' => $Categorie->getNomCategorie() 
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
        $sql = "DELETE FROM categorie WHERE idCategorie= :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

    function modifierNomCategorie($idCategorie, $nomCategorie)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE categorie SET nomCategorie = :nomCategorie WHERE idCategorie = :idCategorie');
            $query->bindValue(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
            $query->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    

}