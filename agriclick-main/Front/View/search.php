<?php
$host = 'localhost';
$db = 'suivi'; // Replace with your database name
$user = 'root';     // Replace with your database username
$pass = '';     // Replace with your database password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        
        // Prepare the SQL statement
        $stmt = $pdo->prepare("SELECT * FROM animal WHERE nom_ani LIKE :search OR espece LIKE :search");
        $stmt->execute(['search' => "%$search%"]);

        // Fetch results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            foreach ($results as $row) {
                echo "<div>" . htmlspecialchars($row['nom_ani']) . " - " . htmlspecialchars($row['espece']) . "</div>";
            }
        } else {
            echo "No results found.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>