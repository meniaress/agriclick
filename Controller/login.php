<?php
session_start();
include_once 'C:\xampp\htdocs\agriCLICK\Models\config.php';
include_once 'C:\xampp\htdocs\agriCLICK\controller\clientc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['username'];
    $password = $_POST['password'];

   
    $clientC = new ClientC();

  
    $clients = $clientC->getClientsByUsername($nom_utilisateur);

    if ($clients) {
    
        foreach ($clients as $client) {
        
            if ($password === $client['password']) {
              
                $_SESSION['user_id'] = $client['id'];
                $_SESSION['profession'] = $client['choix']; 

               
                switch ($client['choix']) {
                    case 'Vétérinaire':
                        header("Location: http://localhost/agriCLICK/Views/farmfresh-1.0.0/vet.html");
                        break;
                    case 'Mécanicien':
                        header("Location: http://localhost/agriCLICK/Views/farmfresh-1.0.0/mecanicien.html");
                        break;
                    case 'Saisonnier':
                        header("Location: http://localhost/agriCLICK/Views/farmfresh-1.0.0/saisonnier.html");
                        break;
                    case 'Agriculteur':
                        header("Location: http://localhost/agriCLICK/Views/farmfresh-1.0.0/agriculteure.html");
                        break;
                    default:
                        // Redirection par défaut si aucun choix valide n'est trouvé
                        header("Location: http://localhost/agriCLICK/Views/farmfresh-1.0.0/index1.html");
                        break;
                }
                exit();
            }
        }

        echo "<script>
        alert('Le mot de passe est incorrect . Veuillez vérifier vos informations!');
        window.location.href = 'http://localhost/agriCLICK/Views/login.html';
    </script>";
    exit();
} else {
   
    echo "<script>
        alert('Nom d\'utilisateur incorrect . Veuillez vérifier vos informations!');
        window.location.href = 'http://localhost/agriCLICK/Views/login.html';
    </script>";
    exit();
}
}
?>