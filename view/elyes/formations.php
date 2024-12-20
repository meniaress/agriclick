<?php 
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


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Agriclick</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
            <a href ="" id="returnHome" class="nav-item nav-link ">Accueil</a>
 
            <a href="" id ="returnoffre"class="nav-item nav-link ">cat/of Travail</a>
            <a href="../ServiceList.php" class="nav-item nav-link ">Services</a>
                 <div class="nav-item  dropdown d-flex">
                 <?php if ($isVeterinarian): ?>
                 <div class="nav-item  dropdown d-flex">
                     <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">suivi veterinaire</a>
                     <div class="dropdown-menu m-1">
                         <a href="../meniar/animal.php" class="dropdown-item"> Ajouter un animal</a>
                         <a href="../meniar/consult.php" class="dropdown-item">Créer une consultation</a>
                     </div>
                 </div>
                 <?php endif; ?>
 
 </div>          <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Partenariats</a>
                 <div class="dropdown-menu m-0">
                     <a href="formations.php" class="dropdown-item">Formations</a>
                     <a href="index.php" class="dropdown-item">Partenaires</a>
                 </div>
                 </div>
                 <a href="../form.php" class="nav-item nav-link">Reclamation</a>
                 
                 </div>
           <div class="d-flex">
                <a href="http://localhost/projet%202/view/front office/profile.php" class="nav-item nav-link" id="signin-btn">Voir le profil</a>
                <a href="http://localhost/projet%202/controllers/deconnexion.php" class="nav-item nav-link" id="signin-btn">se déconnecter</a>
                
            </div>
        </div>
        
    </nav>

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="mx-auto text-center mb-5" style="max-width: 500px;">
            <h3 class="text-primary text-uppercase">Workshops et Formations</h3>
        </div>
        <!-- Première formation -->
        <div class="row g-5 align-items-center mb-4">
            <div class="col-md-4">
                <div class="blog-item position-relative overflow-hidden">
                    <img class="img-fluid" src="img/blog-1.png" alt="Formation Agriculture Hydroponique">
                    <a class="blog-overlay" href="#">
                        <h4 class="text-white">Formation Agriculture Hydroponique</h4>
                        <span class="text-white fw-bold">Jan 21, 2025</span>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <h4>Cette formation vous offre :</h4>
                <ul>
                    <li>Une introduction théorique aux concepts de l’hydroponie.</li>
                    <li>Des ateliers pratiques pour installer et entretenir un système hydroponique.</li>
                    <li>Des techniques pour optimiser la croissance des plantes, réduire l’utilisation d’eau et augmenter les rendements.</li>
                </ul>
                <h4>Objectifs de la formation :</h4>
                <ul>
                    <li>Comprendre les principes de l’hydroponie.</li>
                    <li>Savoir choisir le matériel et les nutriments adaptés.</li>
                    <li>Être capable de concevoir et de gérer un système hydroponique efficace.</li>
                </ul>
                <span><strong>Durée :</strong> 3 jours intensifs (avec sessions théoriques et ateliers pratiques).</span><br>
                <span><strong>Lieu :</strong> Centre de formation agricole, Tunis.</span><br>
                <span><strong>Prix :</strong> 500 TND (incluant les supports pédagogiques).</span><br>
                <span><strong>Formation proposée en partenariat avec Agrimat.</strong></span><br>
                <a href="inscription.php?formation=Formation%20Agriculture%20Hydroponique" class="btn btn-primary mt-3">S'inscrire</a>

            </div>
            

            
            

        </div>
        <br>
        <!-- Deuxième formation -->
        <div class="row g-5 align-items-center mb-4">
            <div class="col-md-4">
                <div class="blog-item position-relative overflow-hidden">
                    <img class="img-fluid" src="img/compost.jpg" alt="Atelier Fabrication d'Engrais Naturels">
                    <a class="blog-overlay" href="#">
                        <h4 class="text-white">Atelier Fabrication d'Engrais Naturels</h4>
                        <span class="text-white fw-bold">Jan 28, 2025</span>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <h4>Cet atelier vous offre :</h4>
                <ul>
                    <li>Une introduction théorique sur les différentes méthodes de fabrication d'engrais naturels.</li>
                    <li>Des démonstrations pratiques pour créer des engrais à partir de matériaux organiques courants.</li>
                    <li>Des conseils sur l'utilisation des engrais naturels pour améliorer la qualité du sol et des cultures.</li>
                </ul>
                <h4>Objectifs de l'atelier :</h4>
                <ul>
                    <li>Comprendre les avantages des engrais naturels pour l'agriculture durable.</li>
                    <li>Apprendre à fabriquer des engrais à partir de déchets organiques.</li>
                    <li>Savoir choisir les bons ingrédients pour les besoins spécifiques de chaque type de culture.</li>
                </ul>
                <span><strong>Durée :</strong> 1 journée intensive (avec sessions théoriques et pratiques).</span><br>
                <span><strong>Lieu :</strong> Centre de formation agricole, Tunis.</span><br>
                <span><strong>Prix :</strong> 200 TND (incluant les supports pédagogiques).</span><br>
                <span><strong>Formation proposée en partenariat avec l'INAT.</strong></span><br>
                <a href="inscription.php?formation=Atelier%20Fabrication%20d'Engrais%20Naturels" class="btn btn-primary mt-3">S'inscrire</a>

            </div>
            
        </div>
        <br>


    </div>
</div>
<!-- Blog End -->



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
                window.location.href = "../indexcategorieclient.php";
                break;
            case 'Mécanicien':
                window.location.href = "../indexcategorieclient.php";
                break;
            case 'Saisonnier':
                window.location.href = "../indexcategorieclient.php";
                break;
            case 'Agriculteur':
                window.location.href = "../indexcategorie.php";
                break;
            default:
                window.location.href = "../indexcategorieclient.php";
                break;
        }
    });
    </script>

</body>

</html>