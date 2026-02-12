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
        try {
            $sql = "SELECT r.*, c.nombre as cliente, s.nombre as salon 
                    FROM reservas r
                    INNER JOIN clientes c ON r.id_cliente = c.id
                    INNER JOIN salones s ON r.id_salon = s.id
                    ORDER BY r.fecha_inicio DESC";

            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error en listar Reservas: " . $e->getMessage());
            return false;
        }
    }

    public function insert(Reserva $reserva){
    try{
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
        
        return $stmt->execute();
    }catch(PDOException $e){
        var_dump($e->getMessage());  // Agrega esto: muestra el error de BD
        error_log("Error en insertar Reserva: " . $e->getMessage());
        return false;
    }
}

    public function update(Reserva $reserva) {
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
 

    public function findById($idReserva){
        try{
            $sql = "SELECT r.*, c.nombre as cliente, s.nombre as salon 
                    FROM reservas r
                    INNER JOIN clientes c ON r.id_cliente = c.id
                    INNER JOIN salones s ON r.id_salon = s.id
                    WHERE r.id = :id";  
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id', $idReserva);  
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            error_log("Error en buscar Reserva por ID: " . $e->getMessage());
            return false;
        }
    }

    public function updateEstado($idReserva, $nuevoEstado){
        try{
            $sql = "UPDATE reservas SET estado = :estado WHERE id = :id";  
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':estado', $nuevoEstado);
            $stmt->bindValue(':id', $idReserva); 
            return $stmt->execute();
        }catch(PDOException $e){
            error_log("Error en actualizar estado de Reserva: " . $e->getMessage());
            return false;
        }
    }

    public function delete($idReserva){
        try{
            $sql = "DELETE FROM reservas WHERE id = :id";  
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id', $idReserva);  
            return $stmt->execute();
        }catch(PDOException $e){
            error_log("Error en eliminar Reserva: " . $e->getMessage());
            return false;
        }
    }
}

?>