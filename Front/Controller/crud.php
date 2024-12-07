<?php
include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\Agriclickk\config.php';

include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\Agriclickk\Front\Model\animals.php';
class CrudAnimals 
{


public function listAnimals()
{
    $sql = "SELECT * FROM animal";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Error list:'. $e->getMessage());
    }
}

function deleteAnimals($id)
    {
        $sql = "DELETE FROM animal WHERE id_ani = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('delete Error:' . $e->getMessage());
        }
    }

    public function addAnimals($animals)
    {
        $sql = "INSERT INTO animal (nom_ani, espece, genre, race, poid, age, date_nais) 
                VALUES (:nom, :espece, :genre, :race, :poid, :age, :date_nais)";
        $db = config::getConnexion();
        
        try {
            $req = $db->prepare($sql);
            
            // Convert DateTime object to string in 'YYYY-MM-DD' format
            $date_nais = $animals->getDateNais() ? $animals->getDateNais()->format('Y-m-d') : null;
            
            $req->execute([
                'nom' => $animals->getNomAni(),
                'espece' => $animals->getEspece(),
                'genre' => $animals->getGenre(),
                'race' => $animals->getRace(),
                'poid' => $animals->getPoid(),
                'age' => $animals->getAge(),
                'date_nais' => $date_nais  // Pass the formatted date as a string
            ]);
        } catch (Exception $e) {
            die('Error add: ' . $e->getMessage());
        }
    }
    

    function deletecateg($id)
    {
        $sql = "DELETE FROM animal WHERE id_ani  = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('delete Error:' . $e->getMessage());
        }
    }

    function listAnimalssolo($idd){
        $sql = "SELECT * FROM animal where id_ani = $idd";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Error list:'. $e->getMessage());
        }
    }


  function updateprod($id,$nom_ani,$espece,$genre,$race,$poid,$age,$date_nais){
    $sql = "UPDATE animal SET nom_ani= :nom ,espece=:esp,genre=:ger,
    race=:rac,poid=:poi,date_nais=:dat,age=:age WHERE id_ani = :id";

        $db = config::getConnexion();
        try{
        $query = $db->prepare($sql);
        $query -> execute([
        'id'=>$id,
        'nom'=>$nom_ani ,
        'esp' =>$espece,
        'ger'=>$genre ,
        'rac'=>$race ,
        'poi'=> $poid,
        'dat'=> $date_nais,
        'age'=> $age
        
    ]);
}
catch(Exception $e){
    die('Error update :'. $e->getMessage());
}



  }
}
?>