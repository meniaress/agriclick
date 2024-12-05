<?php
session_start();

include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\config.php';
include_once 'C:\xampp\htdocs\projet\controller\clientc.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION['user_id']; 
$clientC = new ClientC();
$client = $clientC->getClientById($userId);
$photoPath = 'C:\xampp\htdocs\projet\uploads' . $client['photo'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilisateur</title>
  
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 900px;
            overflow: hidden;
        }

      
        .sidebar {
            background-color: #004200;
            width: 25%;
            padding: 20px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            border-right: 1px solid #e0e0e0;
        }

        .sidebar .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: #ffffff;
            margin: 10px 0;
            font-size: 16px;
            text-align: center;
            transition: color 0.3s;
        }

        .sidebar a:hover {
            color: #FFD700;
        }

      
        .profile-section {
            flex-grow: 1;
            padding: 30px;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            font-size: 24px;
            color: #004200;
        }

        .profile-header .user-menu img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .profile-card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #004200;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            flex-grow: 1;
        }

        .profile-info p {
            margin: 10px 0;
            color: #555;
        }

        .profile-info p span {
            font-weight: bold;
            color: #333;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            background-color: #004200;
            transition: background-color 0.3s;
        }

        .action-buttons a:hover {
            background-color: #006400;
        }
        

.settings-menu {
            position: relative;
            display: inline-block;
        }

     
        .settings-icon-container {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .settings-icon {
            width: 30px;
            height: 30px;
        }

      
.dropdown-menu {
    display: none;
    position: absolute;
    bottom: 40px; 
    right: 0; 
    background-color: #ffffff;
    min-width: 200px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    padding: 0;
    z-index: 1000;
    list-style-type: none;
    overflow: hidden;
}


        .dropdown-menu li {
            border-bottom: 1px solid #ddd;
        }

        .dropdown-menu li:last-child {
            border-bottom: none;
        }

        .dropdown-menu li a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .dropdown-menu li a:hover {
            background-color: #f4f4f4;
        }

        .settings-menu.active .dropdown-menu {
            display: block;
        }

        .action-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.action-buttons {
    display: flex;
    gap: 10px;
}

.action-buttons a {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    color: white;
    background-color: #004200;
    transition: background-color 0.3s;
}

.action-buttons a:hover {
    background-color: #006400;
}

.settings-menu {
    position: relative;
    margin-left: auto; 
}



    </style>
    
</head>
<body>

<div class="container">
   
    <div class="profile-section">
        <div class="profile-header">
           <h2><?php echo htmlspecialchars($client['nom_utilisateur']); ?></h2>
        </div>

 
    
<div class="profile-card">

    
<div class="profile-pic">
    <?php 
    $photo = $client['photo'];
    $photoPath = '/projet/uploads/' . ($photo ? htmlspecialchars($photo) : 'default_profile.png');
    ?>
    <img src="<?php echo $photoPath; ?>" alt="Photo de profil">
</div>

            
            <div class="profile-info">
                <p><span>Nom:</span> <?php echo htmlspecialchars($client['nom']); ?></p>
                <p><span>Prénom:</span> <?php echo htmlspecialchars($client['prenom']); ?></p>
                <p><span>Email:</span> <?php echo htmlspecialchars($client['email']); ?></p>
                <p><span>Téléphone:</span> <?php echo htmlspecialchars($client['telephone']); ?></p>
                <p><span>Profession:</span> <?php echo htmlspecialchars($client['choix']); ?></p>
            </div>
        </div>
        
       
        <div class="action-container">
    <div class="action-buttons">
        <a href="updateprofile.php">Modifier</a>
        <a href="#" id="returnHome">Accueil</a>
    </div>

    <div class="settings-menu">
        <div class="settings-icon-container">
            <img src="/projet/uploads/settings-icon.png" alt="Paramètres" class="settings-icon">
        </div>
        <ul class="dropdown-menu">
            <li><a href="http://localhost/projet/view/front office/reset_password.html">Changer le mot de passe</a></li>
            <li><a href="http://localhost/projet/controller/deconnexion.php">Se déconnecter</a></li>
            <li><a href="http://localhost/projet/view/front%20office/login.html">Créer un nouveau compte</a></li>
            
        </ul>
    </div>
</div>



    </div>
   
   


</div>

</div>

<script>
    document.getElementById('returnHome').addEventListener('click', function(event) {
        event.preventDefault();

        var profession = '<?php echo htmlspecialchars($client["choix"]); ?>';

        switch (profession) {
            case 'Vétérinaire':
                window.location.href = "/projet/view/front office/vet.html";
                break;
            case 'Mécanicien':
                window.location.href = "/projet/view/front office/mecanicien.html";
                break;
            case 'Saisonnier':
                window.location.href = "/projet/view/front office/saisonnier.html";
                break;
            case 'Agriculteur':
                window.location.href = "/projet/view/front office/agriculteure.html";
                break;
            default:
                window.location.href = "/projet/view/front office/index.html";
                break;
        }
    });

    const dropdown = document.querySelector('.dropdown');
dropdown.addEventListener('mouseleave', () => {
  const content = dropdown.querySelector('.dropdown-content');
  content.style.display = 'none';
});
</script>

<script>
       
        document.addEventListener('DOMContentLoaded', function () {
            const settingsMenu = document.querySelector('.settings-menu');
            const settingsIcon = document.querySelector('.settings-icon-container');

          
            settingsIcon.addEventListener('click', () => {
                settingsMenu.classList.toggle('active');
            });

            
            document.addEventListener('click', (event) => {
                if (!settingsMenu.contains(event.target)) {
                    settingsMenu.classList.remove('active');
                }
            });
        });
    </script>




</body>
</html>
