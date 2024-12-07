<?php

class Config
{
    private static $pdo = null;

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=suivi',
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function getTables()
    {
        $pdo = self::getConnexion();
        $query = $pdo->query("SHOW TABLES");
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }
}

// Example usage
/*$tables = Config::getTables();
echo "Tables in the database:<br>";
foreach ($tables as $table) {
    echo $table . "<br>";
}*/
