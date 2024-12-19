<?php
include '../controllers/PostulationC.php';
include_once 'C:\xampp\htdocs\projet 2\model\client.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';
session_start();
$PostulationC = new PostulationC();

$idOffre = isset($_GET['idOffre']) ? $_GET['idOffre'] : null;
$searchNom = isset($_GET['searchNom']) ? $_GET['searchNom'] : '';

$list = $PostulationC->getPostulationsByOffre($idOffre, $searchNom);

if (isset($_POST['action']) && isset($_POST['idPostulation'])) {
    $action = $_POST['action'];
    $idPostulation = $_POST['idPostulation'];
    $etat = ($action == 'accepter') ? 'postulation acceptee' : 'postulation refusee';
    $PostulationC->updatePostulationStatus($idPostulation, $etat);
    header("Location: indexresult.php?idOffre=$idOffre&searchNom=$searchNom");
    exit;
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
                    <h1 class="display-1 text-white mb-md-4">RESULTATS</h1>
                    <a href="index.html" class="btn btn-primary py-md-3 px-md-5 me-3">Home</a>
                    <a href="about.html" class="btn btn-secondary py-md-3 px-md-5">About</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <h1 id="root">RESULTATS</h1>
    <div class="container">
        <form method="GET" action="indexresult.php">
            <input type="hidden" name="idOffre" value="<?php echo $idOffre; ?>">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="searchNom" placeholder="Rechercher par nom" value="<?php echo htmlspecialchars($searchNom); ?>">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </form>
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Âge</th>
                    <th>Localisation</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($list) {
                    foreach ($list as $Postulation) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($Postulation['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($Postulation['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($Postulation['age']) . "</td>";
                        echo "<td>" . htmlspecialchars($Postulation['localisationp']) . "</td>";
                        echo "<td>" . htmlspecialchars($Postulation['etat']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="indexcategorieclient.php" class="btn btn-secondary py-md-3 px-md-5">retourner</a>
    </div>
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