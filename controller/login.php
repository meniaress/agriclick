<?php
session_start();
include_once 'C:\xampp\htdocs\projet\config.php';
include_once 'C:\xampp\htdocs\projet\controller\clientc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['username'];
    $password = $_POST['password'];

    $clientC = new ClientC();

    $clients = $clientC->getClientsByUsername($nom_utilisateur);

    if ($clients) {
        foreach ($clients as $client) {
           
            if (password_verify($password, $client['password'])) {
               
                $clientId = $client['id'];
                $currentDate = date("Y-m-d H:i:s");
                $clientC->updateLoginStats($clientId, $currentDate);

               
                $_SESSION['user_id'] = $client['id'];
                $_SESSION['profession'] = $client['choix'];

                
                switch ($client['choix']) {
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
        }

     
        echo "<script>
            alert('Le mot de passe est incorrect. Veuillez vérifier vos informations!');
            window.location.href = 'http://localhost/projet/view/front office/login.html';
        </script>";
        exit();
    } else {
      
        echo "<script>
            alert('Nom d\'utilisateur incorrect. Veuillez vérifier vos informations!');
            window.location.href = 'http://localhost/projet/view/front office/login.html';
        </script>";
        exit();
    }
}
?>
