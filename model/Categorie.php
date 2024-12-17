<?php
class Categorie
{
    private ?int $idCategorie = null;
    private ?string $nomCategorie = null;
    private ?string $imageCategorie = null;

    public function __construct($id = null, $nom, $imageCategorie = null)
    {
        $this->idCategorie = $id;
        $this->nomCategorie = $nom;
        $this->imageCategorie = $imageCategorie;
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
        $this->nomCategorie = $nomCategorie;
    }

    public function getImageCategorie()
    {
        return $this->imageCategorie;
    }

    public function setImageCategorie($imageCategorie)
    {
        $this->imageCategorie = $imageCategorie;
    }
}
?>