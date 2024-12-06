<?php
class Reponse {
    private $id_rep;
    private $contenu;
    private $type;
    private $admin;
    private $date_rep;
    private $id_rec; // Add this property to link to the reclamation

    public function __construct($contenu, $type, $admin, $date_rep, $id_rec = null) {
        $this->contenu = $contenu;
        $this->type = $type;
        $this->admin = $admin;
        $this->date_rep = $date_rep;
        $this->id_rec = $id_rec; // Initialize the reclamation ID
    }

    public function getId() {
        return $this->id_rep;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getType() {
        return $this->type;
    }

    public function getDateRep() {
        return $this->date_rep;
    }

    public function getIdRec() {
        return $this->id_rec; // Getter for the reclamation ID
    }

    public function setId($id) {
        $this->id_rep = $id;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setAdmin($admin) {
        $this->admin = $admin; // Correctly assign the admin
    }

    public function setType($type) {
        $this->type = $type; // Correctly assign the type
    }

    public function setDateRep($date_rep) {
        $this->date_rep = $date_rep; // Correctly assign the date
    }

    public function setIdRec($id_rec) {
        $this->id_rec = $id_rec; // Setter for the reclamation ID
    }
}
?>