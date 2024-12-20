<?php
// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Connexion à la base de données
        $bddPDO = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
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
            header("Location: dash.php?update=1");
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
          <!-- Sidebar -->
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
                        <a class="nav-link active" href="../../controllers/dashboard/statistiques.php">
                            <i class="typcn typcn-chart-bar menu-icon"></i>
                            <span class="menu-title">Statistiques des Réponses</span>
                        </a>
                    </li>
                    <!-- Add other sidebar items here -->
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