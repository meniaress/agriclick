<?php
include_once 'C:\xampp\htdocs\projet%202\model\client.php';
include_once 'C:\xampp\htdocs\projet%202\controllers\databasee.php';
require_once 'C:\xampp\htdocs\projet%202\controllers\clientc.php';

// Créer une instance du contrôleur ClientC
$clientC = new ClientC();

// Récupérer le nombre de clients pour chaque choix
$saisonnierCount = $clientC->countClientsByChoice('Saisonnier');
$veterinaireCount = $clientC->countClientsByChoice('Vétérinaire');
$agriculteurCount = $clientC->countClientsByChoice('Agriculteur');
$mecanicienCount = $clientC->countClientsByChoice('Mécanicien');

// Récupérer le nombre de comptes créés par date
$creationData = $clientC->countClientsByCreationDate();
$creationLabels = [];
$creationCounts = [];
foreach ($creationData as $row) {
    $creationLabels[] = $row['creation_date'];
    $creationCounts[] = $row['count'];
}

// Récupérer les statistiques des connexions
$loginData = $clientC->getLoginStatistics();
$loginLabels = [];
$loginCounts = [];

foreach ($loginData as $row) {
    $loginLabels[] = $row['login_date'];
    $loginCounts[] = $row['count'];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Clients</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Ajoutez vos autres fichiers CSS ici -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }
        canvas {
            max-width: 100%;
        }
    </style>
</head>
<body>
<div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="img/logo-mini.svg" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link " href="client_liste.php">Gestion des Utilisateurs</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="#">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="#">Gestion des offres</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="#">
                Gestion des offres
              </a>
            </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-name">
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
              <a class="nav-link" href="">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard </span>
              </a>
            </li>
            
           
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://localhost/projet%202/view/back%20office/statistique.php" aria-expanded="false" aria-controls="auth">
                <i class="typcn typcn-user-add-outline menu-icon"></i>
                <span class="menu-title">Statistiques des Clients</span>
                <i class="menu-arrow"></i>
              </a>
             
            </li>
          </ul>
        </nav>
        
            <!-- Main content -->
            <div class="main-panel">
                <div class="content-wrapper">
    <div class="container">
        <h1>Statistiques des Clients</h1>
        
        <div class="chart-container">
            <canvas id="choixChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="creationChart"></canvas>
        </div>

        <!-- Nouveau graphique pour les connexions -->
        <div class="chart-container">
            <canvas id="loginChart"></canvas>
        </div>

        <script>
            // Données dynamiques venant du PHP pour le premier graphique
            var saisonnier = <?php echo $saisonnierCount; ?>;
            var veterinaire = <?php echo $veterinaireCount; ?>;
            var agriculteur = <?php echo $agriculteurCount; ?>;
            var mecanicien = <?php echo $mecanicienCount; ?>;

            // Données dynamiques venant du PHP pour le deuxième graphique
            var creationLabels = <?php echo json_encode($creationLabels); ?>;
            var creationCounts = <?php echo json_encode($creationCounts); ?>;

            // Données dynamiques venant du PHP pour le graphique des connexions
            var loginLabels = <?php echo json_encode($loginLabels); ?>;
            var loginCounts = <?php echo json_encode($loginCounts); ?>;

            var ctx1 = document.getElementById('choixChart').getContext('2d');
            var ctx2 = document.getElementById('creationChart').getContext('2d');
            var ctx3 = document.getElementById('loginChart').getContext('2d');
            
            // Premier graphique (clients par choix)
            var choixChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Saisonnier', 'Vétérinaire', 'Agriculteur', 'Mécanicien'],
                    datasets: [{
                        label: 'Nombre de Clients',
                        data: [saisonnier, veterinaire, agriculteur, mecanicien],
                        backgroundColor: ['#004d00', '#009900', '#66cc33', '#33cc33'],
                        borderColor: '#004d00',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            // Deuxième graphique (comptes créés par date)
            var creationChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: creationLabels,
                    datasets: [{
                        label: 'Comptes créés par jour',
                        data: creationCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            // Troisième graphique (connexions par date)
            var loginChart = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: loginLabels,
                    datasets: [{
                        label: 'Nombre de Connexions',
                        data: loginCounts,
                        backgroundColor: '#ff5733',
                        borderColor: '#ff5733',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        </script>
    </div>
</body>
</html>
