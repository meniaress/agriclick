<?php

session_start();


require_once '../controller/clientc.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telephone = $_POST['telephone'];
    $choix = $_POST['choix'];


    $client = new Client($nom, $prenom, $nom_utilisateur, $email, $password, $telephone, $choix);
    $clientC = new ClientC();

  
    $clientC->addClient($client);

 
    $_SESSION['user_id'] = $clientC->getLastInsertedClientId(); 

  
    echo "Compte créé avec succès! Vous êtes maintenant connecté.";

   
    switch ($choix) {
        case 'Vétérinaire':
            header("Location: http://localhost/projet/view/farmfresh-1.0.0/vet.html");
            break;
        case 'Mécanicien':
            header("Location: http://localhost/projet/view/farmfresh-1.0.0/mecanicien.html");
            break;
        case 'Saisonnier':
            header("Location: http://localhost/projet/view/farmfresh-1.0.0/saisonnier.html");
            break;
        case 'Agriculteur':
            header("Location: http://localhost/projet/view/farmfresh-1.0.0/agriculteure.html");
            break;
        default:
            header("Location: http://localhost/projet/view/farmfresh-1.0.0/index1.html");
            break;
    }

    exit(); 
}
?>
