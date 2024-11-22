<?php
// Inclure les fichiers nécessaires
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\model\config.php';
require_once '../controller/clientc.php';

// Créer une instance du contrôleur ClientC
$clientC = new ClientC();

// Vérifier si l'ID du client est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Récupérer l'ID du client à modifier

    // Récupérer les données du client
    $client = $clientC->getClientById($id);
} else {
    // Rediriger si l'ID n'est pas trouvé
    header("Location: client_liste.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriCLICK - Admin - Mise à jour du profil</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        

        

        .admin-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

       
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color:#004200;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        input[type="submit"] {
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
/*btn coler */
        input[type="submit"]:hover {
            background-color: #004200;
        }
        /*----------*/

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

    </style>
</head>
<body>
    

    <div class="admin-container">
      
        <div class="content">
            <div class="form-container">
                <h2>Mettre à jour le profil du client</h2>

                <!-- Formulaire de mise à jour -->
                <form action="update_client.php" method="POST" enctype="multipart/form-data">
    <div class="profile-pic-container" onclick="document.getElementById('file-input').click();">
        <img src="https://via.placeholder.com/120" id="profile-pic" alt="Profile Picture">
        <div class="upload-icon">&#128247;</div>
    </div>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">
    
    <input type="file" id="file-input" name="photo" class="file-input" accept="image/*" onchange="previewImage(event)" style="display: none;">
    
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" >

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($client['prenom']); ?>" >

    <label for="nom_utilisateur">Nom d'utilisateur :</label>
    <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?php echo htmlspecialchars($client['nom_utilisateur']); ?>" >

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" >

    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>" >

    <!-- Champ "Choix" avec Select, stylisé comme les autres champs -->
    <label for="choix">Choisissez votre profession :</label>
<select id="choix" name="choix" style="width: 100%; padding: 12px; margin: 8px 0; border-radius: 5px; border: 1px solid #ccc; background-color: #fff; font-size: 16px;">
    <option value="" disabled>Choisissez votre profession</option>
    <option value="Vétérinaire" <?php echo ($client['choix'] == "Vétérinaire") ? 'selected' : ''; ?>>Vétérinaire</option>
    <option value="Mécanicien" <?php echo ($client['choix'] == "Mécanicien") ? 'selected' : ''; ?>>Mécanicien</option>
    <option value="Saisonnier" <?php echo ($client['choix'] == "Saisonnier") ? 'selected' : ''; ?>>Saisonnier</option>
    <option value="Agriculteur" <?php echo ($client['choix'] == "Agriculteur") ? 'selected' : ''; ?>>Agriculteur</option>
</select>

    <input type="submit" value="Mettre à jour">
</form>

            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-pic').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>
