<?php
$bddPDO = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
$bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$request = "SELECT * from animal";
$result = $bddPDO->query($request);

if (!$result) {
    echo 'La récupération des données a rencontré un problème';
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
          
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav mr-lg-2">
          <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="../elyes/dash.php">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="../indexadmincat.php">Gestion des offres et categories
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
              <a class="nav-link active" href="dash.php">
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
            
            
            <div class="row">
              <div class="col-lg-12 d-flex grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                              <h4 class="card-title">Liste des animaux</h4>
                              <button class="btn btn-primary btn-sm" onclick="window.location.href='addPartnership.php'">
                                  <i class="bi bi-plus-circle"></i> Ajouter un animal
                              </button>
                          </div>
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead class="table-primary">
                                      <tr>
                                          <th>#</th>
                                          <th>Nom de l'animal</th>
                                          <th>Espèce</th>
                                          <th>Genre</th>
                                          <th>Race</th>
                                          <th>Poids</th>
                                          <th>Date de naissance</th>
                                          <th>Age</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      while ($ligne = $result->fetch(PDO::FETCH_NUM)) {
                                          echo "<tr>";
                                          foreach ($ligne as $valeur) {
                                              echo "<td>$valeur</td>";
                                          }
                                          $id = $ligne[7]; // Ajuster l'index pour l'ID si nécessaire
                                          echo "
                                          <td class='actions'>
                                              <button class='btn btn-danger btn-sm' onclick='confirmDelete($id)'>
                                                  <i class='bi bi-trash'></i> Supprimer
                                              </button>
                                              <button class='btn btn-warning btn-sm' onclick=\"window.location.href='../../controllers/edit.php?id=$id'\">
                                                  <i class='bi bi-pencil'></i> Modifier
                                              </button>
                                             
                                              </form>
                                          </td>";
                                          echo "</tr>";
                                      }
                                      ?>
                                  </tbody>
                              </table>
                          </div>
                          
                      </div>
                  </div>
              </div>
          </div>
          
          <script>
          function confirmDelete(id) {
              if (confirm("Êtes-vous sûr de vouloir supprimer ce partenariat ?")) {
                  window.location.href = `../Controller/delete.php?id=${id}`;
              }
          }
          </script>
          
            
              
            </div>
          </div>
          <!-- content-wrapper ends -->

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
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