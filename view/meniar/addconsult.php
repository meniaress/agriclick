<?php
// Start the session if needed
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include necessary files
    include_once '../../controllers/crudconsult.php';
    include_once '../../model/consults.php';

    // Validate and set id_ani
    $id_ani = (int)$_POST['id_ani']; // Assuming id_ani is passed from the form

    // Create a new Consults object
    $consult = new Consults($id_ani, $_POST['nomp'], $_POST['telp'], $_POST['antmedicaux'], $_POST['diagnostic'], $_POST['reco'], $_POST['datec']);

    // Create an instance of the controller
    $consultController = new CrudConsult();

    // Call the method to add the consultation
    $consultController->addConsult($consult);

    // Redirect to the consultation page
    header("Location: consult.php");
    exit(); // Always call exit after header redirection
}
?>