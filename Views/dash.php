<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AgriCLICK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>



    <!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
    <div class="d-flex align-items-center justify-content-center">
        <a href="index.html" class="navbar-brand ms-lg-5">
            <img src="img/logo.png" alt="Logo" style="height: 100px;">
        </a>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0">

            <a href="dash.php" class="nav-item nav-link">Gestion de Partenariats</a>
            <a href="service.html" class="nav-item nav-link">Service</a>
            <a href="product.html" class="nav-item nav-link">Product</a>
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
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<div class="container my-5">
    <h2 class="text-center mb-4">Liste des Partenariats</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
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
                    <th>id</th>
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
                    $id = $ligne[8]; // Adjust index if 'id' column is in a different position
                    
                    echo "
                    <td class='actions'>
                        <button class='btn btn-danger btn-sm' onclick='confirmDelete($id)'>
                            <i class='bi bi-trash'></i> Supprimer
                        </button>
                        <button class='btn btn-warning btn-sm' onclick=\"window.location.href='../Controller/edit.php?id=$id'\">
                            <i class='bi bi-pencil-square'></i> Modifier
                        </button>
                        <form action='../Controller/acceptPartner.php' method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='<?php echo $id; ?>'>
                            <input type='hidden' name='email' value='<?php echo $ligne[3]; ?>'> 
                            <button class='btn btn-success btn-sm' onclick='acceptPartner($id)'>
                                <i class='bi bi-check-circle'></i> Afficher
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


<script>
function confirmDelete(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce partenariat ?")) {
        // Redirect to delete.php with the id parameter
        window.location.href = `../Controller/delete.php?id=${id}`;
    }
}

function openEditForm(orgName) {
    const newValue = prompt(`Enter the new value for the organization: ${orgName}`);
    if (newValue) {
        // Redirect to edit.php with parameters
        window.location.href = `edit.php?orgName=${encodeURIComponent(orgName)}&column=columnName&newValue=${encodeURIComponent(newValue)}`;
    }
}
function acceptPartner(id) {
    $.ajax({
        url: '../Controller/acceptPartner.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            // Vérifiez la réponse pour voir si la mise à jour a été effectuée
            alert('Partenariat accepté');
            // Mettre à jour dynamiquement la cellule du statut dans la table
            $('#Status-' + id).text('accepté');
        },
        error: function() {
            alert('Erreur lors de l\'acceptation du partenariat');
        }
    });
}

</script>





    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>