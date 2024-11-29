<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../controllers/repcontroller.php");
include_once("../model/rep.php");

$reponseController = new ReponseController();
$notification = null; // Variable for notifications

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu_reponse = trim($_POST["reponse"]);
  

    if (!empty($contenu_reponse) ) {
        $reponse = new Reponse($contenu_reponse);
        if ($reponseController->addReponse($reponse)) {
            // Redirect to the same page with a success parameter
            header('Location: ../controllers/listrep.php?success=1');
            exit();
        } else {
            $notification = "Erreur : Impossible d'ajouter la réponse.";
        }
    } else {
        $notification = "Erreur : Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Formulaire de Réponse</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Formulaire de Réponse</h1>
        <?php if (isset($notification)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($notification); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="alert alert-success">Votre réponse a été soumise avec succès!</p>
        <?php endif; ?>
        <form method="POST" action="">
            
            <div class="mb-3">
                <label for="reponse" class="form-label">Votre Réponse</label>
                <textarea id="reponse" name="reponse" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Soumettre la Réponse</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>