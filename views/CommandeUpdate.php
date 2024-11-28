<?php
include_once '../controller/CommandeController.php';

$commandeController = new CommandeController();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "Invalid request.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['paiement'])) {
        $paiement = $_POST['paiement'];

        // Update the payment method
        $commandeController->updateCommandePayment($id, $paiement);

        // Redirect to the command list with success message
        header('Location: CommandeList.php?updated=1&id=' . $id);
        exit;
    } else {
        echo "Payment method is required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Update Payment Method</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Update Payment Method</h1>
        <form method="POST" action="CommandeUpdate.php?id=<?= htmlspecialchars($id) ?>">
            <div class="mb-3">
                <label for="paiement" class="form-label">Payment Method</label>
                <select id="paiement" name="paiement" class="form-select" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
