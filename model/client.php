<?php
class Client {
    private $nom;
    private $prenom;
    private $nom_utilisateur;
    private $email;
    private $password;
    private $telephone;
    private $choix;
    private $photo; // Nouvel attribut pour la photo de profil

    // Constructor modifié pour inclure la photo
    public function __construct($nom, $prenom, $nom_utilisateur, $email, $password, $telephone, $choix, $photo = null) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->email = $email;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->choix = $choix;
        $this->photo = $photo; // Initialise la photo (valeur par défaut : null)
    }

    // Getters
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getNomUtilisateur() { return $this->nom_utilisateur; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getTelephone() { return $this->telephone; }
    public function getChoix() { return $this->choix; }
    public function getPhoto() { return $this->photo; } // Getter pour la photo

    // Setter pour mettre à jour la photo (optionnel)
    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}
?>
