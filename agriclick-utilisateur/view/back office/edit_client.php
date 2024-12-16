<?php

include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';


$clientC = new ClientC();


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $client = $clientC->getClientById($id);
} else {
    // Rediriger si l'ID n'est pas trouvé
    header("Location: view/back office/client_liste.php");
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
                <form action="http://localhost/projet/controller/update_client.php" method="POST" enctype="multipart/form-data" id="client-form">
   <!---                 
    <div class="profile-pic-container" onclick="document.getElementById('file-input').click();">
        <img src="https://via.placeholder.com/120" id="profile-pic" alt="Profile Picture">
        <div class="upload-icon">&#128247;</div>
    </div>
    -->
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">
    
    <input type="file" id="file-input" name="photo" class="file-input" accept="image/*" onchange="previewImage(event)" style="display: none;">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">
    
 <!----   <input type="file" id="file-input" name="photo" class="file-input" accept="image/*" onchange="previewImage(event)" style="display: none;">   -->
    
    


    <label for="nom_utilisateur">Nom d'utilisateur :</label>
    <input id="nom_utilisateur" name ="nom_utilisateur"type="text" value="<?php echo htmlspecialchars($client['nom_utilisateur']); ?>" ><span id="usernameMessage"></span>

    <label for="email">Email :</label>
    <input id="email" type="text" name ="email" value="<?php echo htmlspecialchars($client['email']); ?>" ><span id="emailMessage"></span>

    <label for="telephone">Téléphone :</label>
    <input id="telephone" name ="telephone" type="text" value="<?php echo htmlspecialchars($client['telephone']); ?>" ><span id="telephoneMessage"></span>

    
  
    <label for="choix">Choisissez la profession :</label>
<select id="choix" name="choix" style="width: 100%; padding: 12px; margin: 8px 0; border-radius: 5px; border: 1px solid #ccc; background-color: #fff; font-size: 16px;">
    <option value="" disabled>Choisissez votre profession</option>
    <option value="Vétérinaire"  <?php echo ($client['choix'] == "Vétérinaire") ? 'selected' : ''; ?>>Vétérinaire</option>
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
  function validateForm(event) {
    let isFormValid = true;

    const username = document.getElementById("nom_utilisateur").value;
    const usernamePattern = /^[a-zA-Z0-9]{8,16}$/;
    const digitCount = (username.match(/\d/g) || []).length;

    // Vérifie si le nom d'utilisateur respecte les critères
    if (usernamePattern.test(username) && digitCount <= 3) {
        document.getElementById("usernameMessage").innerHTML = "Nom d'utilisateur correct";
        document.getElementById("usernameMessage").className = "valid";
    } else {
        document.getElementById("usernameMessage").innerHTML = "Le nom d'utilisateur doit contenir entre 8 et 16 caractères, inclure des chiffres et des lettres, ne pas avoir plus de 3 chiffres, et ne pas contenir de caractères spéciaux.";
        document.getElementById("usernameMessage").className = "invalid";
        isFormValid = false;  
    }

    const email = document.getElementById("email").value;
    const emailMessage = document.getElementById("emailMessage");
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        emailMessage.innerHTML = "Veuillez entrer un email valide !";
        emailMessage.className = "invalid";
        isFormValid = false;
    } else {
        emailMessage.innerHTML = "Email correct";
        emailMessage.className = "valid";
    }

    const phoneNumber = document.getElementById("telephone").value;
    const phoneMessage = document.getElementById("telephoneMessage");
    const phonePattern = /^[\d+\s]+$/;
    if (!phonePattern.test(phoneNumber) || phoneNumber.length < 8 || phoneNumber.length > 15) {
        phoneMessage.innerHTML = "Le numéro de téléphone doit contenir uniquement des chiffres et le caractère '+', avec une longueur entre 8 et 15 caractères.";
        phoneMessage.className = "invalid";
        isFormValid = false;
    } else {
        phoneMessage.innerHTML = "Numéro de téléphone correct";
        phoneMessage.className = "valid";
    }

    if (!isFormValid) {
        event.preventDefault(); 
    }
}

  
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("client-form").addEventListener('submit', validateForm);
});

</script>

    
</body>
</html>
