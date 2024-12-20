<html>
<thead class="table-primary">
<tr>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Numéro de téléphone</th>
    <th>Adresse e-mail</th>
    <th>Nom de la formation</th>
    <th>id formation</th>
</tr>
</thead>
<tbody>
<?php
while ($ligne = $result->fetch(PDO::FETCH_NUM)) {
    echo "<tr>";
    foreach ($ligne as $valeur) {
        echo "<td>$valeur</td>";
    }
    $id = $ligne[8]; // Ajuster l'index pour l'ID si nécessaire
    echo "
    <td class='actions'>
        <button class='btn btn-danger btn-sm' onclick='confirmDelete($id)'>
            <i class='bi bi-trash'></i> Supprimer
        </button>
        <button class='btn btn-warning btn-sm' onclick=\"window.location.href='../Controller/edit.php?id=$id'\">
            <i class='bi bi-pencil'></i> Modifier
        </button>
        <form action='../Controller/acceptPartner.php' method='post' style='display:inline-block;'>
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='email' value='{$ligne[3]}'> 
            <button type='submit' class='btn btn-success btn-sm'>
                <i class='bi bi-check-circle'></i> Accepter
            </button>
        </form>
    </td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>
<?php if ($nbr_partenaires == 0): ?>
<div class="text-center mt-4">
<p class="text-muted">Aucun partenariat trouvé.</p>
</div>
<?php endif; ?>
</div>
</div>
</div>
</div>

<script>
function confirmDelete(id) {
if (confirm("Êtes-vous sûr de vouloir supprimer ce partenariat ?")) {
window.location.href = `../Controller/delete.php?id=${id}`;
}
}
</script>



</html>