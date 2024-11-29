<?php
include '../CONTROLLER/CategorieC.php';

$error = "";
$categorieC = new CategorieC();
$categorie = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["idCategorie"]) && !empty($_GET["idCategorie"])) {
        $cateID = $_GET["idCategorie"];
        $categorie = $categorieC->getCategById($cateID);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["idCategorie"]) && isset($_POST["nomCategorie"])) {
        if (!empty($_POST["idCategorie"]) && !empty($_POST['nomCategorie'])) {
            $idCategorie = $_POST["idCategorie"];
            $nomCategorie = $_POST['nomCategorie'];
            $categorieC->modifierNomCategorie($idCategorie, $nomCategorie);
            header('Location: indexcategorie.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AGRICLICK - Organic Farm Website </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"href="style.css">
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
    <title>Modifier Categorie</title>
    <script>
        function validateForm() {
            var nomCategorie = document.getElementById("nomCategorie").value;
            if (nomCategorie.trim() === "") {
                alert("Tous les champs sont obligatoires.");
                return false;
            }
            if (nomCategorie.length <= 5) {
                alert("Le nom de la catégorie doit contenir plus de 5 caractères.");
                return false;
            }
            var firstChar = nomCategorie.charAt(0);
            if (firstChar !== firstChar.toUpperCase()) {
                alert("Le nom de la catégorie doit commencer par une lettre majuscule.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <center><h1>Modifier Categorie</h1></center>
        <hr>
        <br>
        <form method="POST" class="form" onsubmit="return validateForm()">
            <input type="hidden" name="idCategorie" value="<?php echo $categorie['idCategorie']; ?>">
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Nom Categorie</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomCategorie" id="nomCategorie" value="<?php echo $categorie['nomCategorie']; ?>" placeholder="nomCategorie">
                </div>
            </div>
            <div class="row mb-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-secondary py-md-3 px-md-5" href="indexcategorie.php" role="button">Quitter</a>
                </div>
            </div>
        </form>
    </div>
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
