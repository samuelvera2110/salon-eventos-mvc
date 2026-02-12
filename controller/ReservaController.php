<?php
//autor: Samuel Vera
require_once "model/DAO/ReservaDAO.php";
require_once "model/DTO/Reserva.php";
require_once "model/DAO/ClienteDAO.php";
require_once "model/DAO/SalonesDAO.php";

class ReservaController
{

    private $modelReserva;
    private $modelCliente;
    private $modelSalon;

    public function __construct()
    {
        $this->modelReserva = new ReservaDAO();
        $this->modelCliente = new ClienteDAO();
        $this->modelSalon = new SalonesDAO();
    }

    public function index()
    {
        $reservas = $this->modelReserva->selectAll();
        require_once "view/reservas/reserva.listar.php";
    }

    public function crear()
    {
        //metodo crear de reserva controlador
        $clientes = $this->modelCliente->listar();
        $salones = $this->modelSalon->listar();
        require_once "view/reservas/reserva.crear.php";
    }


    public function editar()
    {
        $clientes = $this->modelCliente->listar();
        $salones = $this->modelSalon->listar();
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
        $reserva = new Reserva();
        $reserva->setId($_POST['id']);
        $reserva->setFechaInicio($_POST['fecha_inicio']);
        $reserva->setFechaFin($_POST['fecha_fin']);
        $reserva->setIdCliente($_POST['id_cliente']);
        $reserva->setIdSalon($_POST['id_salon']);
        $reserva->setPrecioPact($_POST['precio_pactado']);
        $reserva->setEstado($_POST['estado']);

        if ($this->modelReserva->update($reserva)) {
            header("Location: index.php?c=Reserva&f=index");
        } else {
            header("Location: index.php?c=Reserva&f=editar&id=" . $_POST['id'] . "&error=Error al actualizar la reserva");
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
            if ($this->modelReserva->insert($reserva)) {
                header('Location: index.php?c=reserva&f=index&msg=Reserva creada exitosamente');
                exit();
            } else {
                header('Location: index.php?c=reserva&f=crear&error=Error al crear la reserva');
                exit();
            }
        } else {
            header('Location: index.php?c=reserva&f=crear');
            exit();
        }
    }
}

?>