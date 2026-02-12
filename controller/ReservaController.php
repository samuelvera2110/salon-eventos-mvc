<?php
//autor: Samuel Vera
require_once "model/DAO/ReservaDAO.php";
require_once "model/DTO/Reserva.php";
require_once "model/DAO/ClienteDAO.php";
require_once "model/DAO/SalonesDAO.php";

class ReservaController {

    private $modelReserva;
    private $modelCliente;
    private $modelSalon;

    public function __construct() {
        $this->modelReserva = new ReservaDAO();
        $this->modelCliente = new ClienteDAO();
        $this->modelSalon = new SalonesDAO();
    }

    public function index() {
        $reservas = $this->modelReserva->selectAll();
        require_once "view/reservas/listar.php";
    }

    public function crear() {
        //metodo crear de reserva controlador
        $reservas = $this->modelSalon->create();
        require_once "view/reservas/crear.php";
    }
}




?>