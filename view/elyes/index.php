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
<!-- Navbar End -->



   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
    <!-- Banner Start -->
    <div class="container-fluid banner mb-5">
        <div class="container">
            <div class="row gx-0">
                <div class="col-md-6">
                    <div class="bg-primary bg-vegetable d-flex flex-column justify-content-center p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Nouveautés:</h3>
                        <p class="text-white">Profitez de réductions et codes promotionnels avec nos partenaires allant jusqu'à 40% en vous inscrivant sur notre site.</p>
                        <a class="text-white fw-bold" href="">S'inscrire maintenant<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-secondary bg-fruit d-flex flex-column justify-content-center p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Événements:</h3>
                        <p class="text-white">Découvrez notre séléction de workshops, ateliers et formations en collaboration avec nos partenaires.</p>
                        <a class="text-white fw-bold" href="formations.html">Lire plus<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Start -->


    <!-- About Start -->
    <div class="container-fluid about pt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="d-inline-block border border-5 border-primary border-bottom-0">
                        <img class="img-fluid" src="img/logo.png">
                    </div>
                </div>
                <div class="col-lg-6 pb-5">
                    <div class="mb-3 pb-2">
                        <h5 class="text-primary text-uppercase">About Us</h5>
                        <h1 class="display-5">Pourquoi Devenir Partenaire?</h1>
                    </div>
                    <p class="mb-4">Devenir partenaire de notre plateforme, c’est rejoindre un réseau dynamique dédié à l’agriculture et à l’alimentation. Ensemble, nous créons des opportunités pour les jeunes, soutenons les agriculteurs et promouvons des solutions innovantes pour un secteur plus durable. En collaborant avec nous, vous bénéficiez d’une visibilité accrue, d’un accès direct à une communauté engagée et d’un impact concret sur le développement local et national. Rejoignez-nous pour construire un avenir prospère et responsable dans le monde agricole.</p>
                                    <!-- Bouton qui fait défiler vers le formulaire -->
                <a href="#partnership-form" class="btn btn-primary py-md-3 px-md-5">Demander un partenariat</a>
            </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- About End -->


   
    

    <!-- Partenariats Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Affichage des Partenariats -->
            <?php
            require_once '../../model/partnershipsDisplay.php';

            // Affichage des partenariats acceptés uniquement
            fetchAndDisplayPartnerships(true);  // false pour afficher tous les partenariats, y compris ceux qui sont acceptés
            ?>   
          
        </div>
    </div>
</div>






<!-- Partenariats End -->

<!-- Partnership form Start -->
<div class="container-fluid bg-primary feature py-5 pb-lg-0 my-5">
    <div class="container py-5 pb-lg-0" id="partnership-form">
        <div class="row g-5">
            <div class="col-lg-3">
                <!-- Autres éléments de "Features" ici -->
            </div>
            <div class="col-lg-6">
                <!-- Formulaire de demande de partenariat -->
                <div class="d-block bg-white h-100 text-center p-5 pb-lg-0">
                    <h4 class="text-primary mb-4">Demande de Partenariat</h4>
                    <form id="partnershipForm" action="../../controllers/elyes/partnershipform.php" method="post" enctype="multipart/form-data" class="text-start">
                        <div class="mb-3">
                            <label for="partnerName" class="form-label">Nom de l'organisation</label>
                            <input type="text" class="form-control" name="nom_organisation" id="partnerName" placeholder="Ex : AgriTech Tunisie">
                            <div id="partnerNameError" class="text-danger" style="display:none;">Le nom de l'organisation est requis.</div>
                        </div>
                        <div class="mb-3">
                            <label for="contactName" class="form-label">Nom du responsable</label>
                            <input type="text" class="form-control" name="nom_responsable" id="contactName" placeholder="Ex : Yassine Ben Ali">
                            <div id="contactNameError" class="text-danger" style="display:none;">Le nom du responsable est requis.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" name="e_mail" id="email" placeholder="exemple@mail.com">
                            <div id="emailError" class="text-danger" style="display:none;">Veuillez entrer un email valide.</div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Numéro de téléphone</label>
                            <input type="text" class="form-control" name="numéro" id="phone" placeholder="+216 99 123 456">
                            <div id="phoneError" class="text-danger" style="display:none;">Veuillez entrer un numéro de téléphone valide.</div>
                        </div>
                        <div class="mb-3">
                            <label for="partnershipType" class="form-label">Type de partenariat souhaité</label>
                            <select class="form-select" name="type_partenariat" id="partnershipType">
                                <option selected disabled>Choisir...</option>
                                <option>Formation</option>
                                <option>Soutien financier</option>
                                <option>Services professionnels</option>
                                <option>Promotion mutuelle</option>
                            </select>
                            <div id="partnershipTypeError" class="text-danger" style="display:none;">Veuillez choisir un type de partenariat.</div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description de l'organisation</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Décrivez brièvement votre organisation et comment vous souhaitez contribuer"></textarea>
                            <div id="descriptionError" class="text-danger" style="display:none;">Veuillez décrire brièvement votre organisation.</div>
                        </div>
                        <div class="mb-3">
                            <label for="imageUpload" class="form-label">Logo de l'organisation</label>
                            <input type="file" class="form-control" name="image" id="imageUpload" accept="image/*">
                            <div id="imageError" class="text-danger" style="display:none;">Veuillez sélectionner un fichier image valide.</div>
                        </div>                        
                        <button type="submit" class="btn btn-primary w-100">Soumettre la demande</button>
                    </form>

                    
                </div>
            </div>
            <div class="col-lg-3">
                <!-- Autres éléments de "Features" ici -->
            </div>
        </div>
    </div>
</div>
<!-- Partnership form End -->

  <!-- Facts Start -->
  <div class="container-fluid bg-primary facts py-5 mb-5">
    <div class="container py-5">
        <div class="row gx-5 gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="d-flex">
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa fa-star fs-4 text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white">Our Experience</h5>
                        <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex">
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa fa-users fs-4 text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white">Partenaires</h5>
                        <h1 class="display-5 text-white mb-0" data-toggle="counter-up">13</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex">
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa fa-check fs-4 text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white">Projets Accomplis</h5>
                        <h1 class="display-5 text-white mb-0" data-toggle="counter-up">26</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex">
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fa fa-mug-hot fs-4 text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white">Clients Satisfaits</h5>
                        <h1 class="display-5 text-white mb-0" data-toggle="counter-up">1629</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->

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