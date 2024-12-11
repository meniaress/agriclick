<?php

include_once 'C:\xampp\htdocs\projet\config.php';
include_once 'C:\xampp\htdocs\projet\model\client.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $clientC = new ClientC();

        // Récupérer les données du formulaire, y compris l'email caché
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);  // Récupérer l'email du formulaire POST

        $newPassword = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $confirmPassword = filter_var($_POST['confirm_password'], FILTER_SANITIZE_STRING);

        // Validation des champs
        if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
            echo "<script>
                alert('Tous les champs sont obligatoires.');
                window.location.href = 'reset.html?email=" . urlencode($email) . "';
            </script>";
            exit;
        }

        if ($newPassword !== $confirmPassword) {
            echo "<script>
                alert('Les mots de passe ne correspondent pas.');
                window.location.href = 'reset.html?email=" . urlencode($email) . "';
            </script>";
            exit;
        }

        // Vérification de l'existence de l'utilisateur
        $client = $clientC->getClientByEmail($email);
        if ($client) {
            // Mise à jour du mot de passe sans hachage
            $clientC->updatePassword($email, $newPassword);  // Pas de hachage ici

            echo "<script>
                alert('Mot de passe réinitialisé avec succès.');
                window.location.href = 'login.html';
            </script>";
        } else {
            echo "<script>
                alert('Utilisateur avec cet email introuvable.');
                window.location.href = 'forgot.html';
            </script>";
        }
    } catch (Exception $e) {
        echo "<script>
            alert('Erreur : " . addslashes($e->getMessage()) . "');
            window.location.href = 'reset.html?email=" . urlencode($email) . "';
        </script>";
    }
} else {
    echo "<script>
        alert('Requête invalide.');
        window.location.href = 'forgot.html';
    </script>";
}
?>
