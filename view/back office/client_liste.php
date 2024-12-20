<?php
include_once 'C:\xampp\htdocs\projet 2\model\client.php';
include_once 'C:\xampp\htdocs\projet 2\controllers\database.php';
require_once 'C:\xampp\htdocs\projet 2\controllers\clientc.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Ajoutez vos autres fichiers CSS ici -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="img/icon.png" />
    <style>
      </style>
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
                        <a class="nav-link " href="../elyes/dash.php">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../indexadmincat.php">
                Gestion des offres et categories
              </a>
            </li>
                    <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="../../controllers/Reclamationlist.php">
                Gestion des reclamations
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="../../controllers/dashboard/listrep.php">
                Gestion des reponses
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../meniar/dash.php">
                Gestion de suivi
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="../dash.php">
                Gestion des commandes et des services
              </a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link active"  href="client_liste.php">Gestion des Utilisateurs</a>
                    </li>
          </ul>
          </div>
      </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        
                        
                        <p class="sidebar-menu-title">Dash menu</p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard <span class="badge badge-primary ml-3">New</span></span>
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
                        <a class="nav-link active" href="../../controllers/dashboard/statistiques.php">
                            <i class="typcn typcn-chart-bar menu-icon"></i>
                            <span class="menu-title">Statistiques des Réponses</span>
                        </a>
                    </li>
                    <!-- Add other sidebar items here -->
                </ul>
            </nav>
        
             <!-- Main content -->
             <div class="main-panel">
            <div class="content-wrapper">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h1>Liste des clients</h1>

                    <!-- Recherche -->
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
                        <button class="btn btn-danger btn-sm" type="submit">Rechercher</button>
                    </form>

                    <!-- Tableau des clients -->
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                            <tr>
                                <th>photo de profil</th>
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
                            <?php if (empty($clients)): ?>
                                <tr>
                                    <td colspan="8" style="text-align: center; color: red;">Aucun utilisateur trouvé.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($clients as $client): ?>
                                    <?php
                                    $photoPath = '/projet 2/uploads/' . ($client['photo'] && file_exists($_SERVER['DOCUMENT_ROOT'] . '/projet 2/uploads/' . $client['photo']) ? htmlspecialchars($client['photo']) : 'default_profile.png');
                                    ?>
                                    <tr>
                                        <td><img src="<?php echo $photoPath; ?>" alt="Photo de profil" width="50" height="50"></td>
                                        <td><?php echo htmlspecialchars($client['nom']); ?></td>
                                        <td><?php echo htmlspecialchars($client['prenom']); ?></td>
                                        <td><?php echo htmlspecialchars($client['nom_utilisateur']); ?></td>
                                        <td><?php echo htmlspecialchars($client['email']); ?></td>
                                        <td><?php echo htmlspecialchars($client['telephone']); ?></td>
                                        <td><?php echo htmlspecialchars($client['choix']); ?></td>
                                        <td class="actions">
                                            <a href="edit_client.php?id=<?php echo $client['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                            <a href="http://localhost/projet/controller/delete_client.php?id=<?php echo $client['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                                </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashboard/vendors/js/vendor.bundle.base.js"></script>
    <script src="../dashboard/js/off-canvas.js"></script>
    <script src="../dashboard/js/hoverable-collapse.js"></script>
    <script src="../dashboard/js/template.js"></script>
    <script src="../dashboard/js/settings.js"></script>
    <script src="../dashboard/js/todolist.js"></script>
    <script src="../dashboard/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../dashboard/vendors/chart.js/Chart.min.js"></script>
    <script src="../dashboard/js/dashboard.js"></script>
</body>
</html>