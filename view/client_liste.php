<?php
// Inclure les fichiers nécessaires
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\model\config.php';
require_once '../Controller/ClientC.php';

// Créer une instance du contrôleur ClientC
$clientC = new ClientC();

// Récupérer tous les clients
$clients = $clientC->getClients();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <!-- Lien vers le CSS pour un style plus moderne -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #004200; /* Couleur verte */
            color: #fff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tbody tr:last-child {
            border-bottom: none;
        }
        .actions {
            display: flex; /* Flexbox pour aligner les boutons côte à côte */
            justify-content: center; /* Centrer les boutons */
        }
        .btn {
            padding: 5px 10px;
            background-color: #004200; /* Boutons avec couleur verte */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 10px; /* Espace entre les boutons */
        }
        .btn:hover {
            background-color: #003300; /* Légère teinte plus foncée pour le survol */
        }
        .btn-delete {
            background-color: #ff5f33;/* Rouge pour la suppression */
        }
        .btn-delete:hover {
            background-color: #c82333; /* Légère teinte plus foncée pour le survol */
        }
    </style>
</head>
<body>
    <h1>Liste des clients</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Choix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Parcourir et afficher les clients
            foreach ($clients as $client) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($client['id']) . '</td>';
                echo '<td>' . htmlspecialchars($client['nom']) . '</td>';
                echo '<td>' . htmlspecialchars($client['prenom']) . '</td>';
                echo '<td>' . htmlspecialchars($client['nom_utilisateur']) . '</td>';
                echo '<td>' . htmlspecialchars($client['email']) . '</td>';
                echo '<td>' . htmlspecialchars($client['telephone']) . '</td>';
                echo '<td>' . htmlspecialchars($client['choix']) . '</td>';
                echo '<td class="actions">
                        <a href="edit_client.php?id=' . $client['id'] . '" class="btn">Modifier</a>
                        <a href="delete_client.php?id=' . $client['id'] . '" class="btn btn-delete">Supprimer</a>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
