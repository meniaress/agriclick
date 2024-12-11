<?php
include_once 'C:\xampp\htdocs\projet\model\client.php';
include_once 'C:\xampp\htdocs\projet\config.php';
require_once 'C:\xampp\htdocs\projet\controller\clientc.php';

// Créer une instance du contrôleur ClientC
$clientC = new ClientC();

// Récupérer le nombre de clients pour chaque choix
$saisonnierCount = $clientC->countClientsByChoice('Saisonnier');
$veterinaireCount = $clientC->countClientsByChoice('Vétérinaire');
$agriculteurCount = $clientC->countClientsByChoice('Agriculteur');
$mecanicienCount = $clientC->countClientsByChoice('Mécanicien');

// Récupérer le nombre de comptes créés par nom
$creationData = $clientC->countClientsByCreationDate();
$creationLabels = [];
$creationCounts = [];
foreach ($creationData as $row) {
    $creationLabels[] = $row['creation_date'];
    $creationCounts[] = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Clients</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Inclure Chart.js -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }
        canvas {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Statistiques des Clients</h1>
        
        <div class="chart-container">
            <canvas id="choixChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="creationChart"></canvas>
        </div>

        <script>
            // Données dynamiques venant du PHP pour le premier graphique
            var saisonnier = <?php echo $saisonnierCount; ?>;
            var veterinaire = <?php echo $veterinaireCount; ?>;
            var agriculteur = <?php echo $agriculteurCount; ?>;
            var mecanicien = <?php echo $mecanicienCount; ?>;

            // Données dynamiques venant du PHP pour le deuxième graphique
            var creationLabels = <?php echo json_encode($creationLabels); ?>;
            var creationCounts = <?php echo json_encode($creationCounts); ?>;

            var ctx1 = document.getElementById('choixChart').getContext('2d');
            var ctx2 = document.getElementById('creationChart').getContext('2d');
            
            // Premier graphique (clients par choix)
            var choixChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Saisonnier', 'Vétérinaire', 'Agriculteur', 'Mécanicien'],
                    datasets: [{
                        label: 'Nombre de Clients',
                        data: [saisonnier, veterinaire, agriculteur, mecanicien],
                        backgroundColor: ['#004d00', '#009900', '#66cc33', '#33cc33'],
                        borderColor: '#004d00',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            // Deuxième graphique (comptes créés par date)
            var creationChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: creationLabels,
                    datasets: [{
                        label: 'Comptes créés par jour',
                        data: creationCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        </script>
    </div>
</body>
</html>
