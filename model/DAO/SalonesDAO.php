<?php
//autor: Bryan López León
//DAO: Data Access Object
require_once 'config/Conexion.php';
require_once 'model/DTO/Salon.php';

class SalonesDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    // Listar solo salones activos (estado = 1)
    public function listar($busqueda = "") {
        try {
            $sql = "SELECT * FROM salones WHERE estado = 1";
            
            if ($busqueda != "") {
                $sql .= " AND (nombre LIKE :busqueda OR ubicacion LIKE :busqueda)";
            }
            
            $stmt = $this->con->prepare($sql);
            
            if ($busqueda != "") {
                $stmt->bindValue(":busqueda", "%" . $busqueda . "%", PDO::PARAM_STR);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Salon');
        } catch (PDOException $e) {
            return [];
        }
}
    //Función para buscar un salón por su ID (usada en editar y eliminar)
    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM salones WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            // Retorna un objeto Salon
            return $stmt->fetchObject('Salon');
        } catch (PDOException $er) {
            error_log("Error en selectOne de SalonesDAO " . $er->getMessage());
            return null;
        }
    }

    // Inserta un nuevo salón en la base de datos
    public function insertar($salon) {
        
        try {
            $sql = "INSERT INTO salones (nombre, ubicacion, medida_metros, capacidad, precio_hora, descripcion, imagen, estado) 
                    VALUES (:nom, :ubi, :med, :cap, :pre, :des, :img, 1)";
            
            $stmt = $this->con->prepare($sql);
            
            
            $stmt->bindValue(":nom", $salon->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":ubi", $salon->getUbicacion(), PDO::PARAM_STR);
            $stmt->bindValue(":med", $salon->getMedidaMetros(), PDO::PARAM_STR);
            $stmt->bindValue(":cap", $salon->getCapacidad(), PDO::PARAM_INT);
            $stmt->bindValue(":pre", $salon->getPrecioHora(), PDO::PARAM_STR);
            $stmt->bindValue(":des", $salon->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(":img", $salon->getImagen(), PDO::PARAM_STR);

            $res = $stmt->execute(); 
            return $res;
        } catch (PDOException $er) {
            error_log("Error en insert de SalonesDAO " . $er->getMessage());
            return false;
        }
    }

    // Método para actualizar un salón
    public function editar($salon) {
        try {
            $sql = "UPDATE salones SET 
                    nombre = :nombre, 
                    ubicacion = :ubicacion, 
                    medida_metros = :medida, 
                    capacidad = :capacidad, 
                    precio_hora = :precio, 
                    descripcion = :descripcion, 
                    imagen = :imagen 
                    WHERE id = :id";
            
            $stmt = $this->con->prepare($sql);
            
            // Vinculamos los valores usando los Getters
            $stmt->bindValue(":nombre", $salon->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":ubicacion", $salon->getUbicacion(), PDO::PARAM_STR);
            $stmt->bindValue(":medida", $salon->getMedidaMetros(), PDO::PARAM_STR);
            $stmt->bindValue(":capacidad", $salon->getCapacidad(), PDO::PARAM_INT);
            $stmt->bindValue(":precio", $salon->getPrecioHora(), PDO::PARAM_STR);
            $stmt->bindValue(":descripcion", $salon->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(":imagen", $salon->getImagen(), PDO::PARAM_STR);
            
            $stmt->bindValue(":id", $salon->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en DAO update: " . $e->getMessage(); 
            die(); // Detiene la ejecución para que leer el error
            return false;
        }
    }

    // Método para eliminar un salón (Cambiar estado a 0)
    public function eliminarLogico($id) {
        try {
            $sql = "UPDATE salones SET estado=0 WHERE id=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en logicalDelete de SalonesDAO " . $er->getMessage());
            return false;
        }
    }
    public function buscarSalones($texto) {
        try {
            $sql = "SELECT * FROM salones WHERE nombre LIKE ? OR ubicacion LIKE ?";
            $stmt = $this->con->prepare($sql); 
            $param = "%" . $texto . "%";
            $stmt->execute(array($param, $param));
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Salon');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
