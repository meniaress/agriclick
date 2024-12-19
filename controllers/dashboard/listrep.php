<?php
// Inclure le fichier de configuration de la base de données
require_once '../database.php';
include_once '../../model/rep.php';

class ReponseList {
    // Méthode pour afficher les réponses
    public function AfficherReponse($type = null) {
        // Join the reponse table with the reclamation table
        $sql = 'SELECT r.*, rec.sujet, rec.message 
                FROM reponse r 
                JOIN reclamtion rec ON r.id_rec = rec.id'; // Ajustez les noms de table et de colonne si nécessaire

        // If a type is specified, filter the results
        if ($type) {
            $sql .= ' WHERE r.type = :type';
        }

        $db = Config::getConnexion(); // Assurez-vous que cette méthode renvoie une instance PDO
        try {
            $stmt = $db->prepare($sql);
            if ($type) {
                $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les résultats
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}

// Créer une instance de la classe ReponseList
$reponseList = new ReponseList();

// Get the type from the GET request if it exists
$type = isset($_GET['type']) ? $_GET['type'] : null;
$responses = $reponseList->AfficherReponse($type); // Récupérer les réponses

session_start(); // Démarrer la session
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liste des Réponses - agriCLICK Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="img/icon.png" />
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    
                <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="#">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="../../view/indexadmincat.php">Gestion des offres et categories
                        </a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="../Reclamationlist.php">
                Gestion des reclamations
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link active" href="listrep.php">
                Gestion des reponses
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../../view/dash.php">
                Gestion des commandes et des services
              </a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link"  href="../../view/back office/client_liste.php">Gestion des Utilisateurs</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                       
                        <p class="sidebar-menu-title">Dash menu</p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://localhost/projet%202/view/back%20office/statistique.php" aria-expanded="false" aria-controls="auth">
                <i class="typcn typcn-user-add-outline menu-icon"></i>
                <span class="menu-title">Statistiques des Clients</span>
                <i class="menu-arrow"></i>
              </a>
             
            </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistiques.php">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Statistiques des Réponses<span class="badge badge-primary ml-3">New</span></span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <h1 class="mb-4">Liste des Réponses</h1>
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="listrep.php" style="text-align: center; margin:20px;">
                                <label for="type">Recherche par type de réponse:</label>
                                <select name="type" id="type">
                                    <option value="">--Tous les types--</option>
                                    <option value="normale" <?php echo (isset($type) && $type == 'normale') ? 'selected' : ''; ?>>Normale</option>
                                    <option value="positive" <?php echo (isset($type) && $type == 'positive') ? 'selected' : ''; ?>>Positive</option>
                                    <option value="negative" <?php echo (isset($type) && $type == 'negative') ? 'selected' : ''; ?>>Négative</option>
                                </select>
                                <button type="submit">Rechercher</button>
                            </form>
                            <button id="download-pdf" class="btn btn-primary">Télécharger PDF</button>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sujet de Réclamation</th>
                                            <th>Message de Réclamation</th>
                                            <th>Contenu</th>
                                            <th>Admin</th>
                                            <th>Type</th>
                                            <th>Date de Réponse</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($responses as $response) {
                                            echo '<tr>'; 
                                            echo '<td>' . htmlspecialchars($response['sujet']) . '</td>';
                                            echo '<td>' . htmlspecialchars($response['message']) . '</td>';
                                            echo '<td>' . htmlspecialchars($response['contenu']) . '</td>';
                                            echo '<td>' . htmlspecialchars($response['admin']) . '</td>';
                                            echo '<td>' . htmlspecialchars($response['type']) . '</td>';
                                            echo '<td>' . htmlspecialchars($response['date_rep']) . '</td>';
                                            echo '<td class="actions">
                                                    <a href="../updaterep.php?id_rep=' . htmlspecialchars($response['id_rep']) . '" class="btn btn-warning btn-sm">Modifier</a>
                                                    <a href="../deleterep.php?id_rep=' . htmlspecialchars($response['id_rep']) . '" class="btn btn-danger btn-sm">Supprimer</a>
                                                  </td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if (empty($responses)): ?>
                                <div class="text-center mt-4">
                                    <p class="text-muted">Aucune réponse trouvée.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'pt', 'a4'); // Format paysage

        // Titre
        doc.setFontSize(16);
        doc.text('Liste des Réponses', 14, 22);

        // Espace entre le titre et les en-têtes
        const spaceBetweenTitleAndHeader = 20; // Ajustez cette valeur pour plus ou moins d'espace
        let startY = 30 + spaceBetweenTitleAndHeader; // Nouvelle position Y pour les en-têtes

        // En-têtes de colonnes
        doc.setFontSize(12); // Augmenter la taille de la police des en-têtes
        const headers = ['Sujet de Réclamation', 'Message de Réclamation', 'Contenu', 'Admin', 'Type', 'Date de Réponse'];
        const columnWidths = [150, 150, 150, 100, 100, 120]; // Largeurs des colonnes
        let startX = 14;

        // Dessiner les en-têtes
        headers.forEach((header, index) => {
            doc.text(header, startX, startY);
            startX += columnWidths[index];
        });

        // Dessiner une ligne sous les en-têtes
        doc.setLineWidth(1);
        doc.line(14, startY + 5, 14 + columnWidths.reduce((a, b) => a + b, 0), startY + 5); // Ligne horizontale

        // Récupérer les données de la table
        const rows = document.querySelectorAll('table tbody tr');
        let y = startY + 20; // Position Y pour les lignes de données

        rows.forEach(row => {
            const cols = row.querySelectorAll('td');
            startX = 14; // Réinitialiser la position X pour chaque ligne

            for (let i = 0; i < cols.length - 1; i++) {
                const text = doc.splitTextToSize(cols[i].innerText, columnWidths[i]); // Diviser le texte pour qu'il tienne dans la colonne
                doc.text(text, startX, y);
                startX += columnWidths[i]; // Avancer à la prochaine colonne
            }

            y += 30; // Augmenter la hauteur des lignes
        });

        // Télécharger le PDF
        doc.save('liste_reponses.pdf');
    });
    </script>
</body>
</html>