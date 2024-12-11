<?php

class Consults {
    private $id_consult;
    private ?int $id_ani; // Use id_ani for the animal ID
    private ?string $nomp;
    private ?string $telp;
    private ?string $antmedicaux;
    private ?string $diagnostic;
    private ?string $reco;
    private ?DateTime $datec;

    public function __construct($id_ani, $nomp, $telp, $antmedicaux, $diagnostic, $reco, $datec) {
        $this->id_ani = $id_ani; // Set the animal ID
        $this->nomp = $nomp;
        $this->telp = $telp;
        $this->antmedicaux = $antmedicaux;
        $this->diagnostic = $diagnostic;
        $this->reco = $reco;
        $this->datec = $datec ? new DateTime($datec) : null;
    }

    // Getters
    public function getId() {
        return $this->id_consult;
    }

    public function getIdAni() { // Getter for animal ID
        return $this->id_ani;
    }

    public function getNomP() {
        return $this->nomp;
    }

    public function getTelP() {
        return $this->telp;
    }

    public function getAntMedicaux() {
        return $this->antmedicaux;
    }

    public function getDiagnostic() {
        return $this->diagnostic;
    }

    public function getReco() {
        return $this->reco;
    }

    public function getDateC() {
        return $this->datec;
    }

    // Setters
    public function setId($id) {
        $this->id_consult = $id;
    }

    public function setIdAni($id_ani) { // Setter for animal ID
        $this->id_ani = $id_ani;
    }

    public function setNomP($nomp) {
        $this->nomp = $nomp;
    }

    public function setTelP($telp) {
        $this->telp = $telp;
    }

    public function setAntMedicaux($antmedicaux) {
        $this->antmedicaux = $antmedicaux;
    }

    public function setDiagnostic($diagnostic) {
        $this->diagnostic = $diagnostic;
    }

    public function setReco($reco) {
        $this->reco = $reco;
    }

    public function setDateC($datec) {
        $this->datec = $datec;
}
}
?>