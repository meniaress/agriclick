<?php 
include '../CONTROLLER/OffreC.php';
$OffreC = new OffreC();

$idCategorie = isset($_GET['idCategorie']) ? $_GET['idCategorie'] : null;
$list = $OffreC->getOffresByCategorie($idCategorie);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AgriCLICK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
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
    <div class="d-flex align-items-center justify-content-center">
        <a href="index.html" class="navbar-brand ms-lg-5">
            <img src="img/logo.png" alt="Logo" style="height: 100px;">
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0">
            <a href="dash.php" class="nav-item nav-link">Gestion de Partenariats</a>
            <a href="service.html" class="nav-item nav-link">Service</a>
            <a href="offre.html" class="nav-item nav-link">offrecategorie</a>
            <a href="product.html" class="nav-item nav-link">Product</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="blog.html" class="dropdown-item">Blog Grid</a>
                    <a href="detail.html" class="dropdown-item">Blog Detail</a>
                    <a href="feature.html" class="dropdown-item">Features</a>
                    <a href="team.html" class="dropdown-item">The Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                </div>
            </div>
            <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
    </div>
</nav>

    <!-- Hero End -->
    <h1 id="root">OFFRES DE TRAVAIL</h1>
    <div class="container">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Localisation</th>
                    <th>Travail</th>
                    <th>Salaire</th>
                    <th>Image Offre</th>
                    <th>actions</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($list) {
                    foreach ($list as $Offre) {
                        echo "<tr>";
                        echo "<td>" . $Offre['localisation'] . "</td>";
                        echo "<td>" . $Offre['travailOffre'] . "</td>";
                        echo "<td>" . $Offre['salaire'] . "</td>";
                        echo "<td><img src='" . $Offre['imageOffre'] . "' alt='Image Offre' style='width: 100px; height: auto;'></td>";
                        echo "<td>";
                        echo '<a class="btn btn-secondary" href="indexadminpos.php?idOffre=' . $Offre['idOffre'] . '" role="button">voir les postulations</a>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        
        <a href="indexadmincat.php" class="btn btn-secondary py-md-3 px-md-5">retourner</a>
    </div>
    </script>
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