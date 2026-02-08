<?php
//autor: Bryan López León
require_once 'model/DAO/SalonesDAO.php';
require_once 'model/DTO/Salon.php';

class SalonesController {
    private $model;

    public function __construct() {
        $this->model = new SalonesDAO();
    }

    // Función principal: Lista todos los salones
    public function index() {
        if (!isset($_SESSION)) session_start();
        
        // Verificación de sesión para acceso autorizado [cite: 53]
        if (empty($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }

        $resultados = $this->model->listar();
        require_once 'view/salones/salones.list.php';
    }

    // Muestra el formulario de nuevo registro
    public function view_new() {
        require_once 'view/salones/salones.new.php';
    }

    // Procesa el registro del salón
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $s = new Salon();
            // Validación de lado del servidor para parámetros POST
            $s->nombre = htmlspecialchars($_POST['nombre']);
            $s->ubicacion = htmlspecialchars($_POST['ubicacion']);
            $s->medida_metros = floatval($_POST['medida_metros']);
            $s->capacidad = intval($_POST['capacidad']);
            $s->precio_hora = floatval($_POST['precio_hora']);
            $s->descripcion = htmlspecialchars($_POST['descripcion']);

            $exito = $this->model->insertar($s);
            
            if ($exito) {
                header("Location: index.php?c=salones&f=index");
            } else {
                echo "Error al registrar el salón.";
            }
        }
    }
    public function view_admin() {
    if (!isset($_SESSION)) session_start();
    
    // Seguridad: Solo el rol 1 (Administrador) puede entrar aquí
    if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
        header("Location: index.php?c=salones&f=index");
        exit;
    }

    $resultados = $this->model->listar();
    require_once 'view/salones/salones.admin.php'; // La tabla de gestión de Salones
}
}