*<?php
// Include necessary controllers
include_once '../controller/ServiceController.php';
include_once '../controller/CommandeController.php';

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
          <a class="navbar-brand brand-logo" href="index.html"><img src="img/icon.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="img/logo-mini.svg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav mr-lg-2">
          
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link active" href="#">
                Gestion des commandes et services
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
                <img src="img/test.jpg" alt="image">
                <span class="sidebar-status-indicator"></span>
              </div>
              <div class="sidebar-profile-name">
                <p class="sidebar-name">
                  Moetez Ben Attia                </p>
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
                    <?php if (!empty($commandes)): ?>
                        <?php foreach ($services as $service): ?>
                          <tr id="service-row-<?= htmlspecialchars($service['id']) ?>">
                          <td><?= htmlspecialchars($service['id']) ?></td>
                          <td><?= htmlspecialchars($service['title']) ?></td>
                          <td><?= htmlspecialchars($service['description']) ?></td>
                          <td><?= htmlspecialchars($service['tarif']) ?></td>
                          <td><?= htmlspecialchars($service['type']) ?></td>
                          <td>
        <button class="btn btn-danger btn-sm" onclick="deleteService(<?= htmlspecialchars($service['id']) ?>)">Delete</button>
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
        <button class="btn btn-danger btn-sm" onclick="deleteCommand(<?= htmlspecialchars($commande['id']) ?>)">Delete</button>
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
    <a href="CommandeCreation.php" class="btn btn-primary">Add New Command</a>
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
                <form method="POST" action="ServiceCreation.php" onsubmit="return validateModalForm(event)">
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


<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>