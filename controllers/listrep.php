<?php
// Inclure le fichier de configuration de la base de données
require_once 'database.php';
include_once '../model/rep.php';

class ReponseList {
    
    // Méthode pour afficher les réponses
    public function AfficherReponse() {
        $sql = 'SELECT * FROM reponse'; // Assurez-vous que le nom de la table est correct
        $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO
        try {
            $list = $db->query($sql);
            return $list->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les résultats
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}

// Créer une instance de la classe ReponseList
$reponseList = new ReponseList();
$responses = $reponseList->AfficherReponse(); // Récupérer les réponses

session_start(); // Démarrer la session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réponses</title>
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
    <h1>Liste des Réponses</h1>

    <table>
        <thead>
            <tr>
                <th>ID Réponse</th>
                <th>Contenu</th>
=                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php
// Afficher les réponses
foreach ($responses as $response) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($response['id_rep']) . '</td>'; // ID de la réponse
    echo '<td>' . htmlspecialchars($response['contenu']) . '</td>'; // Contenu de la réponse
    echo '<td class="actions">
            <a href="updaterep.php?id_rep=' . htmlspecialchars($response['id_rep']) . '" class="btn">Modifier</a>
            <a href="deleterep.php?id_rep=' . htmlspecialchars($response['id_rep']) . '" class="btn btn -delete">Supprimer</a>
          </td>';
    echo '</tr>';
}
?>
        </tbody>
    </table>
</body>
</html>