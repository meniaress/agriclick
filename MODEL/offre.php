<?php

class Offre {
    private int $id_offre;
    private string $travail_offre;
    private int$salaire;
    private string$localisation;
    private int$id_categorie;
    public function __construct($id_offre=null, $travail_offre, $salaire, $localisation, $id_categorie) {
        $this->id_offre = $id_offre;
        $this->travail_offre = $travail_offre;
        $this->salaire = $salaire;
        $this->localisation = $localisation;
        $this->idcategorie = $idcategorie;
    }
    public function getIdOffre() {
        return $this->id_offre;
    }

    public function getTravailOffre() {
        return $this->travail_offre;
    }

    public function getSalaire() {
        return $this->salaire;
    }

    public function getLocalisation() {
        return $this->localisation;
    }

    public function getIdCategorie() {
        return $this->idcategorie;
    }
}