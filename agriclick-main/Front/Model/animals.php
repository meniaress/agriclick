<?php

class Animals {
    private $id_ani;
    private ?string $nom_ani;
    private ?string $espece;
    private ?string $genre;
    private ?string $race;
    private ?int $poid;
    private ?int $age;
    private ?DateTime $date_nais;

    public function __construct($nom_ani, $espece, $genre, $race, $poid, $age, $date_nais) {
    
        $this->nom_ani = $nom_ani;
        $this->espece = $espece;
        $this->genre = $genre;
        $this->race = $race;
        $this->poid = $poid;
        $this->age = $age;
       $this->date_nais = $date_nais ? new DateTime($date_nais) : null;
    }

    // Getters
    public function getId() {
        return $this->id_ani;
    }

    public function getNomAni() {
        return $this->nom_ani;
    }

    public function getEspece() {
        return $this->espece;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getRace() {
        return $this->race;
    }

    public function getPoid() {
        return $this->poid;
    }

    public function getAge() {
        return $this->age;
    }

    public function getDateNais() {
        return $this->date_nais;
    }

    // Setters
    public function setId($id) {
        $this->id_ani = $id;
    }

    public function setNomAni($nom_ani) {
        $this->nom_ani = $nom_ani;
    }

    public function setEspece($espece) {
        $this->espece = $espece;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function setRace($race) {
        $this->race = $race;
    }

    public function setPoid($poid) {
        $this->poid = $poid;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setDateNais($date_nais) {
        $this->date_nais = $date_nais;
    }
}
?>