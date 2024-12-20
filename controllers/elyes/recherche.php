<?php
try {
    $con = new PDO('mysql:host=localhost;dbname=reclamation', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Initialiser la variable des résultats
    $partenariats = [];

    // Mapping des alias d'URL vers les noms de colonnes de la base de données
$columnMapping = [
    'nom_org' => 'Nom de l\'organisation',
    'responsable' => 'Nom du responsable',
    'telephone' => 'Numéro de téléphone',
    'email' => 'Adresse e-mail',
    'type' => 'Type de partenariat',
    'description' => 'Description',
    'status' => 'Status',
    'id' => 'id'
];

// Vérifier si une recherche a été effectuée
if (isset($_GET['searchColumn']) && isset($_GET['searchValue']) && !empty($_GET['searchColumn']) && !empty($_GET['searchValue'])) {
    $searchColumnAlias = $_GET['searchColumn'];
    $searchValue = $_GET['searchValue'];

    // Décoder l'alias de colonne en un vrai nom de colonne
    if (array_key_exists($searchColumnAlias, $columnMapping)) {
        $searchColumn = $columnMapping[$searchColumnAlias];
    } else {
        throw new Exception("Colonne de recherche non valide.");
    }

    // Préparer la requête SQL pour la recherche
$sql = "SELECT * FROM partenariats WHERE `$searchColumn` LIKE :searchValue";
$stmt = $con->prepare($sql);
$stmt->bindValue(':searchValue', '%' . $searchValue . '%');
$stmt->execute();

$partenariats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $partenariats = [];
}


    $nbr_partenaires = count($partenariats);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

include_once 'partnershipform.php';
include_once 'dash.php'
?>
