<?php
// Include the database configuration file
include_once 'C:\Users\chokr\OneDrive\Bureau\xamppp\htdocs\Agriclickk\config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id_animal = $_POST['id_animal'];
    $nomp = $_POST['nomp'];
    $telp = $_POST['telp'];
    $antmedicaux = $_POST['antmedicaux'];
    $diagnostic = $_POST['diagnostic'];
    $reco = $_POST['reco'];
    $datec = $_POST['datec'];

    try {
        // Prepare the insert query
        $stmt = $pdo->prepare("INSERT INTO consultation (id_animal, nomp, telp, antmedicaux, diagnostic, reco, datec) 
                               VALUES (:id_ani, :nomp, :telp, :antmedicaux, :diagnostic, :reco, :datec)");

        // Bind the parameters
        $stmt->bindParam(':id_animal', $id_animal);
        $stmt->bindParam(':nomp', $nomp);
        $stmt->bindParam(':telp', $telp);
        $stmt->bindParam(':antmedicaux', $antmedicaux);
        $stmt->bindParam(':diagnostic', $diagnostic);
        $stmt->bindParam(':reco', $reco);
        $stmt->bindParam(':datec', $datec);

        // Execute the query
        $stmt->execute();

        // Redirect or show success message
        echo "Consultation has been successfully added!";
    } catch (PDOException $e) {
        // If something goes wrong, show the error message
        echo "Error: " . $e->getMessage();
    }
}
?>
