<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("ReclamationController.php");
include_once("../model/Reclamation.php"); // Ensure the path is correct

$reclamationController = new ReclamationController();
$offer = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = Config::getConnexion();
    
    // Récupérer la réclamation à modifier
    $sql = "SELECT * FROM reclamtion WHERE id = :id"; // Corrected table name
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id);
    
    try {
        $req->execute();
        $offer = $req->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
} else {
    die('ID non spécifié.');
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $sujet = trim($_POST["subject"]);
    $message = trim($_POST["message"]);
    $status = isset($_POST["statut"]) ? trim($_POST["statut"]) : ''; // Capture the status

    if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
        // Mettre à jour la réclamation
        $sql = "UPDATE reclamation SET nom = :nom, email = :email, sujet = :sujet, message = :message, status = :status WHERE id = :id"; // Corrected table name
        $req = $db->prepare($sql);
        $req->bindValue(':nom', $nom);
        $req->bindValue(':email', $email);
        $req->bindValue(':sujet', $sujet);
        $req->bindValue(':message', $message);
        $req->bindValue(':status', $status); // Bind the status
        $req->bindValue(':id', $id);
        
        try {
            $req->execute();
            header('Location: Reclamationlist.php?success=1'); // Redirect to the reclamation list after update
            exit();
        } catch (Exception $e) {
            echo '<h1>Error: Could not update reclamation.</h1>';
            echo '<p>' . $e->getMessage() . '</p>'; // Display the error message for debugging
        }
    } else {
        echo '<h1>Error: All fields are required.</h1>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modifier Réclamation - agriCLICK Admin</title>
    <link rel="stylesheet" href="dashboard/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="dashboard/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="dashboard/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="dashboard/img/icon.png" />
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
                <a class="navbar-brand brand-logo" href="index.html"><img src="dashboard/img/icon.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="dashboard/img/logo-mini.svg" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle=" minimize">
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
                        <a class="nav-link active" href="Reclamationlist.php">Gestion des RECLAMATIONS</a>
                    </li>
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link" href="dashboard\listrep.php">Gestion des REPONSES</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Sidebar -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <div class="d-flex sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="dashboard/img/faces/face29.png" alt="image">
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
                        <h3 class="mb-0 font-weight-bold">Modifier Réclamation</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <?php if (isset($_GET['success'])): ?>
                                    <p class="alert alert-success">Votre réclamation a été mise à jour avec succès!</p>
                                <?php endif; ?>
                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Votre Nom</label>
                                        <input type="text" name="name" class="form-control bg-light border-0 px-4" placeholder="Votre Nom" style="height: 55px;" value="<?php echo htmlspecialchars($offer['nom']); ?>" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Votre Email</label>
                                        <input type="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Votre Email" style="height: 55px;" value="<?php echo htmlspecialchars($offer['email']); ?>" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Sujet</label>
                                        <input type="text" name="subject" class="form-control bg-light border-0 px-4" placeholder="Sujet" style="height: 55px;" value="<?php echo htmlspecialchars($offer['sujet']); ?>" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea name="message" class="form-control bg-light border-0 px-4 py-3" rows="2" placeholder="Message" required readonly><?php echo htmlspecialchars($offer['message']); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <h6>Statut</h6>
                                        <div>
                                            <input type="radio" id="nonTraite" name="statut" value="non traitée" <?php echo (isset($offer['status']) && $offer['status'] == 'non traitée') ? 'checked' : ''; ?>>
                                            <label for="nonTraite">Non traitée</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="traite" name="statut" value="traitée" <?php echo (isset($offer['status']) && $offer['status'] == 'traitée') ? 'checked' : ''; ?>>
                                            <label for="traite">Traitée</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-secondary w-100 py-3" type="submit">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- base:js -->
    <script src="dashboard/vendors/js/vendor.bundle.base.js"></script>
    <script src="dashboard/js/off-canvas.js"></script>
    <script src="dashboard/js/hoverable-collapse.js"></script>
    <script src="dashboard/js/template.js"></script>
    <script src="dashboard/js/settings.js"></script>
    <script src="dashboard/js/todolist.js"></script>
</body>
</html>