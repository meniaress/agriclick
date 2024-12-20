<?php
$bddPDO = new PDO('mysql:host=localhost;dbname=projet web', 'root', '');
$bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$request = "SELECT * from partenariats";
$result = $bddPDO->query($request);

if (!$result) {
    echo 'La récupération des données a rencontré un problème';
} else {
    $nbr_partenaires = $result->rowCount();
}
function exportPartnershipsToCSV($partnerships)
{
    // Nom du fichier CSV de sortie
    $filename = 'partnerships_export.csv';

    // Ouverture du fichier en écriture
    $fp = fopen($filename, 'w');

    // En-têtes du fichier CSV
    $headers = array('ID', 'Nom de l\'organisation', 'Nom du responsable', 'Numéro de téléphone', 'Adresse e-mail', 'Type de partenariat', 'Description', 'Image', 'Status');
    fputcsv($fp, $headers);

    // Écriture des données de partenariats dans le fichier CSV
    foreach ($partnerships as $partnership) {
        fputcsv($fp, array(
            $partnership['id'],
            $partnership['Nom de l\'organisation'],
            $partnership['Nom du responsable'],
            $partnership['Numéro de téléphone'],
            $partnership['Adresse e-mail'],
            $partnership['Type de partenariat'],
            $partnership['Description'],
            $partnership['Image'],
            $partnership['Status']
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

// Appel de la fonction si le bouton d'exportation est cliqué
if (isset($_POST['export'])) {
    exportPartnershipsToCSV($result->fetchAll(PDO::FETCH_ASSOC)); // Récupération des données à exporter
    exit;
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>agriCLICK Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject --> 
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="img/icon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
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
              <a class="nav-link" href="#">
                Gestion des Utilisateurs
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link active" href="#">
                Gestion des Partenariats
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="#">
                Gestion des offres
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="#">
                Gestion des offres
              </a>
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
                  Elyes Khiari
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
            
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/AgriCLICK/Controller/recherche.php'; ?>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h4 class="card-title">Liste des Partenariats</h4>
    <form method="GET" action="" class="d-flex">
        <select name="searchColumn" class="form-select me-2">
            <option value="nom_organisation">Nom de l'organisation</option>
            <option value="nom_responsable">Nom du responsable</option>
            <option value="numéro">Numéro de téléphone</option>
            <option value="email">Adresse e-mail</option>
            <option value="type_partenariat">Type de partenariat</option>
            <option value="description">Description</option>
            <option value="status">Status</option>
        </select>
        <input type="text" name="searchValue" class="form-control me-2" placeholder="Rechercher..." required>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

</div>
<tbody>
  

    <?php if (!empty($partenariats)): ?>
        <?php foreach ($partenariats as $ligne):  ?>
          
            <tr>
                <td><?= htmlspecialchars($ligne["Nom de l'organisation"]) ?></td>
                <td><?= htmlspecialchars($ligne['Nom du responsable']) ?></td>
                <td><?= htmlspecialchars($ligne['Numéro de téléphone']) ?></td>
                <td><?= htmlspecialchars($ligne['Adresse e-mail']) ?></td>
                <td><?= htmlspecialchars($ligne['Type de partenariat']) ?></td>
                <td><?= htmlspecialchars($ligne['Description']) ?></td>
                <td><?= htmlspecialchars($ligne['Status']) ?></td>
                <td><?= htmlspecialchars($ligne['id']) ?></td>
                
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="10" class="text-center">Aucun partenariat trouvé.</td>
        </tr>
    <?php endif; ?>
</tbody>

            
          
<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Liste des Partenariats</h4>
                    <button class="btn btn-primary btn-sm" onclick="window.location.href='index.php'">
                        <i class="bi bi-plus-circle"></i> Ajouter un partenariat
                    </button>
                    <form method="post" action="" style="display:inline-block;">
                        <button type="submit" class="btn btn-secondary btn-sm" name="export">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Exporter en CSV
                        </button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Nom de l'organisation</th>
                                <th>Nom du responsable</th>
                                <th>Numéro de téléphone</th>
                                <th>Adresse e-mail</th>
                                <th>Type de partenariat</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                foreach ($ligne as $valeur) {
                                    echo "<td>$valeur</td>";
                                }
                                $id = $ligne['id']; // Remplacez par le nom de la colonne pour l'ID
                                echo "
                                <td class='actions'>
                                    <button class='btn btn-danger btn-sm' onclick='confirmDelete($id)'>
                                        <i class='bi bi-trash'></i> Supprimer
                                    </button>
                                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='../Views/edit.php?id=$id'\">
                                        <i class='bi bi-pencil'></i> Modifier
                                    </button>
                                    <form action='../Controller/acceptPartner.php' method='post' style='display:inline-block;'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='hidden' name='email' value='{$ligne['Adresse e-mail']}'>
                                        <button type='submit' class='btn btn-success btn-sm'>
                                            <i class='bi bi-check-circle'></i> Accepter
                                        </button>
                                    </form>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($nbr_partenaires == 0): ?>
                    <div class="text-center mt-4">
                        <p class="text-muted">Aucun partenariat trouvé.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
// Appel de la fonction d'exportation si le bouton est soumis
if (isset($_POST['export'])) {
    exportPostulationsToCSV($result->fetchAll(PDO::FETCH_ASSOC)); // Récupération des données à exporter
    exit;
}
?>
<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Liste des Inscriptions</h4>
                    <button class="btn btn-primary btn-sm" onclick="window.location.href='addInscription.php'">
                        <i class="bi bi-plus-circle"></i> Ajouter une inscription
                    </button>
                    <form method="post" action="" style="display:inline-block;">
                        <button type="submit" class="btn btn-secondary btn-sm" name="export">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Exporter en CSV
                        </button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nom de l'organisation</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Numéro</th>
                                <th>Adresse e-mail</th>
                                <th>Nom de la formation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Récupérer les données de la table inscriptions
                            require_once '../connexion.php';
                            $sql = "SELECT * FROM inscriptions";
                            $result = $con->query($sql);

                            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                foreach ($ligne as $valeur) {
                                    echo "<td>$valeur</td>";
                                }
                                $id = $ligne['ID']; // Remplacez par le nom exact de votre colonne ID
                                echo "
                                <td class='actions'>
                                    <button class='btn btn-danger btn-sm' onclick='confirmDelete($id)'>
                                        <i class='bi bi-trash'></i> Supprimer
                                    </button>
                                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='../Views/editInscription.php?id=$id'\">
                                        <i class='bi bi-pencil'></i> Modifier
                                    </button>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($result->rowCount() == 0): ?>
                    <div class="text-center mt-4">
                        <p class="text-muted">Aucune inscription trouvée.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
// Fonction d'exportation en CSV
function exportInscriptionsToCSV($inscriptions)
{
    $filename = 'inscriptions_export.csv';

    $fp = fopen($filename, 'w');

    // En-têtes du fichier CSV
    $headers = array('Nom de l\'organisation', 'Nom', 'Prénom', 'Numéro', 'Adresse e-mail', 'Nom de la formation', 'ID');
    fputcsv($fp, $headers);

    // Écriture des données
    foreach ($inscriptions as $inscription) {
        fputcsv($fp, array(
            $inscription['Nom de l\'organisation'],
            $inscription['ID'],
            $inscription['Nom'],
            $inscription['Prénom'],
            $inscription['Numéro'],
            $inscription['Adresse e-mail'],
            $inscription['Nom de la formation'],
            
        ));
    }

    fclose($fp);

    // Envoi du fichier
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);
    unlink($filename);
}

// Exportation si le formulaire est soumis
if (isset($_POST['export'])) {
    $inscriptions = $result->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les inscriptions
    exportInscriptionsToCSV($inscriptions);
    exit;
}
?>


          
          <script>
          function confirmDelete(id) {
              if (confirm("Êtes-vous sûr de vouloir supprimer ce partenariat ?")) {
                  window.location.href = `../Controller/delete.php?id=${id}`;
              }
          }
          </script>
          
          
            
              
    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>