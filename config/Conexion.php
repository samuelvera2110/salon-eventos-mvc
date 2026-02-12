<?php
class Conexion {

    private static $conexion = null;

    public static function getConexion() {

        if (self::$conexion === null) {
            try {
                $host = "localhost";
                $db   = DBNAME;  
                $user = DBUSER;  
                $pass = DBPASSWORD;  
                $charset = "utf8mb4";

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                self::$conexion = new PDO($dsn, $user, $pass);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        return self::$conexion;
    }
}