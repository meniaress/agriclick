<?php
// Vérifiez si l'email est passé via l'URL, sinon définissez une valeur par défaut
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du Mot de Passe</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #004200;
            color: white;
            border: none;
            padding: 12px 45px;
            font-size: 14px;
            border-radius: 20px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
        }

        .valid {
            color: green;
        }

        .invalid {
            color: red;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Réinitialisation du Mot de Passe</h1>
    <form action="http://localhost/projet%202/controllers/reset_passwordO.php" method="POST" onsubmit="return validatePassword()">
        
        <input type="hidden" id="email" name="email" value="<?php echo $email; ?>">
        
      
        <label for="new_password">Nouveau Mot de Passe :</label>
        <input type="password" id="new_password" name="password" required>
        
    
        <span id="passwordMessage"></span>
        
     
        <label for="confirm_password">Confirmer le Mot de Passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
       
        <span id="confirmMessage"></span>
        
        <br>
        <br>

        <button type="submit">Réinitialiser le Mot de Passe</button>
    </form>
</div>

<script>
    function validatePassword() {
        const password = document.getElementById("new_password").value;
        const confirmPassword = document.getElementById("confirm_password").value;
        const passwordMessage = document.getElementById("passwordMessage");
        const confirmMessage = document.getElementById("confirmMessage");

       
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$/;

      
        if (!passwordPattern.test(password)) {
            passwordMessage.innerHTML = "Le mot de passe doit contenir entre 8 et 16 caractères, incluant au moins 1 lettre majuscule, 1 lettre minuscule, et 1 chiffre.";
            passwordMessage.className = "invalid";
            return false; 
        } else {
            passwordMessage.innerHTML = "Mot de passe valide";
            passwordMessage.className = "valid";
        }

     
        if (password !== confirmPassword) {
            confirmMessage.innerHTML = "Le mot de passe ne correspond pas";
            confirmMessage.className = "invalid";
            return false; 
        } else {
            confirmMessage.innerHTML = "Mot de passe confirmé";
            confirmMessage.className = "valid";
        }

        return true; 
    }


    document.getElementById("new_password").addEventListener("input", validatePassword);
    document.getElementById("confirm_password").addEventListener("input", validatePassword);
</script>

</body>
</html>
