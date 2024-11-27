<?php
session_start();
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\model\config.php';
require_once '../controller/clientc.php';

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$clientC = new ClientC();
$userId = $_SESSION['user_id'];

// Récupération des informations du client
$client = $clientC->getClientById($userId);

// Vérification et mise à jour des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $nom_utilisateur = trim($_POST['nom_utilisateur']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $choix = $_POST['choix'];

    /*
    // Gestion de l'upload de l'image
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoPath = 'uploads/' . basename($_FILES['photo']['name']);
        // Vérification du type d'image avant d'accepter l'upload
        $imageFileType = strtolower(pathinfo($photoPath, PATHINFO_EXTENSION));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $validExtensions)) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
        } else {
            // Si l'extension n'est pas valide
            $photoPath = 'https://via.placeholder.com/120';
        }
    } else {
        $photoPath = $client['photo'] ?? 'https://via.placeholder.com/120';
    }
*/
    // Mise à jour des informations
    $clientC->updateProfil($userId, $nom, $prenom, $nom_utilisateur, $email, $telephone, $choix, $photoPath);

    header("Location: profile.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriCLICK - Mise à jour du profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        input[type="submit"],
        select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #004200;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #003300;
        }

        .profile-pic-container {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 20px auto;
            cursor: pointer;
            border: 2px solid #004200;
        }

        .profile-pic-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #004200;
            color: white;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }

        .cancel-btn {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #777;
            text-decoration: none;
        }

        .cancel-btn:hover {
            color: #004200;
        }
        .invalid {
            color: red;
        }

        .valid {
            color: green;
        }

    </style>
</head>
<body>


<div class="content">
    <div class="form-container">
        <h2>Mettre à jour mon profil</h2>
        <form action="" method="POST" enctype="multipart/form-data"  id="client-form">
           
            <div class="profile-pic-container" onclick="document.getElementById('file-input').click();">
                <img src="<?php echo $client['photo'] ?? 'https://via.placeholder.com/120'; ?>" id="profile-pic" alt="Profile Picture">
                <div class="upload-icon">&#128247;</div>
            </div>
            <input type="file" id="file-input" name="photo" accept="image/*" onchange="previewImage(event)" style="display: none;">
            
          
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">
            
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" ><span id="nomMessage"></span>

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($client['prenom']); ?>" ><span id="prenomMessage"></span>

            <label for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?php echo htmlspecialchars($client['nom_utilisateur']); ?>" ><span id="usernameMessage"></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" ><span id="emailMessage"></span>

            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>" ><span id="telephoneMessage"></span>

            <label for="choix">Profession</label>
            <select id="choix" name="choix" required>
                <option value="Vétérinaire" <?php echo ($client['choix'] == "Vétérinaire") ? 'selected' : ''; ?>>Vétérinaire</option>
                <option value="Mécanicien" <?php echo ($client['choix'] == "Mécanicien") ? 'selected' : ''; ?>>Mécanicien</option>
                <option value="Saisonnier" <?php echo ($client['choix'] == "Saisonnier") ? 'selected' : ''; ?>>Saisonnier</option>
                <option value="Agriculteur" <?php echo ($client['choix'] == "Agriculteur") ? 'selected' : ''; ?>>Agriculteur</option>
            </select>

            <input type="submit" value="Mettre à jour">
        </form>
        
       
        <a href="profile.php" class="cancel-btn">Annuler</a>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profile-pic');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

   
</script>
<script src="scr.js"></script>


</body>
</html>
