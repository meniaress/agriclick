<?php
    include_once '../config.php';
    include '../model/offre.php';
    class offreC{
        function afficheroffre(){
            $sql="SELECT * FROM offre ";
            $db = config::getConnexion();
            try{
                $liste = $db->query($sql);
                return $liste;
            }
            catch(Exception $e){
                die('Erreur:' . $e->getMessage());
            }
        }
        function supprimeroffre($id_offre){
            $sql=" DELETE FROM offre WHERE id_offre=:id_offre";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':id_offre' , $id_offre);
            try{
                $req->execute();
            }
            catch(Exception $e){
                die('Erreur:' . $e->getMessage());
            }
        }
        function ajouteroffre($offre){
    
        $sql = "INSERT INTO offre ($id_offre, $travail_offre, $salaire, $localisation, $id_categorie)
                    VALUES (:id_offre, :travail_offre, :salaire, :localisation, :id_categorie);
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                    'id_offre' => $offre->getIdOffre(),
                    'travail_offre' => $offre->getTravailOffre(),
                    'salaire' => $offre->getSalaire(),
                    'localisation' => $offre->getLocalisation(),
                    'id_categorie' => $offre->getIdCategorie()
    
            ]);
            $_SESSION['error']="data add seccsesfuly";
    } catch (Exception $e){
        $e->getMessage();
    }

        }


        function modifieroffre($id_offre,$offre)
        {
            try {
                $db = config::getConnexion();
                $query = $db->prepare(
                    'UPDATE offre SET 
                        salaire = :salaire,
                        localisation = :localisation
                    WHERE id_offre = :id_offre'
                );
        
                $query->execute([
                    'id_offre' => $id_offre,
                    'salaire' => $offre->getSalaire(),
                    'localisation' => $offre->getLocalisation()
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        
        function recupereroffre($id_offre, $id_categorie)
        {
            try {
                $sql = "SELECT * FROM commandes INNER JOIN panier ON commandes.panier_id = panier.panier_id WHERE panier.panier_id = :panier_id AND id_commande = :id_commande";
                $db = config::getConnexion();
                $query = $db->prepare($sql);
                $query->bindParam(':panier_id', $panier_id, PDO::PARAM_INT);
                $query->bindParam(':id_commande', $id_commande, PDO::PARAM_INT);
                $query->execute();
                $commande = $query->fetch(PDO::FETCH_ASSOC);
                return $commande;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        
    function joinpanier($panier_id){
        $sql=("SELECT * FROM commandes INNER JOIN panier on commandes.panier_id = panier.panier_id WHERE panier.panier_id = $panier_id");
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }



    }
    ?>