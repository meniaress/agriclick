<?php
class Client {
    private $nom;
    private $prenom;
    private $nom_utilisateur;
    private $email;
    private $password;
    private $telephone;
    private $choix;
    private $photo;
    private $date_creation;
    private $last_login; 
    private $login_count; // Attribut pour le nombre de connexions
   
    public function __construct($nom, $prenom, $nom_utilisateur, $email, $password, $telephone, $choix, $photo = null, $last_login = null, $login_count = 0) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->email = $email;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->choix = $choix;
        $this->photo = $photo;
        $this->date_creation = $date_creation;
        $this->last_login = $last_login; 
        $this->login_count = $login_count; // Initialiser avec la valeur passée (0 par défaut)
    }

    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getNomUtilisateur() { return $this->nom_utilisateur; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getTelephone() { return $this->telephone; }
    public function getChoix() { return $this->choix; }
    public function getPhoto() { return $this->photo; } 
    public function getDateCreation() { return $this->date_creation; }
    public function getLastLogin() { return $this->last_login; } 
    public function getLoginCount() { return $this->login_count; } 

   
    public function setPhoto($photo) {
        $this->photo = $photo;
    }

   
    public function setLastLogin($last_login) {
        $this->last_login = $last_login;
    }

   
    public function setLoginCount($login_count) {
        $this->login_count = $login_count;
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation;
    }
}
?>
