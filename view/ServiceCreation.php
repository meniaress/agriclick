<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Include the controller
include_once '../controllers/ServiceController.php';
include_once 'C:\xampp\htdocs\projet 2\model\client.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';
session_start();
// Initialize the controller
$serviceController = new ServiceController();

$service=null;
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION['user_id']; 
$clientC = new ClientC();
$client = $clientC->getClientById($userId);

$userRole = $client['choix']; 

if (
    isset($_POST["title"])  && $_POST["description"] && $_POST["localisation"] && $_POST["tarif"]  && $_POST["category"] && $_POST["type"]
) {
    if (
        !empty($_POST["title"])  && !empty($_POST["description"]) && !empty($_POST["localisation"]) && !empty($_POST["tarif"]) && !empty($_POST["category"]) && !empty($_POST["type"])
    
    ) {
        $service = new Service(
            null, // ID
            $_POST['title'], // Title
            $_POST['description'], // Description
            $_POST['category'], // Category (was mismatched)
            $_POST['localisation'], // Localisation
            $_POST['type'], // Type
            floatval($_POST['tarif']), // Tarif (convert to float)
        );
        
        //
        $serviceController->addService($service);

       header('Location:ServiceList.php');
    } else
        $error = "Missing information";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Create Freelance Service">
    <meta name="description" content="<?php echo $description; ?>">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/addService.js"></script>

    <script src="js/main.js"></script>

    <!-- Custom JavaScript for Validation -->
    <script>
        function validateForm(event) {
            event.preventDefault();

            // Clear previous errors
            const errorElements = document.querySelectorAll(".error-text");
            errorElements.forEach(el => el.textContent = "");

            let hasError = false;

            // Validate Title
            const title = document.getElementById("title");
            if (title.value.trim() === "") {
                document.getElementById("titleError").textContent = "Service title is required.";
                hasError = true;
            }

            // Validate Description
            const description = document.getElementById("description");
            if (description.value.trim() === "") {
                document.getElementById("descriptionError").textContent = "Description is required.";
                hasError = true;
            }

            // Validate Price
            const tarif = document.getElementById("tarif");
            if (tarif.value.trim() === "" || isNaN(tarif.value) || tarif.value <= 0) {
                document.getElementById("tarifError").textContent = "Please enter a valid price.";
                hasError = true;
            }

            // Validate Category
            const category = document.getElementById("category");
            if (category.value === "") {
                document.getElementById("categoryError").textContent = "Please select a category.";
                hasError = true;
            }


             // Validate Localisation
             const localisation = document.getElementById("localisation");
            if (localisation.value === "") {
                document.getElementById("localisationError").textContent = "Please enter a localisation.";
                hasError = true;
            }

            if (!hasError) {
                alert("Form submitted successfully!");
                event.target.submit();
            }
        }
    </script>

    <style>
        .error-text {
            color: red;
            font-size: 0.875rem;
        }
    </style>
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
    <!-- Navbar End -->

    <!-- Page Header -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <h1 class="display-1 text-white">Create Service</h1>
            <a href="servicelist.php" class=" btn btn-secondary py-md-3 px-md-5">Services</a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm p-4">
                    <h2 class="text-center mb-4">Create a New Service</h2>
                    <form name="serviceForm" method="POST" action="serviceCreation.php" onsubmit="return validateForm(event)" >
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title">Service Title</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                            <div id="titleError" class="error-text"></div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="5" class="form-control" required></textarea>
                            <div id="descriptionError" class="error-text"></div>
                        </div>

                        <!-- Localisation -->
                        <div class="mb-3">
    <label for="localisation" class="form-label">Localisation</label>
    <input type="text" id="localisation" name="localisation" class="form-control" required>
    <div id="localisationError" class="error-text"></div> <!-- Error message element -->
</div>


                        <!-- Price -->
                        <div class="mb-3">
                            <label for="tarif">Tarif</label>
                            <div class="input-group">
                                <input type="text" id="tarif" name="tarif" class="form-control" required>
                                <select id="type" name="type" class="form-select" required>
                                    <option value="per-hour">Per Hour</option>
                                    <option value="per-task">Per Task</option>
                                </select>
                            </div>
                            <div id="tarifError" class="error-text"></div>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <div class="position-relative">
                                <input list="categories" id="category" name="category" class="form-control" placeholder="Select or type a category" required>
                                <datalist id="categories">
                                    <option value="jardinerie">
                                    <option value="mecanique">
                                    <option value="electronique">
                                    <option value="plomberie">
                                </datalist>
                            </div>
                            <div id="categoryError" class="error-text"></div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
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


    <!-- JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/addService.js"></script>

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
