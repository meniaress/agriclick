<?php

session_start();

require_once 'C:\xampp\htdocs\projet\controller\clientc.php';
include_once 'C:\xampp\htdocs\projet\model\client.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telephone = $_POST['telephone'];
    $choix = $_POST['choix'];

    //--------------------------------------------------------------------
    $photo = null; // Valeur par défaut
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoName = uniqid() . '_' . basename($_FILES['photo']['name']);
        $uploadDir = 'C:/xampp/htdocs/projet/uploads/'; // Assure-toi que ce dossier existe et est accessible en écriture
        $uploadFile = $uploadDir . $photoName;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            $photo = $photoName;
        } else {
            echo "Erreur lors du téléchargement de la photo.";
            exit();
        }
    }
//------------------------------------------------------------------------------

$client = new Client($nom, $prenom, $nom_utilisateur, $email, $password, $telephone, $choix, $photo);
    $clientC = new ClientC();

  
    $clientC->addClient($client);

 
    $_SESSION['user_id'] = $clientC->getLastInsertedClientId(); 

  
    echo "Compte créé avec succès! Vous êtes maintenant connecté.";

   
    switch ($choix) {
        case 'Vétérinaire':
            header("Location: http://localhost/projet/view/front office/vet.html");
            break;
        case 'Mécanicien':
            header("Location: http://localhost/projet/view/front office/mecanicien.html");
            break;
        case 'Saisonnier':
            header("Location: http://localhost/projet/view/front office/saisonnier.html");
            break;
        case 'Agriculteur':
            header("Location: http://localhost/projet/view/front office/agriculteure.html");
            break;
        default:
            header("Location: http://localhost/projet/view/front office/index1.html");
            break;
    }

    exit(); 
}
?>
