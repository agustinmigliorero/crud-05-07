<?php 

class DB {
    private static $user = "root";
    private static $password = "";

    public static function connection() {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=videogame_db', self::$user, self::$password);
            return $dbh;
        } catch (PDOException $e) {
            throw new PDOException("No se pudo conectar a la base de datos");
        }
    }
}