<?php
$bddPDO = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
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
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav mr-lg-2">
          <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link active" href="dash.php">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../indexadmincat.php">
                Gestion des offres et categories
              </a>
            </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="../../controllers/Reclamationlist.php">
                Gestion des reclamations
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="../../controllers/dashboard/listrep.php">
                Gestion des reponses
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../meniar/dash.php">
                Gestion de suivi
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../dash.php">
                Gestion des commandes et des services
              </a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link"  href="../back office/client_liste.php">Gestion des Utilisateurs</a>
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
                    <a class="nav-link " href="../../controllers/dashboard/statistiques.php">
                        <i class="typcn typcn-device-desktop menu-icon"></i>
                        <span class="menu-title ">Statistiques des Réponses<span class="badge badge-primary ml-3">New</span></span>
                        
                    </a>
                </li>
        </ul>
     
      </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/projet 2/controllers/elyes/recherche.php'; ?>
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
                                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='edit.php?id=$id'\">
                                        <i class='bi bi-pencil'></i> Modifier
                                    </button>
                                    
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
                            require_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
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
                                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='../View/editInscription.php?id=$id'\">
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
                  window.location.href = `../../controllers/elyes/delete.php?id=${id}`;
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