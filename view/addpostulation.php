<?php
include_once '../controllers/PostulationC.php';
include_once 'C:\xampp\htdocs\projet 2\model\client.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';
session_start();
$errorMessage = "";
$successMessage = "";

// create postulation
$Postulation = null;

// create an instance of the controller
$PostulationC = new PostulationC();
$idOffre = isset($_GET['idOffre']) ? $_GET['idOffre'] : null;

if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["age"]) &&
    isset($_POST["localisationp"]) &&
    isset($_POST["idOffre"])
) {
    if (
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["age"]) &&
        !empty($_POST["localisationp"]) &&
        !empty($_POST["idOffre"])
    ) {
        // Check if the combination of nom and prenom already exists
        $existingPostulation = $PostulationC->checkIfExists($_POST['nom'], $_POST['prenom']);
        if ($existingPostulation) {
            $errorMessage = "<label id='form' style='color: red; font-weight: bold;'>&emsp;Nom et prénom existent déjà !</label>";
        } else {
            $Postulation = new Postulation(
                null,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['age'],
                $_POST['localisationp'],
                $_POST['idOffre']
            );
            $PostulationC->ajouterPostulation($Postulation);
            header("Location:indexcategorieclient.php?idOffre=$idOffre&successMessage=Postulation ajoutée avec succès");
        }
    } else {
        $errorMessage = "<label id='form' style='color: red; font-weight: bold;'>&emsp;Une information manquante !</label>";
    }
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION['user_id']; 
$clientC = new ClientC();
$client = $clientC->getClientById($userId);

$userRole = $client['choix']; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AGRICLICK - Organic Farm Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
    </head>
<body>
     
    <!-- Topbar End -->
      <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
    <a href="index.html" class="navbar-brand">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Agri</span>CLICK</h1>
        </a>
        <div class="col-lg-3">
                <div class="m-0  align-items-center justify-content-start">
                    <img src="img/logo.png" alt="Logo" style="height: 100px;"> 
                </div>
            </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
            <a href ="" id="returnHome" class="nav-item nav-link ">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="indexoffreclient.php" class="nav-item nav-link active">cat/of Travail</a>
                <a href="ServiceList.php" class="nav-item nav-link ">Services</a>
                <a href="form.php" class="nav-item nav-link">Reclamation</a>
                
            </div>
            <div class="d-flex">
                <a href="http://localhost/projet%202/view/front office/profile.php" class="nav-item nav-link" id="signin-btn">Voir le profil</a>
                <a href="http://localhost/projet%202/controllers/deconnexion.php" class="nav-item nav-link" id="signin-btn">se déconnecter</a>
                
            </div>
        </div>
        
    </nav>
    <!-- Navbar End -->
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">categorie travail</h1>
                    <a href="index.html" class="btn btn-primary py-md-3 px-md-5 me-3">Home</a>
                    <a href="about.html" class="btn btn-secondary py-md-3 px-md-5">About</a>
                </div>
            </div>
        </div>
    </div>
    <title>Postulations</title>
    <script>
    function validateForm() {
        var nom = document.getElementById("nom").value;
        var prenom = document.getElementById("prenom").value;
        var age = document.getElementById("age").value;
        var localisationp = document.getElementById("localisationp").value;

        if (nom.trim() === "" || prenom.trim() === "" || age.trim() === "" || localisationp.trim() === "") {
            alert("Tous les champs sont obligatoires.");
            return false;
        }

        if (nom.length <= 3) {
            alert("Le nom doit contenir plus de 3 caractères.");
            return false;
        }

        if (prenom.length <= 2) {
            alert("Le prénom doit contenir plus de 3 caractères.");
            return false;
        }

        if (isNaN(age) || age <= 0) {
            alert("L'âge doit être un nombre positif.");
            return false;
        }

        if (localisationp.length <= 5) {
            alert("La localisation doit contenir plus de 5 caractères.");
            return false;
        }

        var specialChars = /[!@#$%^&*(),.?":{}|<>0-9]/;
        if (specialChars.test(nom)) {
            alert("Le nom ne doit pas contenir de chiffres ou de signes spéciaux.");
            return false;
        }

        if (specialChars.test(prenom)) {
            alert("Le prénom ne doit pas contenir de chiffres ou de signes spéciaux.");
            return false;
        }
        if (specialChars.test(localisationp)) {
            alert("La localisation ne doit pas contenir de chiffres ou de signes spéciaux.");
            return false;
        }

        return true;
    }
    </script>
    <style>
        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 0.2em;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <center><h1>Nouvelle postulation</h1></center>
        <hr>
        <br>
        <form method="post" class="form" name="form" id="form" onsubmit="return validateForm()">
            <input type="hidden" name="idOffre" value="<?php echo $idOffre; ?>">
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom">
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Âge</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" id="age" placeholder="Âge">
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Localisation</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="localisationp" id="localisationp" placeholder="Localisation">
                </div>
            </div>
            <div class="row mb-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="Ajouter" id="Ajouter">Ajouter</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-secondary py-md-3 px-md-5" href="indexcategorieclient.php?idOffre=<?php echo $idOffre; ?>" role="button">Quitter</a>
                </div>
            </div>
            <?php if ($errorMessage) echo $errorMessage; ?>
        </form>
    </div>
 <!-- Footer Start -->
 <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-white mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-white me-2"></i>
                                <p class="text-white mb-0">123 Street, New York, USA</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-white me-2"></i>
                                <p class="text-white mb-0">info@example.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-white me-2"></i>
                                <p class="text-white mb-0">+012 345 67890</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-secondary btn-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>About Us</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>job offers</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Services</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Meet The Team</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Latest Blog</a>
                                <a class="text-white" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Contact Us</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white mb-4">Popular Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>About Us</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>job offers</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Services</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Meet The Team</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Latest Blog</a>
                                <a class="text-white" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed by <a class="text-secondary fw-bold" href="https://htmlcodex.com">HTML Codex</a></p>
            <br>Distributed By: <a class="text-secondary fw-bold" href="https://themewagon.com" target="_blank">ThemeWagon</a>
        </div>
    </div>
    <!-- Footer End -->
     <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
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
            
            default:
                window.location.href = "/projet%202/view/front office/index.html";
                break;
        }
    });
    </script>
</body>
</html>    