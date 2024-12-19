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
        td img {
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="img/logo-mini.svg" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link " href="#">Gestion des Partenariats</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="../indexadmincat.php">Gestion des offres et categories
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
              <a class="nav-link" href="../dash.php">
                Gestion des commandes et des services
              </a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link active" href="client_liste.php">Gestion des Utilisateurs</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-name">
                </div>
              </div>
              <div class="nav-search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                  <div class="input-group-append">
                    <span class="input-group-text" id="search">
                      <i class="typcn typcn-zoom"></i>
                    </span>
                  </div>
                </div>
              </div>
              <p class="sidebar-menu-title">Dash menu</p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard </span>
              </a>
            </li>
            
           
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://localhost/projet%202/view/back%20office/statistique.php" aria-expanded="false" aria-controls="auth">
                <i class="typcn typcn-user-add-outline menu-icon"></i>
                <span class="menu-title">Statistiques des Clients</span>
                <i class="menu-arrow"></i>
              </a>
             
            </li>
            <li class="nav-item">
                        <a class="nav-link" href="../../controllers/dashboard/statistiques.php">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Statistiques des Réponses<span class="badge badge-primary ml-3">New</span></span>
                        </a>
                    </li>
          </ul>
        </nav>
        
            <!-- Main content -->
            <div class="main-panel">
                <div class="content-wrapper">
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
                        <button type="submit">Rechercher</button>
                    </form>

                    <!-- Tableau des clients -->
                    <table>
                        <thead>
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
                                    $photoPath = '/projet%202/uploads/' . ($client['photo'] && file_exists($_SERVER['DOCUMENT_ROOT'] . '/projet%202/uploads/' . $client['photo']) ? htmlspecialchars($client['photo']) : 'default_profile.png');
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
                                            <a href="edit_client.php?id=<?php echo $client['id']; ?>" class="btn">Modifier</a>
                                            <a href="http://localhost/projet%202/controllers/delete_client.php?id=<?php echo $client['id']; ?>" class="btn btn-delete">Supprimer</a>
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

    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
