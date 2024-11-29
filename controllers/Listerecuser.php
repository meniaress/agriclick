<?php
// Inclure le fichier de configuration de la base de données
require_once 'database.php';
include_once '../model/Reclamation.php';

$email = 'khadijaderbel123@gmail.com'; // Email fixe pour lequel afficher les réclamations

class ReclamationList {
    
    // Méthode pour afficher les réclamations d'un utilisateur spécifique
    public function AfficherReclamation($email) {
        $sql = 'SELECT * FROM reclamtion WHERE email = :email'; // Utilisation de :email
        $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email); // Liaison correcte du paramètre
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les résultats
        } catch (Exception $e) {
            die ('Erreur: ' . $e->getMessage());
        }
    }
}

// Créer une instance de la classe ReclamationList
$reclamationList = new ReclamationList();
$offers = $reclamationList->AfficherReclamation($email); // Récupérer les réclamations de cet email

session_start(); // Démarrer la session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des réclamations</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->

    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        .container {
            max-width: 1500px;
            margin: 5% auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 100px 100px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            justify-content: center; 
        }
        table {
            width: 100%;
            margin: 30px 0;
            border-collapse: collapse;
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
        .return-link {
            display: block;
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            color: #004200;
        }
       
    </style>
</head>
<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3">
        <a href="index.html" class="navbar-brand">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Agri</span>CLICK</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <a href="product.html" class="nav-item nav-link">Product</a>
                <a href="../view/form.php" class="nav-item nav-link">Reclamation</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container">
        <h1>Liste des réclamations pour l'email : <?php echo htmlspecialchars($email); ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Afficher les réclamations
                if (empty($offers)) {
                    echo '<tr><td colspan="5">Aucune réclamation trouvée.</td></tr>';
                } else {
                    foreach ($offers as $offer) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($offer['nom']) . '</td>';
                        echo '<td>' . htmlspecialchars($offer['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($offer['sujet']) . '</td>';
                        echo '<td>' . htmlspecialchars($offer['message']) . '</td>';
                        
                        // Récupérer la date de création
                        $date_creation = new DateTime($offer['date_creation']);
                        $date_actuelle = new DateTime();
                        $interval = $date_actuelle->diff($date_creation);
                        
                        // Vérifier si moins d'une heure s'est écoulée depuis la création
                        if ($interval->h < 1 && $interval->days == 0) {
                            echo '<td class="actions">
                                    <a href="updaterecu.php?id=' . $offer['id'] . '" class="btn">Modifier</a>
                                    <a href="deleterecu.php?id=' . $offer['id'] . '" class="btn btn-delete">Annuler la réclamation</a>
                                  </td>';
                        } else {
                            echo '<td class="actions">
                                    <span>Modification/Déletion fermée</span>
                                  </td>';
                        }
                        
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>