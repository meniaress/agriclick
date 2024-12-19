<?php
// Include the database configuration file
require_once 'database.php';
include_once '../model/Reclamation.php';

class ReclamationList {
    // Method to display complaints
    public function AfficherReclamation() {
        $sql = 'SELECT * FROM reclamtion'; // Ensure the table name is correct
        $db = Config::getConnexion(); // Ensure this method returns a PDO instance
        try {
            $list = $db->query($sql);
            return $list->fetchAll(PDO::FETCH_ASSOC); // Retrieve all results
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

// Create an instance of the ReclamationList class
$reclamationList = new ReclamationList();
$offers = $reclamationList->AfficherReclamation(); // Retrieve complaints

session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liste des Réclamations - agriCLICK Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="dashboard/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="dashboard/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="dashboard/img/icon.png" />
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="dashboard/img/icon.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="dashboard/img/logo-mini.svg" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="#">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="../view/indexadmincat.php">Gestion des offres et categories
                        </a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link active" href="Reclamationlist.php">
                Gestion des reclamations
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="dashboard/listrep.php">
                Gestion des reponses
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

        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                       
                        <p class="sidebar-menu-title">Dash menu</p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://localhost/projet%202/view/back%20office/statistique.php" aria-expanded="false" aria-controls="auth">
                <i class="typcn typcn-user-add-outline menu-icon"></i>
                <span class="menu-title">Statistiques des Clients</span>
                <i class="menu-arrow"></i>
              </a>
             
            </li>
                    <li class="nav-item">
                    <a class="nav-link " href="dashboard/statistiques.php">
                        <i class="typcn typcn-device-desktop menu-icon"></i>
                        <span class="menu-title ">Statistiques des Réponses<span class="badge badge-primary ml-3">New</span></span>
                        
                    </a>
                </li>
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <h1 class="mb-4">Liste des Réclamations</h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Sujet</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Display complaints
                                        foreach ($offers as $offer) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($offer['nom']) . '</td>';
                                            echo '<td>' . htmlspecialchars($offer['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($offer['sujet']) . '</td>';
                                            echo '<td>' . htmlspecialchars($offer['message']) . '</td>';
                                            echo '<td>' . (isset($offer['status']) && $offer['status'] !== '' ? htmlspecialchars($offer['status']) : 'Non défini') . '</td>'; // Check for 'status'
                                            
                                            echo '<td class="actions">
                                                    <a href="updaterec.php?id=' . htmlspecialchars($offer['id']) . '" class="btn btn-warning btn-sm">Modifier</a>
                                                    <a href="deleterec.php?id=' . htmlspecialchars($offer['id']) . '" class="btn btn-danger btn-sm">Supprimer</a>
                                                    <a href="../view/reponse.php?id=' . htmlspecialchars($offer['id']) . '" class="btn btn-info btn-sm">Répondre</a>
                                                  </td>';
                                            
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if (empty($offers)): ?>
                                <div class="text-center mt-4">
                                    <p class="text-muted">Aucune réclamation trouvée.</p>
                                </div>
                            <?php endif; ?>
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