<?php
// Inclure le fichier de configuration de la base de données
require_once 'database.php';
include_once '../model/Reclamation.php';

class ReclamationList {
    
    // Méthode pour afficher les réclamations
    public function AfficherReclamation() {
        $sql = 'SELECT * FROM reclamtion'; // Assurez-vous que le nom de la table est correct
        $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO
        try {
            $list = $db->query($sql);
            return $list->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les résultats
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}

// Créer une instance de la classe ReclamationList
$reclamationList = new ReclamationList();
$offers = $reclamationList->AfficherReclamation(); // Récupérer les réclamations

session_start(); // Démarrer la session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des réclamations</title>
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
            background-color: #ff5f33; /* Rouge pour la suppression */
        }
        .btn-delete:hover {
            background-color: #c82333; /* Légère teinte plus foncée pour le survol */
        }
    </style>
</head>
<body>
    <h1>Liste des réclamations</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php
// Afficher les réclamations
foreach ($offers as $offer) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($offer['id']) . '</td>';
    echo '<td>' . htmlspecialchars($offer['nom']) . '</td>';
    echo '<td>' . htmlspecialchars($offer['email']) . '</td>';
    echo '<td>' . htmlspecialchars($offer['sujet']) . '</td>';
    echo '<td>' . htmlspecialchars($offer['message']) . '</td>';
    echo '<td>' . (isset($offer['status']) && $offer['status'] !== '' ? htmlspecialchars($offer['status']) : 'Non défini') . '</td>'; // Vérification de 'status'
    
    echo '<td class="actions">
            <a href="updaterec.php?id=' . htmlspecialchars($offer['id']) . '" class="btn">Modifier</a>
            <a href="deleterec.php?id=' . htmlspecialchars($offer['id']) . '" class="btn btn-delete">Supprimer</a>
          </td>';
    
    echo '</tr>';
}
?>
</tbody>
    </table>
</body>
</html>