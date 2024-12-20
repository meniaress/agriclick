<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once '../controllers/ServiceController.php';
include_once 'C:\xampp\htdocs\projet 2\model\client.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/projet%202/view//front%20office/login.html");
    exit();
}
$userId = $_SESSION['user_id']; 
$clientC = new ClientC();
$client = $clientC->getClientById($userId);

$userRole = $client['choix']; 
$isVeterinarian = $client['choix'] === 'Vétérinaire';

$serviceController = new ServiceController();
$service = null;

// Check if an ID was provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $service = $serviceController->getServiceById($id);

    if (!$service) {
        echo "Service not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($service['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Freelance Service Details">
    <meta name="description" content="<?php echo nl2br(htmlspecialchars($service['description'])); ?>">

    <!-- Favicon -->
    <link href="img/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar Start -->
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
           <a href ="" id="returnHome" class="nav-item nav-link ">Accueil</a>

                <a href="" id="returnoffre" class="nav-item nav-link ">cat/of Travail</a>
                <a href="ServiceList.php" class="nav-item nav-link active">services</a>
                <div class="nav-item  dropdown d-flex">
                <?php if ($isVeterinarian): ?>
                <div class="nav-item  dropdown d-flex">
                    <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">suivi veterinaire</a>
                    <div class="dropdown-menu m-1">
                        <a href="meniar/animal.php" class="dropdown-item"> Ajouter un animal</a>
                        <a href="meniar/consult.php" class="dropdown-item">Créer une consultation</a>
                    </div>
                </div>
<?php endif; ?>
<div class="nav-item  dropdown d-flex">

<a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Partenariats</a>
                    <div class="dropdown-menu m-7 ">
                        <a href="elyes/formations.php" class="dropdown-item">Formations</a>
                            <a href="elyes/index.php" class="dropdown-item">Partenaires</a>
                        </div>
                </div>                  
                
               
</div>
                <a href="form.php" class="nav-item nav-link">Reclamation</a>
                
           </div>
           <div class="d-flex">
                <a href="http://localhost/projet%202/view/front office/profile.php" class="nav-item nav-link" id="signin-btn">Voir le profil</a>
                <a href="http://localhost/projet%202/controllers/deconnexion.php" class="nav-item nav-link" id="signin-btn">se déconnecter</a>
                
            </div>
        </div>
        
    </nav>
    <!-- Navbar End -->

    <!-- Page Header -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <h1 class="display-1 text-white">Details Service</h1>
            <a href="Servicelist.php" class="btn btn-secondary"> Tous les Services</a>
        </div>
    </div>

    <!-- Service Details Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Main Content: Service Description and Details -->
            <div class="col-lg-8">
                <h2 class="mb-3"><?php echo nl2br(htmlspecialchars($service['title'])); ?></h2>

                <!-- What's Included Section -->
                <h4 class="mb-3">Description service</h4>
                
                    <li class="list-group-item"><?php echo nl2br(htmlspecialchars($service['description'])); ?></li>

            </div>

            <!-- Sidebar: Pricing and Contact -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="card-title">Prix: $<?php echo number_format($service['tarif'], 2); ?></h4>
                        <a href="CommandeCreation.php?id=<?= htmlspecialchars($service['id']) ?>" class="btn btn-success">Reserver le service</a>
                    </div>
                </div>

                <!-- Service Info -->
                <div class="card">
                    <div class="card-header bg-primary text-white">Information de Service</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-briefcase"></i> Categorie: <?php echo nl2br(htmlspecialchars($service['category']));  ?></li>
                        <li class="list-group-item"><i class="bi bi-calendar"></i> Poste: <?php echo nl2br(htmlspecialchars($service['date']));  ?></li>
                        <li class="list-group-item"><i class="bi bi-calendar"></i> Localisation: <?php echo nl2br(htmlspecialchars($service['localisation']));  ?></li>
                        <li class="list-group-item"><i class="bi bi-calendar"></i> Type: <?php echo nl2br(htmlspecialchars($service['type']));  ?></li>


                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-4 py-5">
                    <h4 class="text-white mb-4">Location</h4>
                    <div class="d-flex mb-3">
                        <i class="bi bi-geo-alt text-white me-2"></i>
                        <p class="text-white mb-0">123 Rue, New York, USA</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 py-5 text-center">
                    <h4 class="text-white mb-4">Autour du Web</h4>
                    <div class="d-flex justify-content-center mt-4">
                        <a class="btn btn-secondary btn-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-secondary btn-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-secondary btn-square rounded-circle me-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-secondary btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 py-5 text-end">
                    <h4 class="text-white mb-4">Contactez-nous</h4>
                    <div class="d-flex align-items-center justify-content-end mb-3">
                        <i class="bi bi-envelope-open text-white me-2"></i>
                        <p class="text-white mb-0">info@example.com</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <i class="bi bi-telephone text-white me-2"></i>
                        <p class="text-white mb-0">+012 345 67890</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="container-fluid bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0"><a class="text-secondary fw-bold" href="#">Copyright © Your Website 2024</a></p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
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
            case 'Agriculteur':
                window.location.href = "/projet%202/view/front office/agriculteure.html";
                break;
            default:
                window.location.href = "/projet%202/view/front office/index.html";
                break;
        }    });

    ( document.getElementById('returnoffre')).addEventListener('click', function(event)   {
        event.preventDefault();

        var profession = '<?php echo htmlspecialchars($client["choix"]); ?>';

        switch (profession) {
            case 'Vétérinaire':
                window.location.href = "indexcategorieclient.php";
                break;
            case 'Mécanicien':
                window.location.href = "indexcategorieclient.php";
                break;
            case 'Saisonnier':
                window.location.href = "indexcategorieclient.php";
                break;
            case 'Agriculteur':
                window.location.href = "indexcategorie.php";
                break;
            default:
                window.location.href = "indexcategorieclient.php";
                break;
        }
    });
    </script>
</body>
</html>
