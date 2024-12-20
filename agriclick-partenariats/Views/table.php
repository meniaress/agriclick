<?php
$bddPDO = new PDO('mysql:host=localhost;dbname=projet web', 'root', '');
$bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$request = "SELECT * from partenariats";
$result = $bddPDO->query($request);

if (!$result) {
    echo 'La récupération des données a rencontré un problème';
} else {
    $nbr_partenaires = $result->rowCount();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<table border="1">
    <tr>
        <th>Nom de l'organisation</th>
        <th>Nom du responsable</th>
        <th>Numéro de téléphone</th>
        <th>Adresse e-mail</th>
        <th>Type de partenariat</th>
        <th>Description</th>
        <th>Image</th>
        <th>Status</th>
        <th>id</th>
        <th>Actions</th>
    </tr>

<?php
while ($ligne = $result->fetch(PDO::FETCH_NUM)) {
    echo "<tr>";
    foreach ($ligne as $valeur) {
        echo "<td>$valeur</td>";
    }
    // Use the id (assuming it’s the 7th column in your result set) to create the action buttons
    $id = $ligne[8]; // Adjust index if 'id' column is in a different position
    
    echo "
    <td class='actions'>
        <button class='delete-button' onclick='confirmDelete($id)'>
            🗑️ Supprimer
        </button>
        <button class='edit-button' onclick=\"window.location.href='../Controller/edit.php?id=$id'\">
            ✏️ Modifier
        </button>
        <form action='../Controller/acceptPartner.php' method='post' style='display:inline-block;'>
            <input type='hidden' name='id' value='<?php echo $id; ?>'>
            <input type='hidden' name='email' value='<?php echo $ligne[3]; ?>'> 
            <button class='accept-button' onclick='acceptPartner($id)'>✔️ Afficher</button>
        </form>
    </td>";
}
?>

</table>

<script>
function confirmDelete(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce partenariat ?")) {
        // Redirect to delete.php with the id parameter
        window.location.href = `../Controller/delete.php?id=${id}`;
    }
}

function openEditForm(orgName) {
    const newValue = prompt(`Enter the new value for the organization: ${orgName}`);
    if (newValue) {
        // Redirect to edit.php with parameters
        window.location.href = `edit.php?orgName=${encodeURIComponent(orgName)}&column=columnName&newValue=${encodeURIComponent(newValue)}`;
    }
}
function acceptPartner(id) {
    $.ajax({
        url: '../Controller/acceptPartner.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            // Vérifiez la réponse pour voir si la mise à jour a été effectuée
            alert('Partenariat accepté');
            // Mettre à jour dynamiquement la cellule du statut dans la table
            $('#Status-' + id).text('accepté');
        },
        error: function() {
            alert('Erreur lors de l\'acceptation du partenariat');
        }
    });
}

</script>