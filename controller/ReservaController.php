<?php
//autor: Samuel Vera
require_once "model/DAO/ReservaDAO.php";
require_once "model/DTO/Reserva.php";
require_once "model/DAO/ClienteDAO.php";
require_once "model/DAO/SalonesDAO.php";
require_once "model/DAO/ServicioDAO.php";

class ReservaController
{

    private $modelReserva;
    private $modelCliente;
    private $modelSalon;
    private $modelServicio;

    public function __construct()
    {
        $this->modelReserva = new ReservaDAO();
        $this->modelCliente = new ClienteDAO();
        $this->modelSalon = new SalonesDAO();
        $this->modelServicio = new ServicioDAO();
    }

    public function index()
    {
        $reservas = $this->modelReserva->selectAll();
        require_once "view/reservas/reserva.listar.php";
    }

    public function crear()
    {
        $clientes = $this->modelCliente->listar();
        $salones = $this->modelSalon->listar();
        $servicios = $this->modelServicio->listar();
        require_once "view/reservas/reserva.crear.php";
    }


    public function editar()
    {
        $clientes = $this->modelCliente->listar();
        $salones = $this->modelSalon->listar();
        $servicios = $this->modelServicio->listar();
        $reserva = $this->modelReserva->findById($_GET['id']);

        require_once "view/reservas/reserva.editar.php";
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $reserva = $this->modelReserva->findById($id);
        if ($reserva) {
            $this->modelReserva->delete($id);
        }
        header("Location: index.php?c=Reserva&f=index");
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $fechaInicio = $_POST['fecha_inicio'] ?? '';
            $fechaFin = $_POST['fecha_fin'] ?? '';
            $idCliente = $_POST['id_cliente'] ?? '';
            $idSalon = $_POST['id_salon'] ?? '';
            $precioPact = $_POST['precio_pactado'] ?? '';
            $estado = $_POST['estado'] ?? 'pendiente';
            $notas = $_POST['notas'] ?? '';

            $reserva = new Reserva($id, $fechaInicio, $fechaFin, $idCliente, $idSalon, $precioPact, $estado, $notas);

            if ($this->modelReserva->verificarFecha($idSalon, $fechaInicio, $fechaFin, $id)) {
                header("Location: index.php?c=reserva&f=editar&id=$id&error=El salón ya tiene una reserva en ese horario");
                exit;
            } 

            if ($this->modelReserva->update($reserva)) {
                $this->modelReserva->deleteServiciosByReserva($id);
                if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
                    foreach ($_POST['servicios'] as $id_servicio) {
                        $cantidad = isset($_POST["cantidad_$id_servicio"]) ? (int) $_POST["cantidad_$id_servicio"] : 1;
                        $this->modelReserva->insertServicioToReserva($id, $id_servicio, $cantidad);
                    }
                }
                header("Location: index.php?c=reserva&f=index&msg=Reserva actualizada exitosamente");
            } else {
                header("Location: index.php?c=reserva&f=editar&id=$id&error=Error al actualizar la reserva");
            }
        } else {
            header("Location: index.php?c=reserva&f=editar&id=" . $_GET['id']);
        }
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fechaInicio = $_POST['fecha_inicio'] ?? '';
            $fechaFin = $_POST['fecha_fin'] ?? '';
            $idCliente = $_POST['id_cliente'] ?? '';
            $idSalon = $_POST['id_salon'] ?? '';
            $precioPact = $_POST['precio_pactado'] ?? '';
            $estado = $_POST['estado'] ?? 'pendiente';
            $notas = $_POST['notas'] ?? '';

            $reserva = new Reserva(null, $fechaInicio, $fechaFin, $idCliente, $idSalon, $precioPact, $estado, $notas);

            $id_reserva = $this->modelReserva->insert($reserva);
            if ($id_reserva) {
                if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
                    foreach ($_POST['servicios'] as $id_servicio) {
                        $cantidad = isset($_POST["cantidad_$id_servicio"]) ? (int) $_POST["cantidad_$id_servicio"] : 1;
                        $this->modelReserva->insertServicioToReserva($id_reserva, $id_servicio, $cantidad);
                    }
                }
                header('Location: index.php?c=reserva&f=index&msg=Reserva creada exitosamente');
            } else {
                header('Location: index.php?c=reserva&f=crear&error=Error al crear la reserva');
            }
        } else {
            header('Location: index.php?c=reserva&f=crear');
        }
    }
}

?>