<?php

class Config {
    private static $host = 'localhost';
    private static $db = 'projet';
    private static $user = 'root';
    private static $pass = '';
    private static $connexion;

    public static function getConnexion() {
        if (self::$connexion === null) {
            try {
                self::$connexion = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db, self::$user, self::$pass);
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }
        return self::$connexion;
    }
}
?>
