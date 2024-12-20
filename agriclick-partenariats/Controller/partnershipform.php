<?php
// Inclure la configuration de la base de données
require_once '../connexion.php';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Chemin d'enregistrement des images
    $uploadDir = "../Views/img/";
    $newFileName = null; // Initialiser à null au cas où aucun fichier ne serait téléchargé

    // Vérifiez si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Liste des extensions autorisées
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            // Nouveau nom pour éviter les conflits
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            // Déplacement du fichier vers le répertoire cible
            $destPath = $uploadDir . $newFileName;

            if (!move_uploaded_file($fileTmpPath, $destPath)) {
                echo "Erreur lors du déplacement du fichier téléchargé.";
                $newFileName = null; // Réinitialiser en cas d'échec
            }
        } else {
            echo "Type de fichier non autorisé. Seuls les fichiers JPG, JPEG, PNG et GIF sont acceptés.";
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }

    // Récupérer les données du formulaire
    $nom_org = $_POST['nom_organisation'];
    $nom_resp = $_POST['nom_responsable'];
    $e_mail = $_POST['e_mail'];
    $num = $_POST['numéro'];
    $type_part = $_POST['type_partenariat'];
    $des = $_POST['description'];
    

    try {
        // Requête d'insertion avec des paramètres liés
        $sql = "INSERT INTO partenariats (`Nom de l'organisation`, `Nom du responsable`, `Numéro de téléphone`, `Adresse e-mail`, `Type de partenariat`, `Description`, `image`, `status`) 
                VALUES (:nom_org, :nom_resp, :num, :e_mail, :type_part, :des, :image, :status)";
        
        // Préparer la requête
        $stmt = $con->prepare($sql);

        // Lier les paramètres aux variables
        $stmt->bindParam(':nom_org', $nom_org);
        $stmt->bindParam(':nom_resp', $nom_resp);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':e_mail', $e_mail);
        $stmt->bindParam(':type_part', $type_part);
        $stmt->bindParam(':des', $des);
        $stmt->bindParam(':image', $newFileName); // Lier le nom du fichier
        $stmt->bindValue(':status', 'en attente'); // Statut par défaut

        // Exécuter la requête
        $stmt->execute();

        // Message de succès
        echo "<h1>Insertion réussie</h1>";
    } catch(PDOException $e) {
        // Affichage de l'erreur en cas d'échec
        echo "<h1>Erreur d'insertion : " . $e->getMessage() . "</h1>";
    }

    // Fermer la connexion à la base de données
    $con = null;
}
?>
