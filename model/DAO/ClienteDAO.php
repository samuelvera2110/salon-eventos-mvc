<?php
//Aragundi Fernandez
require_once "config/Conexion.php";
require_once "model/DTO/Cliente.php";

class ClienteDAO {

    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function listar() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar(Cliente $cliente) {
        $sql = "INSERT INTO clientes (cedula, nombre, apellido, email, telefono)
                VALUES (:cedula, :nombre, :apellido, :email, :telefono)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":cedula", $cliente->getCedula());
        $stmt->bindValue(":nombre", $cliente->getNombre());
        $stmt->bindValue(":apellido", $cliente->getApellido());
        $stmt->bindValue(":email", $cliente->getEmail());
        $stmt->bindValue(":telefono", $cliente->getTelefono());

        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}
