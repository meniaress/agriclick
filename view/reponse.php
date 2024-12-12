<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../controllers/repcontroller.php");
include_once("../model/rep.php");

$reponseController = new ReponseController();
$notification = null; // Variable for notifications

// Get the complaint ID from the URL
$id_rec = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu_reponse = trim($_POST["reponse"]);
    $admin_name = trim($_POST["name"]); // Get the admin name
    $type_reponse = trim($_POST["type"]); // Get the response type
    $date_rep = date('Y-m-d H:i:s'); // Get the current date and time

    // Validation des champs
    if (!empty($contenu_reponse) && !empty($admin_name) && !empty($type_reponse)) {
        // Vérification que le nom ne contient que des lettres et des espaces
        if (!preg_match("/^[a-zA-Z\s]+$/", $admin_name)) {
            $notification = "Erreur : Le nom ne doit contenir que des lettres et des espaces.";
        } else {
            // Pass the date to the constructor
            $reponse = new Reponse($contenu_reponse, $type_reponse, $admin_name, $date_rep, $id_rec);
            if ($reponseController->addReponse($reponse)) {
                
                // Redirect to the same page with a success parameter
                header('Location:../controllers/dashboard/listrep.php?success=1');
                exit();
            } else {
                $notification = "Erreur : Impossible d'ajouter la réponse.";
            }
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
    <title>Formulaire de Réponse - agriCLICK Admin</title>
    <link rel="stylesheet" ```html
    <link rel="stylesheet" href="../controllers/dashboard/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="../controllers/dashboard/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../controllers/dashboard/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../controllers/dashboard/img/icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
            display: none; /* Hide error message by default */
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="../controllers/dashboard/img/icon.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../controllers/dashboard/img/logo-mini.svg" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link" href="#">Gestion des Utilisateurs</a>
                    </li>
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link" href="#">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link" href="#">Gestion des offres</a>
                    </li>
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link" href="../controllers/Reclamationlist.php">Gestion des RECLAMATIONS</a>
                    </li>
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link active" href="../controllers\dashboard\listrep.php">Gestion des REPONSES</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Sidebar -->
        <div class="container-fluid page-body-wrapper">

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <div class="d-flex sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="../controllers/dashboard/img/faces/face29.png" alt="image">
                            <span class="sidebar-status-indicator"></span>
                        </div>
                        <div class="sidebar-profile-name">
                            <p class="sidebar-name">Khadija Derbel</p>
                            <p class="sidebar-designation">Welcome</p>
                        </div>
                    </div>
                    <div class="nav-search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                            <div class="input-group-append">
                                <span class="input-group-text" id="search">
                                    <i class="typcn typcn-zoom"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <p class="sidebar-menu-title">Dash menu</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">
                        <i class="typcn typcn-device-desktop menu-icon"></i>
                        <span class="menu-title">Dashboard <span class="badge badge-primary ml-3">New</span></span>
                    </a>
                </li>
                <!-- Add other sidebar items here -->
            </ul>
        </nav>
        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 font-weight-bold">Formulaire de Réponse</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <?php if (isset($notification)): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo htmlspecialchars($notification); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($_GET['success'])): ?>
                                    <p class="alert alert-success">Votre réponse a été soumise avec succès!</p>
                                <?php endif; ?>
                                <form id="responseForm" method="POST" action="">
                                    <div class="mb-3">
                                        <label for="reponse" class="form-label">Votre Réponse</label>
                                        <textarea id="reponse" name="reponse" class="form-control" rows="4" required></textarea>
                                        <span class="error-message" id="responseError">La réponse doit contenir au moins 5 caractères.</span>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" id="name" name="name" class="form-control bg-light border-0 px-4" placeholder="Votre Nom" style="height: 55px;" required>
                                        <span class="error-message" id="nameError">Le nom ne doit pas être vide et ne doit pas contenir de balises HTML.</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Type de Réponse:</label>
                                        <div>
                                            <input type="radio" id="normale" name="type" value="normale" required>
                                            <label for="normale">Normale</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="positive" name="type" value="positive" required>
                                            <label for="positive">Positive</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="negative" name="type" value="negative" required>
                                            <label for="negative">Négative</label>
                                        </div>
                                        <span class="error-message" id="typeError">Veuillez sélectionner un type de réponse.</span>
                                    </div>
                                    <div class="mb-3">
                                        <button id="submitButton" class="btn btn-secondary w-100 py-3" type="submit" disabled>Soumettre la réponse</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- base:js -->
    <script src="../controllers/dashboard/vendors/js/vendor.bundle.base.js"></script>
    <script src="../controllers/dashboard/js/off-canvas.js"></script>
    <script src="../controllers/dashboard/js/hoverable-collapse.js"></script>
    <script src="../controllers/dashboard/js/template.js"></script>
    <script src="../controllers/dashboard/js/settings.js"></script>
    <script src="../controllers/dashboard/js/todolist.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#reponse').on('input', function() {
                const responseText = $(this).val();
                const errorMessage = $('#responseError');
                const submitButton = $('#submitButton');

                if (responseText.length < 5) {
                    errorMessage.show(); // Show error message
                    submitButton.prop('disabled', true); // Disable submit button
                } else {
                    errorMessage.hide(); // Hide error message
                    submitButton.prop('disabled', false); // Enable submit button
                }
            });

            $('#name').on('input', function() {
                const nameText = $(this).val();
                const nameError = $('#nameError');
                const submitButton = $('#submitButton');

                if (nameText.trim() === '' || !/^[a-zA-Z\s]+$/.test(nameText)) {
                    nameError.show(); // Show error message
                    submitButton.prop('disabled', true); // Disable submit button
                } else {
                    nameError.hide(); // Hide error message
                    submitButton.prop('disabled', false); // Enable submit button
                }
            });

            $('input[name="type"]').on('change', function() {
                const typeError = $('#typeError');
                const submitButton = $('#submitButton');

                if ($('input[name="type"]:checked').length === 0) {
                    typeError.show(); // Show error message
                    submitButton.prop('disabled', true); // Disable submit button
                } else {
                    typeError.hide(); // Hide error message
                    submitButton.prop('disabled', false); // Enable submit button
                }
            });
        });
    </script>
</body>
</html>