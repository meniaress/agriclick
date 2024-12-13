<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/projet/view/front office/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/projet/view/front office/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/projet/view/front office/PHPMailer/src/SMTP.php';
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

    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email invalide. Veuillez vérifier votre saisie.');</script>";
        exit();
    }

 
    $clientC = new ClientC();
    $clients = $clientC->getClientByEmail($email); 
    
    if ($clients) {

        try {
        
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'mrabetzeineb1@gmail.com'; 
            $mail->Password = 'zifg pdys phwj rgsk'; 
            $mail->SMTPSecure = "tls"; 
            $mail->Port = 587; 

            $mail->setFrom('mrabetzeineb1@gmail.com', 'AgriCLICK');
            $mail->addAddress($email); 

           
            $mail->isHTML(true);
            $mail->Subject = 'Reinitialisation de votre mot de passe';
            $mail->Body = "
                <html>
                <head>
                    <title>Réinitialisation de mot de passe</title>
                </head>
                <body>
                    <h1>Bonjour,</h1>
                    <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
                    <a href='http://localhost/projet/view/front%20office/reset.php?email=" . urlencode($email) . "'>Réinitialiser mon mot de passe</a>
                    <p>Si vous n'avez pas demandé cette action, ignorez cet email.</p>
                </body>
                </html>
            ";

           
            $mail->send();

          
            echo "<script>
                alert('Veuillez vérifier votre email pour réinitialiser votre mot de passe.');
                
            </script>";
        
        } catch (Exception $e) {
            echo "Erreur d'envoi : {$mail->ErrorInfo}";
        }

    } else {
        echo "<script>alert('Cet email n\'existe pas dans notre base de données.');</script>";
    }
}
?>
  Veuillez verifier votre email afin de pouvoir modifier votre mot de passe