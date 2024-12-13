<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Include the controller
include_once '../controllers/ServiceController.php';

// Initialize the controller
$serviceController = new ServiceController();

$service=null;

if (
    isset($_POST["title"])  && $_POST["description"] && $_POST["localisation"] && $_POST["tarif"]  && $_POST["category"] && $_POST["type"]
) {
    if (
        !empty($_POST["title"])  && !empty($_POST["description"]) && !empty($_POST["localisation"]) && !empty($_POST["tarif"]) && !empty($_POST["category"]) && !empty($_POST["type"])
    
    ) {
        $service = new Service(
            null, // ID
            $_POST['title'], // Title
            $_POST['description'], // Description
            $_POST['category'], // Category (was mismatched)
            $_POST['localisation'], // Localisation
            $_POST['type'], // Type
            floatval($_POST['tarif']), // Tarif (convert to float)
        );
        
        //
        $serviceController->addService($service);

       header('Location:dash.php');
    } else
        $error = "Missing information";
}


?>
