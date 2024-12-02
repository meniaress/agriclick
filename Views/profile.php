<?php
session_start();

// Inclure les fichiers nécessaires
include_once 'C:\xampp\htdocs\agriCLICK\Models\client.php';
include_once 'C:\xampp\htdocs\agriCLICK\Models\config.php';
require_once '../Controller/clientc.php';


// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; 
$clientC = new ClientC();

// Récupérer les informations du client par ID
$client = $clientC->getClientById($userId);
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

        /* Sidebar */
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

        /* Profile Section */
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
                <img src="<?php echo htmlspecialchars($client['photo_profile']); ?>" alt="Photo de Profil">
            </div>

            
            <div class="profile-info">
                <p><span>Nom:</span> <?php echo htmlspecialchars($client['nom']); ?></p>
                <p><span>Prénom:</span> <?php echo htmlspecialchars($client['prenom']); ?></p>
                <p><span>Email:</span> <?php echo htmlspecialchars($client['email']); ?></p>
                <p><span>Téléphone:</span> <?php echo htmlspecialchars($client['telephone']); ?></p>
                <p><span>Profession:</span> <?php echo htmlspecialchars($client['choix']); ?></p>
            </div>
        </div>

       
        <div class="action-buttons">
            <a href="updateprofile.php">Modifier</a>
            <a href="#" id="returnHome">Accueil</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('returnHome').addEventListener('click', function(event) {
        event.preventDefault();

        var profession = '<?php echo htmlspecialchars($client["choix"]); ?>';

        switch (profession) {
            case 'Vétérinaire':
                window.location.href = "/agriCLICK/Views/farmfresh-1.0.0/vet.html";
                break;
            case 'Mécanicien':
                window.location.href = "/agriCLICK/Views/farmfresh-1.0.0/mecanicien.html";
                break;
            case 'Saisonnier':
                window.location.href = "/agriCLICK/Views/farmfresh-1.0.0/saisonnier.html";
                break;
            case 'Agriculteur':
                window.location.href = "/agriCLICK/Views/farmfresh-1.0.0/agriculteure.html";
                break;
            default:
                window.location.href = "/agriCLICK/Views/farmfresh-1.0.0/index1.html";
                break;
        }
    });
</script>

</body>
</html>
