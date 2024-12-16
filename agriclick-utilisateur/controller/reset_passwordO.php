<?php
include_once 'C:/xampp/htdocs/projet/config.php';
include_once 'C:/xampp/htdocs/projet/model/client.php';
require_once 'C:/xampp/htdocs/projet/controller/clientc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
       
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $newPassword = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $confirmPassword = filter_var($_POST['confirm_password'], FILTER_SANITIZE_STRING);

      
        if ($newPassword !== $confirmPassword) {
            echo "<script>alert('Les mots de passe ne correspondent pas.'); window.location.href = 'reset.php?email=" . urlencode($email) . "';</script>";
            exit();
        }

     
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $clientC = new ClientC();
        $client = $clientC->getClientByEmail($email);

        if ($client) {
         
            $clientC->updatePassword($email, $hashedPassword);

            echo "<script>alert('Mot de passe réinitialisé avec succès.'); window.location.href = 'http://localhost/projet/view/front office/login.html';</script>";
        } else {
            echo "<script>alert('Utilisateur avec cet email introuvable.'); window.location.href = 'forgot_password.html';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Erreur : " . addslashes($e->getMessage()) . "'); window.location.href = 'reset.php?email=" . urlencode($email) . "';</script>";
    }
}
?>
