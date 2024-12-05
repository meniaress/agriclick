<?php 
// Inclure la configuration et le contrôleur
include_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $old_password = trim($_POST['old_password']); // Ajout du champ pour l'ancien mot de passe

    if (empty($username) || empty($email) || empty($new_password) || empty($old_password)) {
        echo "<script>
            alert('Tous les champs sont obligatoires.');
            window.location.href = 'http://localhost/projet/view/front%20office/reset_password.html';
        </script>";
        exit();
    }

    $clientC = new ClientC();

    // Récupérer tous les clients correspondant au nom d'utilisateur et à l'email
    $clients = $clientC->getClientsByUsernameAndEmail($username, $email);

    if ($clients) {
        $user_found = false;

        // Vérifier chaque utilisateur pour s'assurer que l'ancien mot de passe correspond à celui en base de données
        foreach ($clients as $client) {
            if ($client['password'] === $old_password) {
                // Trouver l'utilisateur avec le mot de passe correct
                $user_found = true;
                
                // Mettre à jour le mot de passe
                try {
                    $db = Config::getConnexion();
                    $update_query = "UPDATE client SET password = :password WHERE id = :client_id";
                    $stmt = $db->prepare($update_query);
                    $stmt->bindParam(':password', $new_password); 
                    $stmt->bindParam(':client_id', $client['id']);  // Utilisation de l'id pour l'utilisateur unique

                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Mot de passe mis à jour avec succès.');
                            window.location.href = 'http://localhost/projet/view/front%20office/login.html'; // Redirection vers la page de connexion
                        </script>";
                    } else {
                        echo "<script>
                            alert('Erreur lors de la mise à jour du mot de passe. Veuillez réessayer.');
                            window.location.href = 'http://localhost/projet/view/front%20office/reset_password.html';
                        </script>";
                    }
                } catch (Exception $e) {
                    die("Erreur : " . $e->getMessage());
                }
                exit();
            }
        }

        // Si aucun utilisateur avec le bon ancien mot de passe n'a été trouvé
        if (!$user_found) {
            echo "<script>
                alert('Ancien mot de passe incorrect.');
                window.location.href = 'http://localhost/projet/view/front%20office/reset_password.html'; // Redirection vers la page de réinitialisation
            </script>";
        }
    } else {
        // Si aucun utilisateur n'est trouvé
        echo "<script>
            alert('Nom d\'utilisateur ou email incorrect.');
            window.location.href = 'http://localhost/projet/view/front%20office/reset_password.html'; // Redirection vers le formulaire
        </script>";
    }
}
?>
