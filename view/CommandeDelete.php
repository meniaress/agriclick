<?php
include_once '../controllers/CommandeController.php';

$commandeController = new CommandeController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);

        // Delete the command
        $commandeController->deleteCommande($id);

        // Redirect to the command list with success message
        header('Location: CommandeList.php?deleted=1&id=' . $id);
        exit;
    } else {
        echo "Invalid request.";
        exit;
    }
}
?>