<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AgriCLICK</title>
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
    
<?php
// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Connexion à la base de données
        $bddPDO = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
        $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer les informations du partenariat
        $query = "SELECT * FROM partenariats WHERE id = :id";
        $stmt = $bddPDO->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Vérification si un partenariat a été trouvé
        if ($stmt->rowCount() > 0) {
            $partenaire = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Partenariat non trouvé.";
            exit();
        }

    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_org = $_POST['nom_organisation'];
    $nom_resp = $_POST['nom_responsable'];
    $e_mail = $_POST['e_mail'];
    $num = $_POST['numéro'];
    $type_part = $_POST['type_partenariat'];
    $des = $_POST['description'];
    $status = $_POST['status'];
    

    try {
        // Mettre à jour les données dans la base
        $updateQuery = "UPDATE partenariats SET 
                        `Nom de l'organisation` = :nom_org, 
                        `Nom du responsable` = :nom_resp, 
                        `Numéro de téléphone` = :num, 
                        `Adresse e-mail` = :e_mail, 
                        `Type de partenariat` = :type_part, 
                        `Description` = :des,
                        `Status` = :status

                        WHERE id = :id";
        
        $stmt = $bddPDO->prepare($updateQuery);
        $stmt->bindParam(':nom_org', $nom_org);
        $stmt->bindParam(':nom_resp', $nom_resp);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':e_mail', $e_mail);
        $stmt->bindParam(':type_part', $type_part);
        $stmt->bindParam(':des', $des);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Rediriger après la mise à jour
            header("Location: dash.php?update=1");
            exit();
        } else {
            echo "Erreur : La mise à jour a échoué.";
        }
    } catch (PDOException $e) {
        echo "Erreur de mise à jour : " . $e->getMessage();
    }
}
?>

<!-- Formulaire de modification -->
 <center>
<form method="POST" onsubmit="return validateForm()">
    <label for="partnerName">Nom de l'organisation</label>
    <input type="text" name="nom_organisation" id="partnerName" value="<?= htmlspecialchars($partenaire["Nom de l'organisation"]) ?>" required>
    <small id="partnerNameError" class="error-message"></small>
    <br>
    <label for="contactName">Nom du responsable</label>
    <input type="text" name="nom_responsable" id="contactName" value="<?= htmlspecialchars($partenaire['Nom du responsable']) ?>" required>
    <small id="contactNameError" class="error-message"></small>
    <br>
    <label for="email">Adresse email</label>
    <input type="email" name="e_mail" id="email" value="<?= htmlspecialchars($partenaire['Adresse e-mail']) ?>" required>
    <small id="emailError" class="error-message"></small>
    <br>
    <label for="phone">Numéro de téléphone</label>
    <input type="text" name="numéro" id="phone" value="<?= htmlspecialchars($partenaire['Numéro de téléphone']) ?>" required>
    <small id="phoneError" class="error-message"></small>
    <br>
    <label for="partnershipType">Type de partenariat</label>
    <select name="type_partenariat" id="partnershipType" required>
        <option value="">--Choisir un type--</option>
        <option <?= $partenaire['Type de partenariat'] == 'Formation' ? 'selected' : '' ?>>Formation</option>
        <option <?= $partenaire['Type de partenariat'] == 'Soutien financier' ? 'selected' : '' ?>>Soutien financier</option>
        <option <?= $partenaire['Type de partenariat'] == 'Services professionnels' ? 'selected' : '' ?>>Services professionnels</option>
        <option <?= $partenaire['Type de partenariat'] == 'Promotion mutuelle' ? 'selected' : '' ?>>Promotion mutuelle</option>
    </select>
    <small id="partnershipTypeError" class="error-message"></small>
    <br>
    <label for="description">Description</label>
    <textarea name="description" id="description" required><?= htmlspecialchars($partenaire['Description']) ?></textarea>
    <small id="descriptionError" class="error-message"></small>
    <br>
    <label for="status">Statut du partenariat</label>
    <select name="status" id="status">
        <option value="en attente" <?= $partenaire['Status'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
        <option value="accepté" <?= $partenaire['Status'] == 'accepté' ? 'selected' : '' ?>>Accepté</option>
        <option value="refusé" <?= $partenaire['Status'] == 'refusé' ? 'selected' : '' ?>>Refusé</option>
    </select>
    <small id="statusError" class="error-message"></small>

    <button type="submit">Modifier</button>
</form>
</center>

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