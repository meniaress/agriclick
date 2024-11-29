<?php
class Categorie
{
    private ?int $idCategorie = null;
    private ?string $nomCategorie = null;
   

    public function __construct($id = null, $nom)
    {
        $this->idCategorie = $id;
        $this->nomCategorie = $nom;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }
    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }
    public function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie= $nomCategorie;
    }
 
}
?>