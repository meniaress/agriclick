<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../controllers/ReclamationController.php");
include_once("../model/Reclamation.php"); // Assurez-vous que le chemin est correct

$reclamationController = new ReclamationController();
$offer = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = Config::getConnexion();
    
    // Récupérer la réclamation à modifier
    $sql = "SELECT * FROM reclamtion WHERE id = :id";
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id);
    
    try {
        $req->execute();
        $offer = $req->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
} else {
    die('ID non spécifié.');
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $sujet = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
        // Mettre à jour la réclamation
        $sql = "UPDATE reclamtion SET nom = :nom, email = :email, sujet = :sujet, message = :message WHERE id = :id";
        $req = $db->prepare($sql);
        $req->bindValue(':nom', $nom);
        $req->bindValue(':email', $email);
        $req->bindValue(':sujet', $sujet);
        $req->bindValue(':message', $message);
        $req->bindValue(':id', $id);
        
        try {
            $req->execute();
            header('Location: Listerecuser.php?success=1'); // Rediriger vers la liste des réclamations après la mise à jour
            exit();
        } catch (Exception $e) {
            echo '<h1>Error: Could not update offer.</h1>';
        }
    } else {
        echo '<h1>Error: All fields are required.</h1>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modifier Réclamation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script>
        // Function to hide the success message after 20 seconds
        function hideMessage() {
            const messageElement = document.getElementById('successMessage');
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }
        window.onload = function() {
            setTimeout(hideMessage, 20000); // Hide after 20 seconds
        };
    </script>
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none d-lg-block">
        <div class="row gx-5 py-3 align-items-center">
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-start">
                    <img src="img/logo.png" alt="Logo" style="height: 100px;"> 
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="index.html" class="navbar-brand ms-lg-5">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Agri</span>CLICK</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end">
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="index.html" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Agri</span>CLICK</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <a href="product.html" class="nav-item nav-link">Product</a>
                <a href="reclamation.html" class="nav-item nav-link active">Reclamation</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">Modifier Réclamation</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Form Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase">Modifier Réclamation</h6>
                <h1 class="display-5">Veuillez modifier votre réclamation</h1>
            </div>
            <?php if (isset($_GET['success'])): ?>
                <p id="successMessage" style="color: green;">Votre réclamation a été mise à jour avec succès!</p>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-6">
                        <input type="text" name="name" class="form-control bg-light border-0 px-4" placeholder="Votre Nom" style="height: 55px;" value="<?php echo htmlspecialchars($offer['nom']); ?>" required>
                    </div>
                    <div class="col-6">
                    <input type="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Votre Email" style="height: 55px;" value="<?php echo htmlspecialchars($offer['email']); ?>" required readonly>                    </div>
                    <div class="col-12">
                        <input type="text" name="subject" class="form-control bg-light border-0 px-4" placeholder="Sujet" style="height: 55px;" value="<?php echo htmlspecialchars($offer['sujet']); ?>" required>
                    </div>
                    <div class="col-12">
                        <textarea name="message" class="form-control bg-light border-0 px-4 py-3" rows="2" placeholder="Message" required><?php echo htmlspecialchars($offer['message']); ?></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-secondary w-100 py-3" type="submit">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Form End -->

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
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-lg-n5">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-secondary p-5">
                        <h4 class="text-white">Newsletter</h4>
                        <h6 class="text-white">Subscribe Our Newsletter</h6>
                        <p>Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
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
</body>
</html>