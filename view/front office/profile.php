<?php
session_start();

include_once 'C:\xampp\htdocs\projet 2\model\client.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/projet%202/view//front%20office/login.html");
    exit();
}
$userId = $_SESSION['user_id']; 
$clientC = new ClientC();
$client = $clientC->getClientById($userId);
$photoPath = 'C:\xampp\htdocs\projet 2\uploads' . $client['photo'];

$userRole = $client['choix']; 
$isVeterinarian = $client['choix'] === 'Vétérinaire';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriclick</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    /* Suppression du centrage global */
    /* display: flex; */
    /* justify-content: center; */
    /* align-items: center; */
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
<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
       
       <a href="index.html" class="navbar-brand d-flex d-lg-none">
           <h1 class="m-0 display-4 text-secondary"><span class="text-white">Agri</span>CLICK
       </h1>
       </a>

       
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarCollapse">
           <div class="navbar-nav mx-auto py-0">
               <a href=""id="returnHome" class="nav-item nav-link ">Accueil</a>
               <a href="" class="nav-item nav-link">A propos de nous</a>
               <a href="" id="returnoffre" class="nav-item nav-link ">cat/of Travail</a>
               <a href="http://localhost/projet%202/view/ServiceList.php" class="nav-item nav-link">SERVICES</a>
               <div class="nav-item  dropdown d-flex">
                <?php if ($isVeterinarian): ?>
                <div class="nav-item  dropdown d-flex">
                    <a href="../meniar/animal.php" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">suivi veterinaire</a>
                    <div class="dropdown-menu m-1">
                        <a href="../meniar/animal.php" class="dropdown-item"> Ajouter un animal</a>
                        <a href="../meniar/consult.php" class="dropdown-item">Créer une consultation</a>
                    </div>
                </div>
                <?php endif; ?>

</div>          <div class="nav-item dropdown">
                <a href="../elyes/index.php" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Partenariats</a>
                <div class="dropdown-menu m-0">
                    <a href="../elyes/formations.php" class="dropdown-item">Formations</a>
                    <a href="../elyes/index.php" class="dropdown-item">Partenaires</a>
                </div>
            </div>
               <a href="http://localhost/projet%202\view\form.php" class="nav-item nav-link">RECLAMATION</a>
           </div>
           <div class="d-flex">
               <a href="http://localhost/projet%202/view/front office/profile.php" class="nav-item nav-link active" id="signin-btn">Voir le profil</a>
               <a href="http://localhost/projet%202/controllers/deconnexion.php" class="nav-item nav-link" id="signin-btn">se déconnecter</a>
               
               
               
           </div>
       </div>
   </nav>
   <!-- Navbar End -->
<br>
<br>
<div class="container">
   
    <div class="profile-section">
        <div class="profile-header">
           <h2><?php echo htmlspecialchars($client['nom_utilisateur']); ?></h2>
        </div>

 
    
<div class="profile-card">

    
<div class="profile-pic">
    <?php 
    $photo = $client['photo'];
    $photoPath = '/projet 2/uploads/' . ($photo ? htmlspecialchars($photo) : 'default_profile.png');
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
    <!--    <a href="#" id="returnHome">Accueil</a>    -->
    </div>

    <div class="settings-menu">
        <div class="settings-icon-container">
            <img src="/projet%202/uploads/settings-icon.png" alt="Paramètres" class="settings-icon">
        </div>
        <ul class="dropdown-menu">
            <li><a href="http://localhost/projet%202/view/front office/reset_password.html">Changer le mot de passe</a></li>
            <li><a href="http://localhost/projet%202/controllers/deconnexion.php">Se déconnecter</a></li>
          

            
            
        </ul>
    </div>
</div>



    </div>
   
   


</div>

</div>

<script>
   ( document.getElementById('returnHome')).addEventListener('click', function(event)   {
        event.preventDefault();

        var profession = '<?php echo htmlspecialchars($client["choix"]); ?>';

        switch (profession) {
            case 'Vétérinaire':
                window.location.href = "/projet%202/view/front office/vet.html";
                break;
            case 'Mécanicien':
                window.location.href = "/projet%202/view/front office/mecanicien.html";
                break;
            case 'Saisonnier':
                window.location.href = "/projet%202/view/front office/saisonnier.html";
                break;
            case 'Agriculteur':
                window.location.href = "/projet%202/view/front office/agriculteure.html";
                break;
            default:
                window.location.href = "/projet%202/view/front office/index.html";
                break;
        }
    });
    ( document.getElementById('returnoffre')).addEventListener('click', function(event)   {
        event.preventDefault();

        var profession = '<?php echo htmlspecialchars($client["choix"]); ?>';

        switch (profession) {
            case 'Vétérinaire':
                window.location.href = "/projet%202/view/indexcategorieclient.php";
                break;
            case 'Mécanicien':
                window.location.href = "/projet%202/view/indexcategorieclient.php";
                break;
            case 'Saisonnier':
                window.location.href = "/projet%202/view/indexcategorieclient.php";
                break;
            case 'Agriculteur':
                window.location.href = "/projet%202/view/indexcategorie.php";
                break;
            default:
                window.location.href = "/projet%202/view/indexcategorieclient.php";
                break;
        }});
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
