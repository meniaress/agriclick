<?php
// Include the database configuration file
require_once '../database.php';

class Statistiques {
    public function getStatistiques() {
        $sql = 'SELECT type, COUNT(*) as count FROM reponse GROUP BY type';
        $db = Config::getConnexion(); 
        try {
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}

// Create an instance of the Statistiques class
$statistiques = new Statistiques();
$data = $statistiques->getStatistiques(); 

session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Statistiques des Réponses - agriCLICK Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="img/icon.png" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
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
                  
                <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="#">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="../../view/indexadmincat.php">Gestion des offres et categories
                        </a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../Reclamationlist.php">
                Gestion des reclamations
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="listrep.php">
                Gestion des reponses
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../../view/dash.php">
                Gestion des commandes et des services
              </a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link"  href="../../view/back office/client_liste.php">Gestion des Utilisateurs</a>
                    </li>
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link active" href="statistiques.php">Statistiques</a>
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
                            <span class="menu-title">Dashboard <span class="badge badge-primary ml-3">New</span></span>
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
                        <a class="nav-link active" href="statistiques.php">
                            <i class="typcn typcn-chart-bar menu-icon"></i>
                            <span class="menu-title">Statistiques des Réponses</span>
                        </a>
                    </li>
                    <!-- Add other sidebar items here -->
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <h3 class="mb-4">Statistiques des Réponses</h3>
                    <canvas id="responseChart" width="400" height="200"></canvas> 
                </div>
            </div>
        </div>
    </div>

    <script>
        const data = {
            labels: ['Normal', 'Positif', 'Négatif'], 
            datasets: [{
                label: 'Taux de Réponses',
                data: [
                    <?php
                    $normal = 0; 
                    $positive = 0; 
                    $negative = 0; 

                    foreach ($data as $row) {
                        if ($row['type'] === 'normale') {
                            $normal = $row['count']; 
                        } elseif ($row['type'] === 'positive') {
                            $positive = $row['count']; 
                        } elseif ($row['type'] === 'négative') {
                            $negative = $row['count']; 
                        }
                    }
                    echo htmlspecialchars($normal) . ', ';
                    echo htmlspecialchars($positive) . ', ';
                    echo htmlspecialchars($negative);
                    ?>
                ],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: false,
                tension: 0.1 
            }]
        };
        const config = {
            type: 'bar', 
            data: data,
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Taux de Réponses' 
                        },
                        beginAtZero: true,
                        min: 0, 
                        max: 100
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Types de Réponses' 
                        }
                    }
                }
            }
        };
        const responseChart = new Chart(
            document.getElementById('responseChart'),
            config
        );
    </script>
    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
</body>
</html>