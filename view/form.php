<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../controllers/ReclamationController.php");
include_once("../model/Reclamation.php"); // Ensure the path is correct

$reclamationController = new ReclamationController();
$offer = null;
$notification = null; // Variable for notifications

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $sujet = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Set the date of creation and status
    $date_creation = date('Y-m-d H:i:s'); // Current date and time
    $statut = 'nouvelle'; // Default status, you can change this as needed

    if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
        // Assuming ID is optional and can be null for new reclamations
        $offer = new Reclamation(null, $nom, $email, $sujet, $message, $date_creation, $statut);
        if ($reclamationController->addOffer($offer)) {
            $_SESSION['email'] = $email; // Stocker l'email dans la session

            // Redirect to the same page with a success parameter
            header('Location: form.php?success=1');
            exit();
        } else {
            $notification = "Erreur : Impossible d'ajouter la réclamation.";
        }
    } else {
        $notification = "Erreur : Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>AGRICLICK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .is-invalid {
            border-color: #dc3545;
        }

        .is-valid {
            border-color: #28a745;
        }

        .error-message {
            display: none;
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .input-container {
            position: relative;
        }

        .input-container:hover .error-message {
            display: block;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Input validation for name
            $('#name').on('input', function() {
                var value = $(this).val();
                if (value.length < 4 || !/^[A-Z]/.test(value)) {
                    $(this).addClass('is-invalid');
                    $('#nameError').show();
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    $('#nameError').hide();
                }
            });

            // Input validation for email
            $('#email').on('input', function() {
                var value = $(this).val();
                if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(value)) {
                    $(this).addClass('is-invalid');
                    $('#emailError').show();
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass ('is-valid');
                    $('#emailError').hide();
                }
            });

            // Input validation for subject and message
            $('#subject, #message').on('input', function() {
                var value = $(this).val();
                if (value.length < 4) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.error-message').show();
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    $(this).siblings('.error-message').hide();
                }
            });

            // Disable submit button if any field is invalid
            $('form').on('input', function() {
                var isValid = true;
                $('input, textarea').each(function() {
                    if ($(this).hasClass('is-invalid')) {
                        isValid = false;
                    }
                });
                $('button[type="submit"]').prop('disabled', !isValid);
            });
        });
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
                <a href="indexcategorieclient.php" class="nav-item nav-link ">cat/of Travail</a>

                <a href="ServiceList.php" class="nav-item nav-link">Service</a>
                <a href="product.html" class="nav-item nav-link">Product</a>
                <div class="nav-item dropdown">
                
                <a href="form.php" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown">Reclamation</a>
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    
                <div class="dropdown-menu m-6">
                    <a href="../controllers/listrectraitee.php" class="dropdown-item">mes reclamations traitees</a>
                    <a href="../controllers/Listerecuser.php" class="dropdown-item">mes reclamations non traitees</a>

                </div>
            <?php endif; ?>



                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">Formulaire de Réclamation</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Form Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-primary text -uppercase">RECLAME Us</h6>
                <h1 class="display-5">Please Feel Free To RECLAME Us</h1>
            </div>
            <?php if (isset($notification)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $notification; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <p id="successMessage" style="color: green;">Votre réclamation a été soumise avec succès!</p>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-6 input-container">
                        <input type="text" id="name" name="name" class="form-control bg-light border-0 px-4" placeholder="Your Name" style="height: 55px;" required>
                        <span class="error-message" id="nameError">Le nom doit contenir au moins 4 caractères et commencer par une majuscule.</span>
                    </div>
                    <div class="col-6 input-container">
                        <input type="email" id="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Your Email" style="height: 55px;" required>
                        <span class="error-message" id="emailError">Veuillez entrer un email valide.</span>
                    </div>
                    <div class="col-12 input-container">
                        <input type="text" id="subject" name="subject" class="form-control bg-light border-0 px-4" placeholder="Subject" style="height: 55px;" required>
                        <span class="error-message">Le sujet doit contenir au moins 4 caractères.</span>
                    </div>
                    <div class="col-12 input-container">
                        <textarea id="message" name="message" class="form-control bg-light border-0 px-4 py-3" rows="2" placeholder="Message" required></textarea>
                        <span class="error-message">Le message doit contenir au moins 4 caractères.</span>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-secondary w-100 py-3" type="submit" disabled>RECLAME</button>
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
            <p class="mb-0">&copy ; <a class="text-secondary fw-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed by <a class="text-secondary fw-bold" href="https://htmlcodex.com">HTML Codex</a></p>
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