<?php 
include '../controllers/CategorieC.php';
$CatC = new CategorieC();
$list = $CatC->trierCategorieParPremiereLettre();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AGRICLICK </title>
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
    <!-- Navbar End -->
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
    <h1 id="root">CATEGORIE DE TRAVAIL</h1>
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <?php 
            if ($list) {
                foreach ($list as $Cat) {
                    echo '<div class="col-lg-4 col-md-6">';
                    echo '<div class="service-item bg-light text-center p-5">';
                    echo '<img src="' . $Cat['imageCategorie'] . '" alt="Image Categorie" style="width: 200px; height: auto;" class="mb-3">';
                    echo '<h4>' . $Cat['nomCategorie'] . '</h4>';
                    echo '<div class="mt-3">';
                    echo '<a class="btn btn-secondary" href="updatecategorie.php?idCategorie=' . $Cat['idCategorie'] . '" role="button"><i class="fas fa-edit"></i></a> ';
                    echo '<a class="btn btn-danger" href="deletecategorie.php?idCategorie=' . $Cat['idCategorie'] . '" role="button"><i class="fas fa-trash"></i></a> ';
                    echo '<a class="btn btn-secondary" href="indexoffre.php?idCategorie=' . $Cat['idCategorie'] . '" role="button"><i class="fas fa-eye"></i></a> ';
                    echo '<a class="btn btn-primary" href="addoffre.php?idCategorie=' . $Cat['idCategorie'] . '" role="button">Ajouter offre</a>';
                    echo '</div>'; // Close actions div
                    echo '</div>'; // Close service-item div
                    echo '</div>'; // Close column div
                }
            }
            ?>
        </div>
    </div>
</div>
<a href="addcategorie.php" class="btn btn-primary py-md-3 px-md-5">Ajouter categorie</a>

 
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