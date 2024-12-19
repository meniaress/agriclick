<?php 
include '../controllers/PostulationC.php';
$PostulationC = new PostulationC();

$idOffre = isset($_GET['idOffre']) ? $_GET['idOffre'] : null;
$list = $PostulationC->getPostulationsByOffre($idOffre);
// Fonction pour exporter les postulations au format CSV
function exportPostulationsToCSV($postulations)
{
    // Nom du fichier CSV de sortie
    $filename = 'postulations_export.csv';

    // Ouverture du fichier en écriture
    $fp = fopen($filename, 'w');

    // En-têtes du fichier CSV
    $headers = array('IdPostulation', 'Nom', 'Prenom', 'Age', 'Localisation', 'IdOffre','etat');
    fputcsv($fp, $headers);

    // Écriture des données de postulation dans le fichier CSV
    foreach ($postulations as $postulation) {
        fputcsv($fp, array(
            $postulation['idPostulation'],
            $postulation['nom'],
            $postulation['prenom'],
            $postulation['age'],
            $postulation['localisationp'],
            $postulation['idOffre'],
            $postulation['etat']
        ));
    }

    // Fermeture du fichier
    fclose($fp);

    // Envoi du fichier CSV au navigateur
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);

    // Suppression du fichier CSV après l'envoi
    unlink($filename);
}

if (isset($_POST['export'])) {
    exportPostulationsToCSV($list);
    exit;
}
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
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <div class="d-flex sidebar-profile">
              <div class="sidebar-profile-image">
                <img src="img/faces/face29.png" alt="image">
                <span class="sidebar-status-indicator"></span>
              </div>
              <div class="sidebar-profile-name">
                <p class="sidebar-name">
                  Ahmed Regaieg
                </p>
                <p class="sidebar-designation">
                  Welcome
                </p>
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
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-briefcase menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="typcn typcn-chevron-right menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="typcn typcn-film menu-icon"></i>
              <span class="menu-title">Form elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="typcn typcn-chart-pie-outline menu-icon"></i>
              <span class="menu-title">Charts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="typcn typcn-th-small-outline menu-icon"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="typcn typcn-compass menu-icon"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="typcn typcn-globe-outline menu-icon"></i>
              <span class="menu-title">Error pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
        <ul class="sidebar-legend">
          <li>
            <p class="sidebar-menu-title">Category</p>
          </li>
          <li class="nav-item"><a href="#" class="nav-link">#Sales</a></li>
          <li class="nav-item"><a href="#" class="nav-link">#Marketing</a></li>
          <li class="nav-item"><a href="#" class="nav-link">#Growth</a></li>
        </ul>
      </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 font-weight-bold">Ahmed Regaieg</h3>
                <p>Your last login: 21h ago from Tunisia.</p>
              </div>
              
            </div>
    <!-- Hero End -->
    <h1 id="root">POSTULATIONS</h1>
    <div class="container">
    <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead class="table-primary">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Âge</th>
                    <th>Localisation</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($list) {
                    foreach ($list as $Postulation) {
                        echo "<tr>";
                        echo "<td>" . $Postulation['nom'] . "</td>";
                        echo "<td>" . $Postulation['prenom'] . "</td>";
                        echo "<td>" . $Postulation['age'] . "</td>";
                        echo "<td>" . $Postulation['localisationp'] . "</td>";
                        echo "<td>" . $Postulation['etat'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <form method="post">
            <button type="submit" name="export" class="btn btn-success">Exporter</button>
        </form>
        <a href="indexadmincat.php" class="btn btn-secondary py-md-3 px-md-5">retourner</a>
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