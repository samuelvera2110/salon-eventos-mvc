<?php

// Aragundi Fernandez
require_once "model/DAO/ClienteDAO.php";
require_once "model/DTO/Cliente.php";

class ClienteController {

    private $dao;

    public function __construct() {
        $this->dao = new ClienteDAO();
    }

    public function index() {
        $clientes = $this->dao->listar();
        require_once "view/clientes/index.php";
    }

    public function crear() {
        require_once "view/clientes/crear.php";
    }

    public function guardar() {

        $cliente = new Cliente();
        $cliente->setCedula($_POST['cedula']);
        $cliente->setNombre($_POST['nombre']);
        $cliente->setApellido($_POST['apellido']);
        $cliente->setEmail($_POST['email']);
        $cliente->setTelefono($_POST['telefono']);

        $this->dao->insertar($cliente);

        header("Location: index.php?c=Cliente&f=index");
        exit();
    }

    public function eliminar() {
        $this->dao->eliminar($_GET['id']);
        header("Location: index.php?c=Cliente&f=index");
        exit();
    }
}
