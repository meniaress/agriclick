<?php
class Offre
{
    private ?int $idOffre = null;
    private ?string $localisation = null;
    private ?string $travailOffre = null;
    private ?float $salaire = null;
    private ?int $idCategorie = null;
    private ?string $imageOffre = null; 

    public function __construct($id = null, $localisation, $travailOffre, $salaire, $idCategorie = null, $imageOffre = null) // Add $imageOffre parameter
    {
        $this->idOffre = $id;
        $this->localisation = $localisation;
        $this->travailOffre = $travailOffre;
        $this->salaire = $salaire;
        $this->idCategorie = $idCategorie;
        $this->imageOffre = $imageOffre;
    }

    public function getIdOffre()
    {
        return $this->idOffre;
    }

    public function getLocalisation()
    {
        return $this->localisation;
    }

    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;
    }

    public function getTravailOffre()
    {
        return $this->travailOffre;
    }

    public function setTravailOffre($travailOffre)
    {
        $this->travailOffre = $travailOffre;
    }

    public function getSalaire()
    {
        return $this->salaire;
    }

    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;
    }

    public function getIdCategorie() 
    {
        return $this->idCategorie;
    }

    public function setIdCategorie($idCategorie) 
    {
        $this->idCategorie = $idCategorie;
    }

    public function getImageOffre()
    {
        return $this->imageOffre;
    }

    public function setImageOffre($imageOffre)
    {
        $this->imageOffre = $imageOffre;
    }
}
?>