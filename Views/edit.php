<?php
// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Connexion à la base de données
        $bddPDO = new PDO('mysql:host=localhost;dbname=projet web', 'root', '');
        $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer les informations du partenariat
        $query = "SELECT * FROM partenariats WHERE id = :id";
        $stmt = $bddPDO->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Vérification si un partenariat a été trouvé
        if ($stmt->rowCount() > 0) {
            $partenaire = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Partenariat non trouvé.";
            exit();
        }

    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_org = $_POST['nom_organisation'];
    $nom_resp = $_POST['nom_responsable'];
    $e_mail = $_POST['e_mail'];
    $num = $_POST['numéro'];
    $type_part = $_POST['type_partenariat'];
    $des = $_POST['description'];
    $status = $_POST['status'];
    

    try {
        // Mettre à jour les données dans la base
        $updateQuery = "UPDATE partenariats SET 
                        `Nom de l'organisation` = :nom_org, 
                        `Nom du responsable` = :nom_resp, 
                        `Numéro de téléphone` = :num, 
                        `Adresse e-mail` = :e_mail, 
                        `Type de partenariat` = :type_part, 
                        `Description` = :des,
                        `Status` = :status

                        WHERE id = :id";
        
        $stmt = $bddPDO->prepare($updateQuery);
        $stmt->bindParam(':nom_org', $nom_org);
        $stmt->bindParam(':nom_resp', $nom_resp);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':e_mail', $e_mail);
        $stmt->bindParam(':type_part', $type_part);
        $stmt->bindParam(':des', $des);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Rediriger après la mise à jour
            header("Location: ../Views/dash.php?update=1");
            exit();
        } else {
            echo "Erreur : La mise à jour a échoué.";
        }
    } catch (PDOException $e) {
        echo "Erreur de mise à jour : " . $e->getMessage();
    }
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
          
        </ul>

      </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            

<!-- Formulaire de modification -->
 <center>
<form method="POST" onsubmit="return validateForm()">
    <label for="partnerName">Nom de l'organisation</label>
    <input type="text" name="nom_organisation" id="partnerName" value="<?= htmlspecialchars($partenaire["Nom de l'organisation"]) ?>" required>
    <small id="partnerNameError" class="error-message"></small>
    <br>
    <label for="contactName">Nom du responsable</label>
    <input type="text" name="nom_responsable" id="contactName" value="<?= htmlspecialchars($partenaire['Nom du responsable']) ?>" required>
    <small id="contactNameError" class="error-message"></small>
    <br>
    <label for="email">Adresse email</label>
    <input type="email" name="e_mail" id="email" value="<?= htmlspecialchars($partenaire['Adresse e-mail']) ?>" required>
    <small id="emailError" class="error-message"></small>
    <br>
    <label for="phone">Numéro de téléphone</label>
    <input type="text" name="numéro" id="phone" value="<?= htmlspecialchars($partenaire['Numéro de téléphone']) ?>" required>
    <small id="phoneError" class="error-message"></small>
    <br>
    <label for="partnershipType">Type de partenariat</label>
    <select name="type_partenariat" id="partnershipType" required>
        <option value="">--Choisir un type--</option>
        <option <?= $partenaire['Type de partenariat'] == 'Formation' ? 'selected' : '' ?>>Formation</option>
        <option <?= $partenaire['Type de partenariat'] == 'Soutien financier' ? 'selected' : '' ?>>Soutien financier</option>
        <option <?= $partenaire['Type de partenariat'] == 'Services professionnels' ? 'selected' : '' ?>>Services professionnels</option>
        <option <?= $partenaire['Type de partenariat'] == 'Promotion mutuelle' ? 'selected' : '' ?>>Promotion mutuelle</option>
    </select>
    <small id="partnershipTypeError" class="error-message"></small>
    <br>
    <label for="description">Description</label>
    <textarea name="description" id="description" required><?= htmlspecialchars($partenaire['Description']) ?></textarea>
    <small id="descriptionError" class="error-message"></small>
    <br>
    <label for="status">Statut du partenariat</label>
    <select name="status" id="status">
        <option value="en attente" <?= $partenaire['Status'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
        <option value="accepté" <?= $partenaire['Status'] == 'accepté' ? 'selected' : '' ?>>Accepté</option>
        <option value="refusé" <?= $partenaire['Status'] == 'refusé' ? 'selected' : '' ?>>Refusé</option>
    </select>
    <small id="statusError" class="error-message"></small>

    <button type="submit">Modifier</button>
</form>
</div>
</center>
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