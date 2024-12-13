<?php
include_once '../controllers/ServiceController.php';
include_once '../model/Services.php';

$serviceController = new ServiceController();
$service = null;

// Check if an ID was provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the service details
    $services = $serviceController->listServices();
    foreach ($services as $s) {
        if ($s['id'] == $id) {
            $service = new Service(
                $s['id'],
                $s['title'],
                $s['description'],
                $s['category'],
                $s['localisation'],
                $s['type'],
                floatval($s['tarif']),
                new DateTime($s['date'])
            );
            break;
        }
    }

    if (!$service) {
        echo "Service not found.";
        exit;
    }
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedService = new Service(
        intval($_POST['id']),
        $_POST['title'],
        $_POST['description'],
        $_POST['category'],
        $_POST['localisation'],
        $_POST['type'],
        floatval($_POST['tarif']),
        null // Date is not updated
    );

    $serviceController->updateService($updatedService);
    header('Location: ServiceList.php');
    exit;
}
?>

    


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Create Freelance Service">
    <meta name="description" content="<?php echo $description; ?>">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

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
            if (category.value === "") {
                document.getElementById("localisationError").textContent = "Please select a localisation.";
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
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="index.html" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Agri</span>CLICK</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link active">Services</a>
                <a href="product.html" class="nav-item nav-link">Product</a>
                <a href="form.php" class="nav-item nav-link">Reclamation</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="blog.html" class="dropdown-item">Blog Grid</a>
                        <a href="detail.html" class="dropdown-item">Blog Detail</a>
                        <a href="feature.html" class="dropdown-item">Features</a>
                        <a href="team.html" class="dropdown-item">The Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Page Header -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <h1 class="display-1 text-white">update Service</h1>
            <a href="servicelist.php" class="btn btn-secondary">Services</a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm p-4">

                    <form method="POST" action="serviceUpdate.php">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($service->getId()) ?>">

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Service Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($service->getTitle()) ?>" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($service->getDescription()) ?></textarea>
                        </div>

                        <!-- Localisation -->
                        <div class="mb-3">
                            <label for="localisation" class="form-label">Localisation</label>
                            <input type="text" id="localisation" name="localisation" class="form-control" value="<?= htmlspecialchars($service->getLocalisation()) ?>" required>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="tarif" class="form-label">Tarif</label>
                            <input type="text" id="tarif" name="tarif" class="form-control" value="<?= htmlspecialchars($service->getTarif()) ?>" required>
                        </div>

                        <!-- Type -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select id="type" name="type" class="form-select" required>
                                <option value="per-hour" <?= $service->getType() === 'per-hour' ? 'selected' : '' ?>>Per Hour</option>
                                <option value="per-task" <?= $service->getType() === 'per-task' ? 'selected' : '' ?>>Per Task</option>
                            </select>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" id="category" name="category" class="form-control" value="<?= htmlspecialchars($service->getCategory()) ?>" required>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end">
                            <a href="ServiceList.php" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-white mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-white me-2"></i>
                                <p class="text-white mb-0">123 Street, New York, USA</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-white me-2"></i>
                                <p class="text-white mb-0">info@example.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-white me-2"></i>
                                <p class="text-white mb-0">+012 345 67890</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-secondary btn-square me-2" href="#"><i class="bi bi-facebook"></i></a>
                                <a class="btn btn-secondary btn-square me-2" href="#"><i class="bi bi-twitter"></i></a>
                                <a class="btn btn-secondary btn-square me-2" href="#"><i class="bi bi-linkedin"></i></a>
                                <a class="btn btn-secondary btn-square" href="#"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/addService.js"></script>

    <script src="js/main.js"></script>
</body>
</html>