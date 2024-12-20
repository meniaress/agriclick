<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("repcontroller.php"); // Ensure this file contains the ReponseController class
include_once("../model/rep.php"); // Ensure the path is correct

$reponsecontroller = new ReponseController(); // Correct class name
$offer = null;

if (isset($_GET['id_rep']) && !empty($_GET['id_rep'])) { // Check if 'id_rep' is set and not empty
    $id_rep = $_GET['id_rep']; // Change variable name to match
    $db = Config::getConnexion();
    
    // Récupérer la réponse à modifier
    $sql = "SELECT * FROM reponse WHERE id_rep = :id_rep"; // Use 'id_rep' in the query
    $req = $db->prepare($sql);
    $req->bindValue(':id_rep', $id_rep); // Bind the correct variable
    
    try {
        $req->execute();
        $offer = $req->fetch(PDO::FETCH_ASSOC);
        
        // Check if the offer was found
        if (!$offer) {
            die('Erreur: Réponse non trouvée.');
        }
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
} else {
    die('Erreur: ID non spécifié.'); // More informative error message
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = trim($_POST["contenu"]);
    $admin = trim($_POST["admin"]);
    $type = trim($_POST["type"]);

    if (!empty($contenu) && !empty($admin) && !empty($type)) {
        // Mettre à jour la réponse
        $sql = "UPDATE reponse SET contenu = :contenu, admin = :admin, type = :type WHERE id_rep = :id_rep"; // Use 'id_rep' in the query
        $req = $db->prepare($sql);
        $req->bindValue(':contenu', $contenu);
        $req->bindValue(':admin', $admin);
        $req->bindValue(':type', $type);
        $req->bindValue(':id_rep', $id_rep); // Bind the correct variable
        
        try {
            $req->execute();
            header('Location: dashboard/listrep.php?success=1'); // Redirect to the response list after update
            exit();
        } catch (Exception $e) {
            echo '<h1>Error: Could not update response.</h1>';
            echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>'; // Display the error message for debugging
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
    <title>Modifier Réponse - agriCLICK Admin</title>
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
       <!-- Navbar -->
       <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="../view/elyes/dash.php">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="../view/indexadmincat.php">Gestion des offres et categories
                        </a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="Reclamationlist.php">
                Gestion des reclamations
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link active" href="dashboard/listrep.php">
                Gestion des reponses
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../view/meniar/dash.php">
                Gestion de suivi
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link a" href="../view/dash.php">
                Gestion des commandes et des services
              </a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link"  href="../view/back office/client_liste.php">Gestion des Utilisateurs</a>
                    </li>
                </ul>
            
            </div>
        </nav>

        <!-- Sidebar -->
    <div class="container-fluid page-body-wrapper">

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                   
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
                        <h3 class="mb-0 font-weight-bold">Modifier Réponse</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <?php if (isset($_GET['success'])): ?>
                                    <p class="alert alert-success">Votre réponse a été mise à jour avec succès!</p>
                                <?php endif; ?>
                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="contenu" class="form-label">Votre Réponse</label>
                                        <input type="text" name="contenu" class="form-control bg-light border-0 px-4" placeholder="Votre réponse" style="height: 55px;" value="<?php echo htmlspecialchars($offer['contenu']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="admin" class="form-label">Nom de l'admin</label>
                                        <input type="text" name="admin" class="form-control bg-light border-0 px-4" placeholder="Nom de l'admin" style="height: 55px;" value="<?php echo htmlspecialchars($offer['admin']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Type de Réponse:</label>
                                        <div>
                                            <input type="radio" id="normale" name="type" value="normale" <?php echo ($offer['type'] == 'normale') ? 'checked' : ''; ?>>
                                            <label for="normale">Normale</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="positive" name="type" value="positive" <?php echo ($offer['type'] == 'positive') ? 'checked' : ''; ?>>
                                            <label for="positive">Positive</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="negative" name="type" value="negative" <?php echo ($offer['type'] == 'negative') ? 'checked' : ''; ?>>
                                            <label for="negative">Négative</label>
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