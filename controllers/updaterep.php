<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../controllers/repcontroller.php"); // Ensure this file contains the ReponseController class
include_once("../model/rep.php"); // Ensure the path is correct

$reponsecontroller = new ReponseController(); // Correct class name
$offer = null;

if (isset($_GET['id_rep']) && !empty($_GET['id_rep'])) { // Check if 'id_rep' is set and not empty
    $id_rep = $_GET['id_rep']; // Change variable name to match
    $db = Config::getConnexion();
    
    // Récupérer la réponse à modifier
    $sql = "SELECT * FROM reponse WHERE id_rep = :id_rep"; // Use 'id_rep' in the query
    $req = $db->prepare($sql);
    $req->bindValue(':id_rep', $id_rep); // Bind the correct variable
    
    try {
        $req->execute();
        $offer = $req->fetch(PDO::FETCH_ASSOC);
        
        // Check if the offer was found
        if (!$offer) {
            die('Erreur: Réponse non trouvée.');
        }
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
} else {
    die('Erreur: ID non spécifié.'); // More informative error message
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = trim($_POST["contenu"]);
    $admin = trim($_POST["admin"]);
    $type = trim($_POST["type"]);

    if (!empty($contenu) && !empty($admin) && !empty($type)) {
        // Mettre à jour la réponse
        $sql = "UPDATE reponse SET contenu = :contenu, admin = :admin, type = :type WHERE id_rep = :id_rep"; // Use 'id_rep' in the query
        $req = $db->prepare($sql);
        $req->bindValue(':contenu', $contenu);
        $req->bindValue(':admin', $admin);
        $req->bindValue(':type', $type);
        $req->bindValue(':id_rep', $id_rep); // Bind the correct variable
        
        try {
            $req->execute();
            header('Location: dashboard/listrep.php?success=1'); // Redirect to the response list after update
            exit();
        } catch (Exception $e) {
            echo '<h1>Error: Could not update response.</h1>';
            echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>'; // Display the error message for debugging
        }
    } else {
        echo '<h1>Error: All fields are required.</h1>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modifier Réponse</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script>
        // Function to hide the success message after 20 seconds
        function hideMessage() {
            const messageElement = document.getElementById('successMessage');
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }
        window.onload = function() {
            setTimeout(hideMessage, 20000); // Hide after 20 seconds
        };
    </script>
</head>
<body>
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
 <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">Modifier Réponse</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Form Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase">Modifier Réponse</h6>
                <h1 class="display-5">Veuillez modifier votre réponse</h1>
            </div>
            <?php if (isset($_GET['success'])): ?>
                <p id="successMessage" style="color: green;">Votre réponse a été mise à jour avec succès!</p>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-12">
                        <input type="text" name="contenu" class="form-control bg-light border-0 px-4" placeholder="Votre réponse" style="height: 55px;" value="<?php echo htmlspecialchars($offer['contenu']); ?>" required>
                    </div>
                    <div class="col-12">
                        <input type="text" name="admin" class="form-control bg-light border-0 px-4" placeholder="Nom de l'admin" style="height: 55px;" value="<?php echo htmlspecialchars($offer['admin']); ?>" required>
                    </div>
                    <div class="col-12">
                        <h6>Type:</h6>
                        <div>
                            <input type="radio" id="normale" name="type" value="normale" <?php echo ($offer['type'] == 'normale') ? 'checked' : ''; ?>>
                            <label for="normale">Normale</label>
                        </div>
                        <div>
                            <input type="radio" id="positive" name="type" value="positive" <?php echo ($offer['type'] == 'positive') ? 'checked' : ''; ?>>
                            <label for="positive">Positive</label>
                        </div>
                        <div>
                            <input type="radio" id="negative" name="type" value="negative" <?php echo ($offer['type'] == 'negative') ? 'checked' : ''; ?>>
                            <label for="negative">Négative</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-secondary w-100 py-3" type="submit">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Form End -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>