<?php 
include '../controllers/OffreC.php';
$OffreC = new OffreC();

$idCategorie = isset($_GET['idCategorie']) ? $_GET['idCategorie'] : null;
$list = $OffreC->getOffresByCategorie($idCategorie);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liste des categories - agriCLICK Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="dashboard/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="dashboard/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="dashboard/img/icon.png" />
</head>
<body>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav mr-lg-2">
          <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="elyes/dash.php">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link active" href="indexadmincat.php">
                Gestion des offres et categories
              </a>
            </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="../controllers/Reclamationlist.php">
                Gestion des reclamations
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="../controllers/dashboard/listrep.php">
                Gestion des reponses
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="meniar/dash.php">
                Gestion de suivi
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="dash.php">
                Gestion des commandes et des services
              </a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link"  href="back office/client_liste.php">Gestion des Utilisateurs</a>
                    </li>
          </ul>
          </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
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
                    <a class="nav-link " href="../controllers/dashboard/statistiques.php">
                        <i class="typcn typcn-device-desktop menu-icon"></i>
                        <span class="menu-title ">Statistiques des Réponses<span class="badge badge-primary ml-3">New</span></span>
                        
                    </a>
                </li>
        </ul>
     
      </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
    <!-- Hero End -->
    <h1 id="root">OFFRES DE TRAVAIL</h1>
    <div class="container">
    <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead class="table-primary">
                <tr>
                    <th>Localisation</th>
                    <th>Travail</th>
                    <th>Salaire</th>
                    <th>Image Offre</th>
                    <th>actions</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($list) {
                    foreach ($list as $Offre) {
                        echo "<tr>";
                        echo "<td>" . $Offre['localisation'] . "</td>";
                        echo "<td>" . $Offre['travailOffre'] . "</td>";
                        echo "<td>" . $Offre['salaire'] . "</td>";
                        echo "<td><img src='" . $Offre['imageOffre'] . "' alt='Image Offre' style='width: 100px; height: auto;'></td>";
                        echo "<td>";
                        echo '<a class="btn btn-secondary" href="indexadminpos.php?idOffre=' . $Offre['idOffre'] . '" role="button">voir les postulations</a>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        
        <a href="indexadmincat.php" class="btn btn-secondary py-md-3 px-md-5">retourner</a>
    </div>
<!-- Footer Start -->
   <!-- base:js -->
   <script src="dashboard/vendors/js/vendor.bundle.base.js"></script>
    <script src="dashboard/js/off-canvas.js"></script>
    <script src="dashboard/js/hoverable-collapse.js"></script>
    <script src="dashboard/js/template.js"></script>
    <script src="dashboard/js/settings.js"></script>
    <script src="dashboard/js/todolist.js"></script>
</body>
</html>    