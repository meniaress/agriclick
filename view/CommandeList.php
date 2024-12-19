<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the controller
include_once '../controllers/CommandeController.php';
include_once 'C:\xampp\htdocs\projet 2\model\client.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';
session_start();

// Initialize the controller
$commandeController = new CommandeController();

// Fetch all commands
$commandes = $commandeController->listCommandes();
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
    <title>Service List - Freelance Platform</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Freelance Services" name="keywords">
    <meta content="Browse freelance services" name="description">

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
                <a href="" id="returnoffre" class="nav-item nav-link ">cat/of Travail</a>
                <a href="ServiceList.php" class="nav-item nav-link active">services</a>
                <a href="form.php" class="nav-item nav-link">Reclamation</a>
                
           </div>
           <div class="d-flex">
                <a href="http://localhost/projet%202/view/front office/profile.php" class="nav-item nav-link" id="signin-btn">Voir le profil</a>
                <a href="http://localhost/projet%202/controllers/deconnexion.php" class="nav-item nav-link" id="signin-btn">se déconnecter</a>
                
            </div>
        </div>
        
    </nav>
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">List of commands</h1>
                    <a href="ServiceCreation.php" class="btn btn-secondary py-md-3 px-md-5">Create Service</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->
    <div class="container py-5">
        <div class="container py-5">
                <input type="text" id="searchInput" class="form-control mb-4" placeholder="Search for services..." aria-label="Search for services...">
                <div class="row">
        </div>
        <?php if (!empty($commandes)) : ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Payment</th>
                        <th>message</th>
                        <th>Service Title</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($commandes as $commande) : ?>
                    <tr id="commande-item">
                        <td class="Command-id fw-bold"><?= htmlspecialchars($commande['id']) ?></td>
                        <td class="Command-date fw-bold"><?= htmlspecialchars($commande['date']) ?></td>
                        <td class="Command-paiement fw-bold"><?= htmlspecialchars($commande['paiement']) ?></td>
                        <td class="Command-message fw-bold"><?= htmlspecialchars($commande['message'] ?? '') ?></td>
                        <td class="Command-serviceTitle fw-bold"><?= htmlspecialchars($commande['serviceTitle']) ?></td>
                        <td>
                            <!-- Update Button -->
                            <form method="GET" action="CommandeUpdate.php" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($commande['id']) ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Update</button>
                            </form>
                            <!-- Delete Button -->
                            <form method="POST" action="CommandeDelete.php" style="display:inline-block;" 
                                onsubmit="return confirm('Are you sure you want to delete this command?');">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($commande['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                            <!-- Success Message -->
                            <?php if (isset($_GET['updated']) && isset($_GET['id']) && $_GET['id'] == $commande['id']) : ?>
                                <div class="alert alert-success mt-2">commande  updated successfully!</div>
                            <?php endif; ?>

                            <?php if (isset($_GET['deleted']) && isset($_GET['id']) && $_GET['id'] == $commande['id']) : ?>
                                <div class="alert alert-success mt-2">Commande deleted successfully!</div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>


                </tbody>
            </table>
        <?php else : ?>
            <p class="text-center">No commands found.</p>
        <?php endif; ?>
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
        document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const commandeItems = document.querySelectorAll("#commande-item");

    function filtercommandes() {
        const query = searchInput.value.toLowerCase();

        commandeItems.forEach(function (item) {
            const id = item.querySelector(".Command-id").textContent.toLowerCase();
            const date = item.querySelector(".Command-date").textContent.toLowerCase();
            const paiement = item.querySelector(".Command-paiement").textContent.toLowerCase();
            const message = item.querySelector(".Command-message").textContent.toLowerCase();
            const title = item.querySelector(".Command-serviceTitle").textContent.toLowerCase();

            const matchesQuery = id.includes(query) || date.includes(query) || paiement.includes(query) || message.includes(query) || title.includes(query);

            if (matchesQuery) {
                item.style.display = ""; // Show the item
            } else {
                item.style.display = "none"; // Hide the item
            }
        });
    }

    searchInput.addEventListener("keyup", filtercommandes);
});

    </script>
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
        }});
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
