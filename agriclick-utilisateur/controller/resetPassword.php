<?php 

include_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $old_password = trim($_POST['old_password']); 

    if (empty($username) || empty($email) || empty($new_password) || empty($old_password)) {
        echo "<script>
            alert('Tous les champs sont obligatoires.');
            window.location.href = 'http://localhost/projet/view/front%20office/reset_password.html';
        </script>";
        exit();
    }

    $clientC = new ClientC();

    $clients = $clientC->getClientsByUsernameAndEmail($username, $email);

    if ($clients) {
        $user_found = false;

        foreach ($clients as $client) {
           
            if (password_verify($old_password, $client['password'])) {
                $user_found = true;
                
                
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                try {
                    $db = Config::getConnexion();
                    $update_query = "UPDATE client SET password = :password WHERE id = :client_id";
                    $stmt = $db->prepare($update_query);
                    $stmt->bindParam(':password', $hashed_new_password); // Utiliser le mot de passe haché
                    $stmt->bindParam(':client_id', $client['id']);  

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

        if (!$user_found) {
            echo "<script>
                alert('Ancien mot de passe incorrect.');
                window.location.href = 'http://localhost/projet/view/front%20office/reset_password.html'; // Redirection vers la page de réinitialisation
            </script>";
        }
    } else {
        echo "<script>
            alert('Nom d\'utilisateur ou email incorrect.');
            window.location.href = 'http://localhost/projet/view/front%20office/reset_password.html'; // Redirection vers le formulaire
        </script>";
    }
}
?>
