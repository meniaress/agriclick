<?php
// Inclure le fichier de configuration de la base de données
require_once '../database.php';
include_once '../../model/rep.php';

class ReponseList {
    // Méthode pour afficher les réponses
    public function AfficherReponse($type = null) {
        // Join the reponse table with the reclamation table
        $sql = 'SELECT r.*, rec.sujet, rec.message 
                FROM reponse r 
                JOIN reclamtion rec ON r.id_rec = rec.id'; // Adjust the table and column names as necessary

        // If a type is specified, filter the results
        if ($type) {
            $sql .= ' WHERE r.type = :type';
        }

        $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO
        try {
            $stmt = $db->prepare($sql);
            if ($type) {
                $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les résultats
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}

// Créer une instance de la classe ReponseList
$reponseList = new ReponseList();

// Get the type from the GET request if it exists
$type = isset($_GET['type']) ? $_GET['type'] : null;
$responses = $reponseList->AfficherReponse($type); // Récupérer les réponses

session_start(); // Démarrer la session
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liste des Réponses - agriCLICK Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="img/icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="img/icon.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="img/logo-mini.svg" alt="logo"/></a>
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
                        <a class="nav-link" href="../Reclamationlist.php">Gestion des RECLAMATIONS</a>
                    </li>
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link active" href="#">Gestion des REPONSES</a>
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
                            
                            <img src="img/faces/face29.png" alt="image">
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
                        <h3 class="mb-0 font-weight-bold">Liste des Réponses</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Liste des Réponses</h4>
                                    <!-- Recherche par type -->
                                    <form method="GET" action="listrep.php" style="text-align: center; margin:20px;">
                                        <label for="type">Recherche par type de réponse:</label>
                                        <select name="type" id="type">
                                            <option value="">--Tous les types--</option>
                                            <option value="normale" <?php echo (isset($type) && $type == 'normale') ? 'selected' : ''; ?>>Normale</option>
                                            <option value="positive" <?php echo (isset($type) && $type == 'positive') ? 'selected' : ''; ?>>Positive</option>
                                            <option value="negative" <?php echo (isset($type) && $type == 'negative') ? 'selected' : ''; ?>>Négative</option>
                                        </select>
                                        <button type="submit">Rechercher</button>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Sujet de Réclamation</th>
                                                <th>Message de Réclamation</th>
                                                <th>Contenu</th>
                                                <th>Admin</th>
                                                <th>Type</th>
                                                <th>Date de Réponse</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($responses as $response) {
                                                echo '<tr>'; 
                                                echo '<td>' . htmlspecialchars($response['sujet']) . '</td>';
                                                echo '<td>' . htmlspecialchars($response['message']) . '</td>';
                                                echo '<td>' . htmlspecialchars($response['contenu']) . '</td>';
                                                echo '<td>' . htmlspecialchars($response['admin']) . '</td>';
                                                echo '<td>' . htmlspecialchars($response['type']) . '</td>';
                                                echo '<td>' . htmlspecialchars($response['date_rep']) . '</td>';
                                                echo '<td class="actions">
                                                        <a href="../updaterep.php?id_rep=' . htmlspecialchars($response['id_rep']) . '" class="btn btn-warning btn-sm">Modifier</a>
                                                        <a href="../deleterep.php?id_rep=' . htmlspecialchars($response['id_rep']) . '" class="btn btn-danger btn-sm">Supprimer</a>
                                                      </td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if (empty($responses)): ?>
                                    <div class="text-center mt-4">
                                        <p class="text-muted">Aucune réponse trouvée.</p>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
</body>
</html>