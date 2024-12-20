<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the controller
include_once '../controllers/CommandeController.php';
include_once '../model/Commandes.php';

// Initialize the controller
$commandeController = new CommandeController();

// Fetch the service ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idService = intval($_GET['id']);
} else {
    echo "Invalid request. Service ID is missing.";
    exit;
}

// Initialize variables
$commande = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["paiement"]) && !empty($_POST["paiement"])) {
        // Create a Commande object
        $commande = new Commande(
            null,               // ID (auto-incremented)
            new DateTime(),     // Current date
            $_POST['paiement'], // Payment method
            isset($_POST['message']) ? $_POST['message'] : null, // Message (optional)
            $idService          // Service ID passed in the URL
        );

        // Add the command
        $commandeController->addCommande($commande);

        // Redirect with a success message
        header('Location:CommandeList.php?id=' . $idService . '&commanded=1');
        exit;
    } else {
        $error = "Payment method is required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Creation Commande</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm p-4">
                    <h2 class="text-center">Commander Service</h2>

                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="CommandeCreation.php?id=<?= htmlspecialchars($idService) ?>">
                        <!-- Payment Method -->
                        <div class="mb-3">
                            <label for="paiement" class="form-label"> Methode de Payment</label>
                            <select id="paiement" name="paiement" class="form-select" required>
                                <option value="" disabled selected>choisir methode de payment</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="PayPal">PayPal</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <!-- Message Input -->
                        <div class="mb-3">
                          <label for="message" class="form-label">Message (optional)</label>
                          <textarea id="message" name="message" class="form-control" rows="3" placeholder="ajouter un message"></textarea>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Confirmer</button>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript files -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
