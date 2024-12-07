<?php

include_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']); 


    if (empty($email)) {
        echo "<script>
            alert('Veuillez entrer votre email.');
            window.location.href = 'http://localhost/projet/view/front%20office/forgot_password.html';  
        </script>";
        exit();
    }

    $clientC = new ClientC();
    $clients = $clientC->getClientByEmail($email); // Rechercher l'email dans la base de données

    if ($clients) {
    
        echo "<script>
            alert('Email valide. Vous pouvez continuer.');
           window.location.href = 'http://localhost/projet/view/front%20office/reset_password.php'; 
        </script>";
    } else {
      
        echo "<script>
            alert('Email invalide. Veuillez vérifier votre saisie.');
            window.location.href = 'http://localhost/projet/view/front%20office/forgot_password.html'; 
        </script>";
    }
}
?>
