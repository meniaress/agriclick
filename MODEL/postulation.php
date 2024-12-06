<?php
class Postulation
{
    private ?int $idPostulation = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?int $age = null;
    private ?string $localisationp = null;
    private ?int $idOffre = null;

    public function __construct($idPostulation = null, $nom, $prenom, $age, $localisationp, $idOffre)
    {
        $this->idPostulation = $idPostulation;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->localisationp = $localisationp;
        $this->idOffre = $idOffre;
    }

    public function getIdPostulation()
    {
        return $this->idPostulation;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getLocalisationp()
    {
        return $this->localisationp;
    }

    public function setLocalisationp($localisationp)
    {
        $this->localisationp = $localisationp;
    }

    public function getIdOffre()
    {
        return $this->idOffre;
    }

    public function setIdOffre($idOffre)
    {
        $this->idOffre = $idOffre;
    }
}
?>