<?php
//autor: Bryan López León
//DAO: Data Access Object
require_once 'config/Conexion.php';

class SalonesDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM salones WHERE estado = 1";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            // Retorna un array de objetos de la clase Salon
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Salon');
        } catch (Exception $e) {
            return [];
        }
    }

    public function insertar(Salon $s) {
        try {
            $sql = "INSERT INTO salones (nombre, ubicacion, medida_metros, capacidad, precio_hora, descripcion) 
                    VALUES (:nom, :ubi, :med, :cap, :pre, :des)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":nom", $s->nombre);
            $stmt->bindValue(":ubi", $s->ubicacion);
            $stmt->bindValue(":med", $s->medida_metros);
            $stmt->bindValue(":cap", $s->capacidad);
            $stmt->bindValue(":pre", $s->precio_hora);
            $stmt->bindValue(":des", $s->descripcion);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}
