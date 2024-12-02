<?php
// Vérifier si un identifiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Connexion à la base de données
        $bddPDO = new PDO('mysql:host=localhost;dbname=projet web', 'root', '');
        $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer les informations du partenariat
        $query = "SELECT * FROM partenariats WHERE id = :id";
        $stmt = $bddPDO->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Vérification si un partenariat a été trouvé
        if ($stmt->rowCount() > 0) {
            $partenaire = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Partenariat non trouvé.";
            exit();
        }

    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_org = $_POST['nom_organisation'];
    $nom_resp = $_POST['nom_responsable'];
    $e_mail = $_POST['e_mail'];
    $num = $_POST['numéro'];
    $type_part = $_POST['type_partenariat'];
    $des = $_POST['description'];
    $status = $_POST['status'];
    

    try {
        // Mettre à jour les données dans la base
        $updateQuery = "UPDATE partenariats SET 
                        `Nom de l'organisation` = :nom_org, 
                        `Nom du responsable` = :nom_resp, 
                        `Numéro de téléphone` = :num, 
                        `Adresse e-mail` = :e_mail, 
                        `Type de partenariat` = :type_part, 
                        `Description` = :des,
                        `Status` = :status

                        WHERE id = :id";
        
        $stmt = $bddPDO->prepare($updateQuery);
        $stmt->bindParam(':nom_org', $nom_org);
        $stmt->bindParam(':nom_resp', $nom_resp);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':e_mail', $e_mail);
        $stmt->bindParam(':type_part', $type_part);
        $stmt->bindParam(':des', $des);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Rediriger après la mise à jour
            header("Location: ../Views/dash.php?update=1");
            exit();
        } else {
            echo "Erreur : La mise à jour a échoué.";
        }
    } catch (PDOException $e) {
        echo "Erreur de mise à jour : " . $e->getMessage();
    }
}
?>

<!-- Formulaire de modification -->
<form method="POST" onsubmit="return validateForm()">
    <label for="partnerName">Nom de l'organisation</label>
    <input type="text" name="nom_organisation" id="partnerName" value="<?= htmlspecialchars($partenaire["Nom de l'organisation"]) ?>" required>
    <small id="partnerNameError" class="error-message"></small>

    <label for="contactName">Nom du responsable</label>
    <input type="text" name="nom_responsable" id="contactName" value="<?= htmlspecialchars($partenaire['Nom du responsable']) ?>" required>
    <small id="contactNameError" class="error-message"></small>

    <label for="email">Adresse email</label>
    <input type="email" name="e_mail" id="email" value="<?= htmlspecialchars($partenaire['Adresse e-mail']) ?>" required>
    <small id="emailError" class="error-message"></small>

    <label for="phone">Numéro de téléphone</label>
    <input type="text" name="numéro" id="phone" value="<?= htmlspecialchars($partenaire['Numéro de téléphone']) ?>" required>
    <small id="phoneError" class="error-message"></small>

    <label for="partnershipType">Type de partenariat</label>
    <select name="type_partenariat" id="partnershipType" required>
        <option value="">--Choisir un type--</option>
        <option <?= $partenaire['Type de partenariat'] == 'Formation' ? 'selected' : '' ?>>Formation</option>
        <option <?= $partenaire['Type de partenariat'] == 'Soutien financier' ? 'selected' : '' ?>>Soutien financier</option>
        <option <?= $partenaire['Type de partenariat'] == 'Services professionnels' ? 'selected' : '' ?>>Services professionnels</option>
        <option <?= $partenaire['Type de partenariat'] == 'Promotion mutuelle' ? 'selected' : '' ?>>Promotion mutuelle</option>
    </select>
    <small id="partnershipTypeError" class="error-message"></small>

    <label for="description">Description</label>
    <textarea name="description" id="description" required><?= htmlspecialchars($partenaire['Description']) ?></textarea>
    <small id="descriptionError" class="error-message"></small>

    <label for="status">Statut du partenariat</label>
    <select name="status" id="status">
        <option value="en attente" <?= $partenaire['Status'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
        <option value="accepté" <?= $partenaire['Status'] == 'accepté' ? 'selected' : '' ?>>Accepté</option>
        <option value="refusé" <?= $partenaire['Status'] == 'refusé' ? 'selected' : '' ?>>Refusé</option>
    </select>
    <small id="statusError" class="error-message"></small>

    <button type="submit">Modifier</button>
</form>

<script>
function validateForm() {
    let isValid = true;

    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(msg => msg.textContent = '');

    // Validation rules
    const partnerName = document.getElementById('partnerName');
    if (!partnerName.value.match(/^[a-zA-ZÀ-ÿ\s-]{3,}$/)) {
        document.getElementById('partnerNameError').textContent = "Le nom de l'organisation doit contenir au moins 3 lettres.";
        isValid = false;
    }

    const contactName = document.getElementById('contactName');
    if (!contactName.value.match(/^[a-zA-ZÀ-ÿ\s-]{3,}$/)) {
        document.getElementById('contactNameError').textContent = "Le nom du responsable doit contenir au moins 3 lettres.";
        isValid = false;
    }

    const email = document.getElementById('email');
    if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        document.getElementById('emailError').textContent = "Veuillez entrer une adresse e-mail valide.";
        isValid = false;
    }

    const phone = document.getElementById('phone');
    if (!phone.value.match(/^\d{8,15}$/)) {
        document.getElementById('phoneError').textContent = "Le numéro de téléphone doit contenir entre 8 et 15 chiffres.";
        isValid = false;
    }

    const partnershipType = document.getElementById('partnershipType');
    if (partnershipType.value === "") {
        document.getElementById('partnershipTypeError').textContent = "Veuillez sélectionner un type de partenariat.";
        isValid = false;
    }

    const description = document.getElementById('description');
    if (description.value.trim() === "") {
        document.getElementById('descriptionError').textContent = "Veuillez fournir une description.";
        isValid = false;
    }

    return isValid;
}
</script>

<style>
.error-message {
    color: red;
    font-size: 0.9em;
    margin-top: 5px;
    display: block;
}
</style>
