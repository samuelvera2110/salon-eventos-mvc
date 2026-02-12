<?php
// Autor: Jeremy Guncay
require_once "model/DAO/ServicioDAO.php";
require_once "model/DTO/ServicioDTO.php";

class ServicioController {

    private $dao;

    public function __construct() {
        $this->dao = new ServicioDAO();
    }

    public function index() {
        $servicios = $this->dao->listar();
        require_once __DIR__ . '/../view/servicios/servicio.list.php';

    }

    public function guardar() {

        $servicio = new ServicioDTO();
        $servicio->setNombreServicio($_POST['nombre']);
        $servicio->setDescripcion($_POST['descripcion']);
        $servicio->setPrecio($_POST['precio']);
        $servicio->setEstado($_POST['estado']);

        $this->dao->insertar($servicio);

        header("Location: index.php?c=Servicio&f=index");
        exit();
    }

    public function eliminar() {
        $this->dao->eliminar($_GET['id']);
        header("Location: index.php?c=Servicio&f=index");
        exit();
    }

    public function crear() {
    require_once __DIR__ . '/../view/servicios/servicio.new.php';
}


public function editar() {
    $servicio = $this->dao->obtener($_GET['id']);
    require_once __DIR__ . '/../view/servicios/servicio.edit.php';
}

public function actualizar() {
    $servicio = new ServicioDTO();

    $servicio->setIdServicio($_POST['id_servicio']);
    $servicio->setNombreServicio($_POST['nombre']);
    $servicio->setDescripcion($_POST['descripcion']);
    $servicio->setPrecio($_POST['precio']);
    $servicio->setEstado($_POST['estado']);

    $this->dao->actualizar($servicio);

    header("Location: index.php?c=Servicio&f=index");
    exit();
}

}
