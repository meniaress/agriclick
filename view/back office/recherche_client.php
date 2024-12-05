<form method="POST" action="index.php">
    <label for="role">Choisir un rôle :</label>
    <select name="role" id="role">
        <option value="Saisonnier">Saisonnier</option>
        <option value="Vétérinaire">Vétérinaire</option>
        <option value="Agriculteur">Agriculteur</option>
    </select>
    <input type="submit" value="Rechercher">
</form>

<?php if (!empty($clients)): ?>
    <ul>
        <?php foreach ($clients as $client): ?>
            <li><?= htmlspecialchars($client['nom']) . ' ' . htmlspecialchars($client['prenom']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun client trouvé.</p>
<?php endif; ?>
