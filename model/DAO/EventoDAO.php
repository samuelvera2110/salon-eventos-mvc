<?php
//autor: Joel Gortaire
require_once __DIR__ . "/../../config/Conexion.php";
require_once __DIR__ . "/../DTO/Evento.php";

class EventoDAO {

    private $cn;

    public function __construct() {
        $this->cn = Conexion::getConexion();
    }

public function listar() {
    $sql = "SELECT e.*, s.nombre
            FROM eventos e
            INNER JOIN salones s ON e.id_salon = s.id
            ORDER BY e.fecha_evento DESC";
    $stmt = $this->cn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function insertar(Evento $e) {
    $sql = "INSERT INTO eventos 
    (nombre_evento, tipo_evento, fecha_evento, hora_evento, cliente, id_salon, asistentes)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->cn->prepare($sql);
    $stmt->execute([
        $e->nombre,
        $e->tipo,
        $e->fecha,
        $e->hora,
        $e->cliente,     // ← ahora es cliente
        $e->id_salon,
        $e->asistentes
    ]);
}


    public function obtenerPorId($id) {
        $stmt = $this->cn->prepare("SELECT * FROM eventos WHERE id_evento=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar(Evento $e) {
    $sql = "UPDATE eventos SET
        nombre_evento=?, 
        tipo_evento=?, 
        fecha_evento=?, 
        hora_evento=?,
        cliente=?, 
        id_salon=?, 
        asistentes=?
        WHERE id_evento=?";

    $stmt = $this->cn->prepare($sql);
    $stmt->execute([
        $e->nombre,
        $e->tipo,
        $e->fecha,
        $e->hora,
        $e->cliente,
        $e->id_salon,
        $e->asistentes,
        $e->id
    ]);
}

    public function eliminar($id) {
        $stmt = $this->cn->prepare("DELETE FROM eventos WHERE id_evento=?");
        $stmt->execute([$id]);
    }
}
