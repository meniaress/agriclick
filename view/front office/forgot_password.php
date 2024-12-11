<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/projet/view/front office/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/projet/view/front office/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/projet/view/front office/PHPMailer/src/SMTP.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    }
    
  
    echo "<script>alert('Veuillez vérifier votre email pour réinitialiser votre mot de passe.');</script>";


    try {
        
        $mail = new PHPMailer(true);

        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'mrabetzeineb1@gmail.com'; // Votre email
        $mail->Password = ''; 
        $mail->SMTPSecure = "tls"; // Sécurisation TLS
        $mail->Port = 587; // Port SMTP

        // Configuration de l'email
        $mail->setFrom('mrabetzeineb1@gmail.com', 'Support'); 
        $mail->addAddress($email); // Destinataire

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Réinitialisation de votre mot de passe';
        $mail->Body = "
            <html>
            <head>
                <title>Réinitialisation de mot de passe</title>
            </head>
            <body>
                <h1>Bonjour,</h1>
                <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
               <a href='http://localhost/projet/view/front%20office/reset.html?email=" . urlencode($email) . "'>Réinitialiser mon mot de passe</a>

                <p>Si vous n'avez pas demandé cette action, ignorez cet email.</p>
            </body>
            </html>
        ";

        // Envoi de l'email
        $mail->send();
        echo "Un email de réinitialisation a été envoyé à : $email.";
    } catch (Exception $e) {
        echo "Erreur d'envoi : {$mail->ErrorInfo}";
    }
}
?>
