<?php
class Reponse {
    private $id_rep;
    private $contenu;
  

    public function __construct($contenu,) {
        $this->contenu = $contenu;
    
    }

    public function getId() {
        return $this->id_rep;
    }

    public function getContenu() {
        return $this->contenu;
    }

   
    public function setId($id) {
        $this->id_rep = $id;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }
}
?>