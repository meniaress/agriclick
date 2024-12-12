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
            <!-- Dropdown for Partenariats -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Partenariats</a>
                <div class="dropdown-menu m-0">
                    <a href="formations.html" class="dropdown-item">Formations</a>
                    <a href="index.html" class="dropdown-item">Partenaires</a>
                </div>
            </div>
            <a href="about.html" class="nav-item nav-link">About</a>
            <a href="service.html" class="nav-item nav-link">Service</a>
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
            require_once '../Models/partnershipsDisplay.php';

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
                    <form id="partnershipForm" action="../Controller/partnershipform.php" method="post" enctype="multipart/form-data" class="text-start">
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
                                <p class="text-white mb-0">+216 70 777 666</p>
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
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Our Services</a>
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
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Our Services</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Meet The Team</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Latest Blog</a>
                                <a class="text-white" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Contact Us</a>
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
            <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">AgriCLICK</a>. All Rights Reserved. Designed by <a class="text-secondary fw-bold" href="https://htmlcodex.com">HTML Codex</a></p>
            <br>Distributed By: <a class="text-secondary fw-bold" href="https://themewagon.com" target="_blank">ECOVISIONNAIRE</a>
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