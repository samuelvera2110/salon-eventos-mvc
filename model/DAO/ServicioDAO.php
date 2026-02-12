<?php
// Autor: Jeremy Guncay

require_once "config/Conexion.php";
require_once "model/DTO/ServicioDTO.php";

class ServicioDAO {

    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function listar() {
        $sql = "SELECT * FROM servicios";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM servicios WHERE id_servicio = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar(ServicioDTO $servicio) {

        $sql = "INSERT INTO servicios
                (nombre_servicio, descripcion, precio, estado)
                VALUES (:nombre, :descripcion, :precio, :estado)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(":nombre", $servicio->getNombreServicio());
        $stmt->bindValue(":descripcion", $servicio->getDescripcion());
        $stmt->bindValue(":precio", $servicio->getPrecio());
        $stmt->bindValue(":estado", $servicio->getEstado());

        return $stmt->execute();
    }

    public function actualizar(ServicioDTO $servicio) {

        $sql = "UPDATE servicios SET
                nombre_servicio = :nombre,
                descripcion = :descripcion,
                precio = :precio,
                estado = :estado
                WHERE id_servicio = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(":nombre", $servicio->getNombreServicio());
        $stmt->bindValue(":descripcion", $servicio->getDescripcion());
        $stmt->bindValue(":precio", $servicio->getPrecio());
        $stmt->bindValue(":estado", $servicio->getEstado());
        $stmt->bindValue(":id", $servicio->getIdServicio());

        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM servicios WHERE id_servicio = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}
