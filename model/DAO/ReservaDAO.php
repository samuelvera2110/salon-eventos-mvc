<?php
//Autor: Samuel Vera
require_once 'config/Conexion.php';
require_once 'model/DTO/Reserva.php';

class ReservaDAO
{
    private $con;

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function selectAll()
    {
        $sql = "SELECT r.*, 
                       c.nombre AS cliente_nombre, c.apellido AS cliente_apellido,
                       s.nombre AS salon_nombre
                FROM reservas r
                JOIN clientes c ON r.id_cliente = c.id
                JOIN salones s ON r.id_salon = s.id
                ORDER BY r.id DESC";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(Reserva $reserva)
    {
        try {
            $sql = "INSERT INTO reservas (fecha_inicio, fecha_fin, id_cliente, id_salon, precio_pactado_salon, estado, notas) 
                VALUES (:fecha_inicio, :fecha_fin, :id_cliente, :id_salon, :precio_pactado, :estado, :notas)";

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':fecha_inicio', $reserva->getFechaInicio());
            $stmt->bindValue(':fecha_fin', $reserva->getFechaFin());
            $stmt->bindValue(':id_cliente', $reserva->getIdCliente());
            $stmt->bindValue(':id_salon', $reserva->getIdSalon());
            $stmt->bindValue(':precio_pactado', $reserva->getPrecioPact());
            $stmt->bindValue(':estado', $reserva->getEstado());
            $stmt->bindValue(':notas', $reserva->getNotas());

            if ($stmt->execute()) {
                return $this->con->lastInsertId(); 
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error en insertar Reserva: " . $e->getMessage());
            return false;
        }
    }

    public function update(Reserva $reserva)
    {
        try {
            $sql = "UPDATE reservas SET fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, id_cliente = :id_cliente, id_salon = :id_salon, precio_pactado_salon = :precio_pactado, estado = :estado, notas = :notas WHERE id = :id";  // Cambiado: precio_pactado_salon
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':fecha_inicio', $reserva->getFechaInicio());
            $stmt->bindValue(':fecha_fin', $reserva->getFechaFin());
            $stmt->bindValue(':id_cliente', $reserva->getIdCliente());
            $stmt->bindValue(':id_salon', $reserva->getIdSalon());
            $stmt->bindValue(':precio_pactado', $reserva->getPrecioPact());
            $stmt->bindValue(':estado', $reserva->getEstado());
            $stmt->bindValue(':notas', $reserva->getNotas());
            $stmt->bindValue(':id', $reserva->getIdReserva());
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en actualizar Reserva: " . $e->getMessage());
            return false;
        }
    }


    public function findById($idReserva)
    {
        try {
            $sql = "SELECT r.*, c.nombre as cliente, s.nombre as salon 
                    FROM reservas r
                    INNER JOIN clientes c ON r.id_cliente = c.id
                    INNER JOIN salones s ON r.id_salon = s.id
                    WHERE r.id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id', $idReserva);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en buscar Reserva por ID: " . $e->getMessage());
            return false;
        }
    }

    public function updateEstado($idReserva, $nuevoEstado)
    {
        try {
            $sql = "UPDATE reservas SET estado = :estado WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':estado', $nuevoEstado);
            $stmt->bindValue(':id', $idReserva);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en actualizar estado de Reserva: " . $e->getMessage());
            return false;
        }
    }

    public function delete($idReserva)
    {
        try {
            $sql = "DELETE FROM reservas WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id', $idReserva);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en eliminar Reserva: " . $e->getMessage());
            return false;
        }
    }

    public function deleteServiciosByReserva($id_reserva)
    {
        $sql = "DELETE FROM reserva_servicios WHERE id_reserva = :id_reserva";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":id_reserva", $id_reserva);
        return $stmt->execute();
    }

    public function insertServicioToReserva($id_reserva, $id_servicio, $cantidad)
    {
        $sql = "INSERT INTO reserva_servicios (id_reserva, id_servicio, cantidad, precio_pactado) VALUES (:id_reserva, :id_servicio, :cantidad, 0)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":id_reserva", $id_reserva);
        $stmt->bindValue(":id_servicio", $id_servicio);
        $stmt->bindValue(":cantidad", $cantidad);
        return $stmt->execute();
    }

    public function verificarFecha($id_salon, $fecha_inicio, $fecha_fin, $id_reserva = null) {
        $sql = "SELECT COUNT(*) FROM reservas WHERE id_salon = :id_salon 
                AND fecha_inicio < :fecha_fin AND fecha_fin > :fecha_inicio";
        if ($id_reserva) {
            $sql .= " AND id != :id_reserva";  
        }
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":id_salon", $id_salon);
        $stmt->bindValue(":fecha_inicio", $fecha_inicio);
        $stmt->bindValue(":fecha_fin", $fecha_fin);
        if ($id_reserva) {
            $stmt->bindValue(":id_reserva", $id_reserva);
        }
        $stmt->execute();
        return $stmt->fetchColumn() > 0; 
    }
}

?>