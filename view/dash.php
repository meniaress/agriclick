*<?php
// Include necessary controllers
include_once '../controllers/ServiceController.php';
include_once '../controllers/CommandeController.php';

$serviceController = new ServiceController();
$commandeController = new CommandeController();

// Fetch services and commands for display
$services = $serviceController->listServices();
$commandes = $commandeController->listCommandes();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    *<!-- Required meta tags -->
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
    <script src="js/addService.js"></script>

<script src="js/main.js"></script>

<!-- Custom JavaScript for Validation -->
<script>
    function validateForm(event) {
        event.preventDefault();

        // Clear previous errors
        const errorElements = document.querySelectorAll(".error-text");
        errorElements.forEach(el => el.textContent = "");

        let hasError = false;

        // Validate Title
        const title = document.getElementById("title");
        if (title.value.trim() === "") {
            document.getElementById("titleError").textContent = "Service title is required.";
            hasError = true;
        }

        // Validate Description
        const description = document.getElementById("description");
        if (description.value.trim() === "") {
            document.getElementById("descriptionError").textContent = "Description is required.";
            hasError = true;
        }

        // Validate Price
        const tarif = document.getElementById("tarif");
        if (tarif.value.trim() === "" || isNaN(tarif.value) || tarif.value <= 0) {
            document.getElementById("tarifError").textContent = "Please enter a valid price.";
            hasError = true;
        }

        // Validate Category
        const category = document.getElementById("category");
        if (category.value === "") {
            document.getElementById("categoryError").textContent = "Please select a category.";
            hasError = true;
        }


         // Validate Localisation
         const localisation = document.getElementById("localisation");
        if (localisation.value === "") {
            document.getElementById("localisationError").textContent = "Please enter a localisation.";
            hasError = true;
        }

        if (!hasError) {
            alert("Form submitted successfully!");
            event.target.submit();
        }
    }
</script>

<style>
    .error-text {
        color: red;
        font-size: 0.875rem;
    }
</style>
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
                        <a class="nav-link " href="#">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="../view/indexadmincat.php">Gestion des offres et categories
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
              <a class="nav-link active" href="dash.php">
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
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 font-weight-bold">Moetez Ben Attia</h3>
                <p>Your last login: 21h ago from Tunisia.</p>
              </div>
              
            </div>
            

    <div class="container py-5">
        <h1 class="text-center mb-4">Welcome to the Admin Dashboard</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>Services Overview</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>tarif</th>
                            <th>type tarif</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($services)): ?>
                        <?php foreach ($services as $service): ?>
                          <tr id="service-row-<?= htmlspecialchars($service['id']) ?>">
                          <td><?= htmlspecialchars($service['id']) ?></td>
                          <td><?= htmlspecialchars($service['title']) ?></td>
                          <td><?= htmlspecialchars($service['description']) ?></td>
                          <td><?= htmlspecialchars($service['tarif']) ?></td>
                          <td><?= htmlspecialchars($service['type']) ?></td>
                          <td>
                          <a href="ServiceDeleteDash.php?id=<?php echo $service['id']; ?>" class="btn btn-danger mt-3">Delete</a>
    </td>
</tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No services found.</td>
                </tr>
            <?php endif; ?>
                    </tbody>
                </table>
                <a href="#" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#addServiceModal">Add New Service</a>
            </div>

            <div class="col-md-6">
    <h2>Commands Overview</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Payment Method</th>
                <th>Service Title</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($commandes)): ?>
                <?php foreach ($commandes as $commande): ?>
                  <tr id="command-row-<?= htmlspecialchars($commande['id']) ?>">
    <td><?= htmlspecialchars($commande['id']) ?></td>
    <td><?= htmlspecialchars($commande['date']) ?></td>
    <td><?= htmlspecialchars($commande['paiement']) ?></td>
    <td><?= htmlspecialchars($commande['serviceTitle']) ?></td>
    <td><?= htmlspecialchars($commande['message'] ?? 'No message') ?></td>
    <td>
                          <a href="ServiceDeleteDash.php?id=<?php echo $service['id']; ?>" class="btn btn-danger mt-3">Delete</a>
    </td>
</tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No commands found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>

<!-- Add New Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="ServiceCreationDash.php" onsubmit="return validateModalForm(event)">
                    <div class="mb-3">
                        <label for="title" class="form-label">Service Title</label>
                        <input type="text" id="modalTitle" name="title" class="form-control" required>
                        <div id="titleError" class="error-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="modalDescription" name="description" class="form-control" required></textarea>
                        <div id="descriptionError" class="error-text"></div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="localisation" class="form-label">Localisation</label>
                        <input type="text" id="modalLocalisation" name="localisation" class="form-control" required>
                        <div id="localisationError" class="error-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tarif" class="form-label">Tarif</label>
                        <input type="text" id="modalTarif" name="tarif" class="form-control" required>
                        <div id="modalTarifError" class="error-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select id="modalType" name="type" class="form-select" required>
                            <option value="per-hour">Per Hour</option>
                            <option value="per-task">Per Task</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" id="modalCategory" name="category" class="form-control" required>
                        <div id="modalCategoryError" class="error-text"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  function deleteService(id) {
    if (confirm("Are you sure you want to delete this service?")) {
        // Send a request to the server to delete the service
        $.ajax({
            type: "POST",
            url: "deleteService.php",
            data: { id: id },
            success: function() {
                // Remove the service from the table
                $("#service-row-" + id).remove();
            }
        });
    }
}

function deleteCommand(id) {
    if (confirm("Are you sure you want to delete this command?")) {
        // Send a request to the server to delete the command
        $.ajax({
            type: "POST",
            url: "deleteCommand.php",
            data: { id: id },
            success: function() {
                // Remove the command from the table
                $("#command-row-" + id).remove();
            }
        });
    }
}
</script>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>