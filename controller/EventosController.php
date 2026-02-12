<?php
//autor: Joel Gortaire
require_once "model/DAO/EventoDAO.php";
require_once "model/DTO/Evento.php";
require_once "model/DAO/ClienteDAO.php";
require_once "model/DAO/SalonesDAO.php";


class EventosController {

    public function index() {
        $this->listar();
    }

    
    // listado de eventos
    public function listar() {
        $dao = new EventoDAO();
        $eventos = $dao->listar();
        require "view/eventos/listar.php";
    }

    // formulario de creación
public function crear() {

    $clienteDAO = new ClienteDAO();
    $salonesDAO = new SalonesDAO();

    $clientes = $clienteDAO->listar();
    $salones = $salonesDAO->listar();

    require "view/eventos/crear.php";
}


    // Guardar evento (POST)
    public function guardar() {
        $e = new Evento();

        $e->nombre     = $_POST['nombre_evento'] ?? '';
        $e->tipo       = $_POST['tipo_evento'] ?? '';
        $e->fecha      = $_POST['fecha_evento'] ?? '';
        $e->hora       = $_POST['hora_evento'] ?? '';
        $e->cliente = $_POST['id_cliente'];
        $e->id_salon   = $_POST['id_salon'];
        $e->asistentes = $_POST['asistentes'] ?? 0;

        $dao = new EventoDAO();
        $dao->insertar($e);

        header("Location: index.php?c=Eventos&a=listar");
        exit;
    }

    // formulario de edición
    public function editar() {

    if (!isset($_GET['id'])) {
        header("Location: index.php?c=Eventos&a=listar");
        exit;
    }

    $dao = new EventoDAO();
    $evento = $dao->obtenerPorId($_GET['id']);

    $clienteDAO = new ClienteDAO();
    $salonesDAO = new SalonesDAO();

    $clientes = $clienteDAO->listar();
    $salones = $salonesDAO->listar();

    require "view/eventos/editar.php";
}


    // Actualizar evento (POST)
    public function actualizar() {
        $e = new Evento();

        $e->id         = $_POST['id_evento'];
        $e->nombre     = $_POST['nombre_evento'];
        $e->tipo       = $_POST['tipo_evento'];
        $e->fecha      = $_POST['fecha_evento'];
        $e->hora       = $_POST['hora_evento'];
        $e->cliente = $_POST['cliente'];
        $e->id_salon   = $_POST['id_salon'];
        $e->asistentes = $_POST['asistentes'];

        $dao = new EventoDAO();
        $dao->actualizar($e);

        header("Location: index.php?c=Eventos&a=listar");
        exit;
    }

    // Eliminar evento
    public function eliminar() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?c=Eventos&a=listar");
            exit;
        }

        $dao = new EventoDAO();
        $dao->eliminar($_GET['id']);

        header("Location: index.php?c=Eventos&a=listar");
        exit;
    }

}

