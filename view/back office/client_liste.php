<?php
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';

$clientC = new ClientC();


$role = isset($_GET['role']) ? $_GET['role'] : '';
$nom_utilisateur = isset($_GET['nom_utilisateur']) ? trim($_GET['nom_utilisateur']) : '';


if (!empty($role) || !empty($nom_utilisateur)) {
    $clients = $clientC->searchClients($role, $nom_utilisateur);
} else {
    $clients = $clientC->getClients(); 
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
  
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
            background-color: #004200; 
            color: #fff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tbody tr:last-child {
            border-bottom: none;
        }
        .actions {
            display: flex; 
            justify-content: center; 
        }
        .btn {
            padding: 5px 10px;
            background-color: #004200; 
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 10px; 
        }
        .btn:hover {
            background-color: #003300; 
        }
        .btn-delete {
            background-color: #ff5f33;
        }
        .btn-delete:hover {
            background-color: #c82333; 
        }

        form button {
            padding: 5px 10px;
            background-color: #004200; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #003300;
        }
    </style>
</head>
<body>
    <h1>Liste des clients</h1>
<!-----recherche---------------------------------------------------------------------------->
    <form method="GET" action="client_liste.php" style="text-align: center; margin: 20px;">
    <label for="role">Rechercher par rôle :</label>
    <select name="role" id="role">
        <option value="">--Tous les rôles--</option>
        <option value="Saisonnier">Saisonnier</option>
        <option value="Vétérinaire">Vétérinaire</option>
        <option value="Agriculteur">Agriculteur</option>
        <option value="Mécanicien">Mécanicien</option>
    </select>
    <label for="nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" name="nom_utilisateur" id="nom_utilisateur" placeholder="Entrer un nom d'utilisateur">
        <button type="submit">Rechercher</button>
</form>
<!---------------------------------------------------------------------------->
    <table>
        <thead>
            <tr>
         <th>photo</th>   
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
    foreach ($clients as $client) {
        // Si la photo existe, on l'affiche. Sinon, on utilise 'default_profile.png'.
        $photoPath = '/projet/uploads/' . ($client['photo'] ? htmlspecialchars($client['photo']) : 'default_profile.png');

        echo '<tr>';
        echo '<td><img src="' . $photoPath . '" alt="Photo de profil" width="50" height="50"></td>';
        echo '<td>' . htmlspecialchars($client['nom']) . '</td>';
        echo '<td>' . htmlspecialchars($client['prenom']) . '</td>';
        echo '<td>' . htmlspecialchars($client['nom_utilisateur']) . '</td>';
        echo '<td>' . htmlspecialchars($client['email']) . '</td>';
        echo '<td>' . htmlspecialchars($client['telephone']) . '</td>';
        echo '<td>' . htmlspecialchars($client['choix']) . '</td>';
        echo '<td class="actions">
                <a href="edit_client.php?id=' . $client['id'] . '" class="btn">Modifier</a>
                <a href="http://localhost/projet/controller/delete_client.php?id=' . $client['id'] . '" class="btn btn-delete">Supprimer</a>
              </td>';
        echo '</tr>';
    }
    ?>
</tbody>

    </table>
</body>
</html>
