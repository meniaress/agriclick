<?php
include '../controllers/CategorieC.php';

$error = "";
$categorieC = new CategorieC();
$categorie = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["idCategorie"]) && !empty($_GET["idCategorie"])) {
        $cateID = $_GET["idCategorie"];
        $categorie = $categorieC->getCategById($cateID);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["idCategorie"]) && isset($_POST["nomCategorie"])) {
        if (!empty($_POST["idCategorie"]) && !empty($_POST['nomCategorie'])) {
            $idCategorie = $_POST["idCategorie"];
            $nomCategorie = $_POST['nomCategorie'];
            
            // Handle file upload
            if (isset($_FILES["imageCategorie"]) && !empty($_FILES["imageCategorie"]["name"])) {
                $targetDir = "";
                $targetFile = $targetDir . basename($_FILES["imageCategorie"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["imageCategorie"]["tmp_name"]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["imageCategorie"]["tmp_name"], $targetFile)) {
                        $imageCategorie = $targetFile;
                    } else {
                        $error = "<label id='form' style='color: red; font-weight: bold;'>&emsp;Erreur lors du téléchargement de l'image !</label>";
                    }
                } else {
                    $error = "<label id='form' style='color: red; font-weight: bold;'>&emsp;Le fichier n'est pas une image valide !</label>";
                }
            } else {
                $imageCategorie = $categorie['imageCategorie']; // Use existing image if no new image is uploaded
            }

            if (empty($error)) {
                $categorieC->modifierNomCategorie($idCategorie, $nomCategorie, $imageCategorie);
                header('Location: indexcategorie.php');
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Agriclick </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"href="style.css">
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
           <a href ="front office/agriculteure.html" class="nav-item nav-link ">Accueil</a>
                <a href="indexcategorie.php" class="nav-item nav-link active">cat/of Travail</a>
                <a href="ServiceList.php" class="nav-item nav-link ">Services</a>
                <div class="nav-item  dropdown d-flex">

<a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Partenariats</a>
                    <div class="dropdown-menu m-7 ">
                        <a href="elyes/formations.php" class="dropdown-item">Formations</a>
                            <a href="elyes/index.php" class="dropdown-item">Partenaires</a>
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
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">categorie travail</h1>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <title>Modifier Categorie</title>
    <script>
        function validateForm() {
            var NomCategorie = document.getElementById("NomCategorie").value;
            var imageCategorie = document.getElementById("imageCategorie").value;

            if (NomCategorie.trim() === "" || imageCategorie.trim() === "") {
                alert("Tous les champs sont obligatoires.");
                return false;
            }

            if (NomCategorie.length <= 5) {
                alert("Le nom du Categorie doit contenir plus de 5 caractères.");
                return false;
            }

            var firstChar = NomCategorie.charAt(0);
            if (firstChar !== firstChar.toUpperCase()) {
                alert("Le nom du Categorie doit commencer par une lettre majuscule.");
                return false;
            }

            if (/\d/.test(NomCategorie)) {
                alert("Le nom du Categorie ne doit pas contenir de chiffres.");
                return false;
            }

            if (/[!@#$%^&*(),.?":{}|<>]/.test(NomCategorie)) {
                alert("Le nom du Categorie ne doit pas contenir de signes spéciaux.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <center><h1>Modifier Categorie</h1></center>
        <hr>
        <br>
        <form method="POST" class="form" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" name="idCategorie" value="<?php echo $categorie['idCategorie']; ?>">
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Nom Categorie</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomCategorie" id="nomCategorie" value="<?php echo $categorie['nomCategorie']; ?>" placeholder="nomCategorie">
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Image Categorie</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="imageCategorie" id="imageCategorie">
                </div>
            </div>
            <div class="row mb-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-secondary py-md-3 px-md-5" href="indexcategorie.php" role="button">Quitter</a>
                </div>
            </div>
        </form>
    </div>
 
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