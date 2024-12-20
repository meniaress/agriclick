<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FarmFresh - Organic Farm Website Template</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <!-- Navbar Start -->
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
               <a href="" class="nav-item nav-link ">Accueil</a>
                <a href="../indexcategorieclient.php" class="nav-item nav-link ">cat/of Travail</a>
                <a href="../ServiceList.php" class="nav-item nav-link ">Services</a>
                <div class="nav-item dropdown d-flex">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">suivi veterinaire</a>
                    <div class="dropdown-menu m-0">
                        <a href="animal.php" class="dropdown-item"> Ajouter un animal </a>
                        <a href="consult.php" class="dropdown-item">Créer une consultation</a>
                    </div>
                    <div class="nav-item dropdown d-flex">
                 <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Partenariats</a>
                 <div class="dropdown-menu m-7">
                     <a href="../elyes/formations.php" class="dropdown-item">Formations</a>
                     <a href="../elyes/index.php" class="dropdown-item">Partenaires</a>
                 </div>
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
      <!-- consult Form Start -->
  <!-- consult Form Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4">Créer une nouvelle consultation</h2>
                <form id="consult" action="addconsult.php" method="POST">
                    <div class="mb-3">
                        <label for="id_ani" class="form-label">Nom de l'animal</label>
                        <select class="form-control" id="id_ani" name="id_ani" required>
                            <?php
                            include_once '../../controllers/crudconsult.php';
                            include_once '../../model/animals.php';
                            $consultController = new Crudconsult();
                            $animalList = $consultController->getAllAnimals();
                            if (!empty($animalList)) {
                                foreach ($animalList as $animal) {
                                    echo "<option value='" . $animal["id_ani"] . "'>" . $animal["nom_ani"]  . "</option>";
                                }
                            } else {
                                echo "<option>No animals found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div
                    <input type="hidden" name="id_ani" value="1">
                    </form>

                    <div class="mb-3">
                        <label for="nomp" class="form-label">Nom propriétaire</label>
                        <input type="text" class="form-control" id="nomp" name="nomp" required>
                    </div>

                    <div class="mb-3">
                        <label for="telp" class="form-label">Tel propriétaire</label>
                        <input type="text" class="form-control" id="telp" name="telp">
                    </div>

                    <div class="mb-3">
                        <label for="antmedicaux" class="form-label">Antécedants medicaux</label>
                        <input type="text" class="form-control" id="antmedicaux" name="antmedicaux" required>
                    </div>

                    <div class="mb-3">
                        <label for="diagnostic" class="form-label">Diagnostic</label>
                        <textarea class="form-control" id="diagnostic" name="diagnostic" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="reco" class="form-label">Recommandations</label>
                        <input type="text" class="form-control" id="reco" name="reco" required>
                    </div>

                    <div class="mb-3">
                        <label for="datec" class="form-label">Date de consultation</label>
                        <input type="date" class="form-control" id="datec" name="datec" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- consult Form End -->
<?php
    
    include_once '../../controllers/crudconsult.php';
    $consultController = new Crudconsult();
    $consultList = $consultController->listconsult();
    ?>
<!-- affichage -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="rounded h-100 p-4" style="background-color: #002400">
                <h6 class="mb-4">Liste des consultations</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom de l'animal</th>
                                <th scope="col">Nom propriétaire</th>
                                <th scope="col">Tel propriétaire</th>
                                <th scope="col">Antécedants medicaux</th>
                                <th scope="col">Diagnostic</th>
                                <th scope="col">Recommandations</th>
                                <th scope="col">Date consultation</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($consultList)) {
                                $index = 1;
                                foreach ($consultList as $consult) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $index++; ?></th>
                                    <td hidden="hidden"><?= $consult['id_consult']; ?></td>
                                    <td hidden="hidden"><?= $consult['id_ani']; ?></td>
                                    <td><?= isset($consult['nomanimal']) && !empty($consult['nomanimal']) ? $consult['nomanimal'] : 'Unknown'; ?></td>
                                    <td><?= $consult['nomp']; ?></td>
                                    <td><?= $consult['telp']; ?></td>
                                    <td><?= $consult['antmedicaux']; ?></td>
                                    <td><?= $consult['diagnostic']; ?></td>
                                    <td><?= $consult['reco']; ?></td>
                                    <td><?= $consult['datec']; ?></td>
                                    <td>
                                        <a href="deleteconsult.php?id_consult=<?= $consult['id_consult']; ?>" class="btn btn-outline-danger m-2">Delete</a>
                                        <a href="updateconsult.php?id_consult=<?= $consult['id_consult']; ?>" class="btn btn-outline-success m-2">Update</a>
                                    </td>
                                </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="9">No consultation found.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end affichage -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

   <script>
document.getElementById('consult').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    let isValid = true;

    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(function(el) {
        el.remove();
    });

    // Validate text inputs
    [ 'nomp','telp', 'antmedicaux', 'diagnostic','reco'].forEach(function(id) {
        const input = document.getElementById(id);
        if (input.value.length < 3 || input.value.length > 20) {
            isValid = false;
            const error = document.createElement('div');
            error.className = 'error-message text-danger';
            error.innerText = 'Must be between 3 and 20 characters';
            input.parentNode.appendChild(error);
        }
    });

    // Validate date input
    const dateInput = document.getElementById('datec');
    if (!dateInput.value) {
        isValid = false;
        const error = document.createElement('div');
        error.className = 'error-message text-danger';
        error.innerText = 'This field is required';
        dateInput.parentNode.appendChild(error);
    }

    // If the form is valid, submit the form
    if (isValid) {
        alert('Form submitted successfully!');
        document.getElementById('consult').submit(); // Submit the form manually
    }
});



    // Validate number inputs
    /*['telp'].forEach(function(id) {
        const input = document.getElementById(id);
        if (!input.value) {
            isValid = false;
            const error = document.createElement('div');
            error.className = 'error-message text-danger';
            error.innerText = 'This field is required';
            input.parentNode.appendChild(error);
        }
    });*/

    
</script>



    <!-- Hero Start -->
    


    <!-- Testimonial End -->
    

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