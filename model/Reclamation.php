<?php
class Reclamation {
    private ?int $ID;
    private string $nom;
    private string $email;  
    private string $sujet;
    private string $message;
    private string $statut; // Nouvelle propriété pour le statut
    private string $date_creation; // Nouvelle propriété pour la date de création

    public function __construct(?int $id_reclamation, string $nom, string $email, string $sujet, string $message, string $date_creation, string $statut) {
        $this->ID = $id_reclamation;
        $this->nom = $nom;
        $this->email = $email;
        $this->sujet = $sujet;
        $this->message = $message;
         // Initialiser le statut
        $this->date_creation = $date_creation; // Initialiser la date de création
        $this->statut = $statut;
    }

    public function getId() {
        return $this->ID;
    }

    public function getName() {
        return $this->nom;
    }

    public function getMail() {
        return $this->email;
    }

    public function getSubject() {
        return $this->sujet;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getStatut() {
        return $this->statut; // Getter pour le statut
    }

    public function getDateCreation() {
        return $this->date_creation; // Getter pour la date de création
    }

    public function show() {
        echo "<table border ='1'>
        <tr>
        <td>Nom</td>
        <td>Email</td>
        <td>Sujet</td>
        <td>Message</td>
        
        <td>Date de Création</td><td>Statut</td>
        </tr>
        <tr>
        <td>{$this->getName()}</td>
        <td>{$this->getMail()}</td>
        <td>{$this->getSubject()}</td>
        <td>{$this->getMessage()}</td>
        <td>{$this->getDateCreation()}</td> <!-- Afficher la date de création --> 
               <td>{$this->getStatut()}</td> <!-- Afficher le statut -->

        </tr>
        </table>";
    }   
}
?>