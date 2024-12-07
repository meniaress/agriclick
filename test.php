<?php
// test_db_connection.php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "suivi";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully.<br>";

    // Test query to check if data is returned
    $sql = "SELECT * FROM animal";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "Query successful! Data retrieved:<br>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Animal ID: " . $row["id_ani"] . " - Name: " . $row["nom_ani"] . "<br>";
        }
    } else {
        echo "0 results found.<br>";
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
