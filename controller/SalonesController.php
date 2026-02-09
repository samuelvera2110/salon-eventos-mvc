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
        if (empty($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }
        
        $resultados = $this->model->listar();
        require_once 'view/salones/salones.list.php';
    }

    public function view_admin() {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
            header("Location: index.php?c=salones&f=index");
            exit;
        }
        $busqueda = isset($_REQUEST['b']) ? $_REQUEST['b'] : "";

        $resultados = $this->model->listar($busqueda);
        require_once 'view/salones/salones.admin.php';
    }
    // Muestra el formulario para registrar un nuevo salón
    public function view_new() {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
            header("Location: index.php");
            exit;
        }
        require_once 'view/salones/salones.new.php';
    }
    
    // Procesa el registro del salón
    public function create() {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
            header("Location: index.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $s = new Salon();
            $s->nombre = htmlspecialchars($_POST['nombre']);
            $s->ubicacion = htmlspecialchars($_POST['ubicacion']);
            $s->medida_metros = floatval($_POST['medida_metros']);
            $s->capacidad = intval($_POST['capacidad']);
            $s->precio_hora = floatval($_POST['precio_hora']);
            $s->descripcion = htmlspecialchars($_POST['descripcion']);
            
            // Validar que el precio o capacidad no sean negativos
            if ($s->precio_hora < 0 || $s->capacidad < 0) {
                    echo "<script>alert('Error: Precio o capacidad no pueden ser negativos'); window.history.back();</script>";
                    return;
                }

            $nombreImagen = "salon_default.jpg"; // Nombre por defecto si no se sube imagen
            
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $archivo = $_FILES['imagen'];
                $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $nuevoNombre = "salon_" . time() . "_" . rand(100, 999) . "." . $extension;
                $destino = "assets/img/salones/" . $nuevoNombre;

                if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                    $nombreImagen = $nuevoNombre;
                }
            }
            
            $s->imagen = $nombreImagen;
            
            if ($this->model->insertar($s)) {
            header("Location: index.php?c=salones&f=view_admin");
            } else {
            echo "Error: No se pudo guardar en la BD. Revisa el DAO.";
            }
            }
    }
    
    // Función para eliminación lógica (cambia estado a 0)
    public function eliminar() {
    if (!isset($_SESSION)) session_start(); 
    if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
        header("Location: index.php");
        exit;
    }
    
    if (isset($_REQUEST['id'])) {
        $id = intval($_REQUEST['id']);
        $this->model->eliminarLogico($id);
    }
    header("Location: index.php?c=salones&f=view_admin");
}

    //Muestra el formulario de edición con los datos actuales del salón
    public function view_edit() {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
            header("Location: index.php");
            exit;
        }
        if (isset($_REQUEST['id'])) {
            $salon = $this->model->buscarPorId($_REQUEST['id']);
            require_once 'view/salones/salones.edit.php';
        }
    }

    // Procesa la actualización del salón
    public function update() {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
        header("Location: index.php");
        exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $s = new Salon();
            $s->id = intval($_POST['id']); 
            $s->nombre = htmlspecialchars($_POST['nombre']);
            $s->ubicacion = htmlspecialchars($_POST['ubicacion']);
            $s->medida_metros = floatval($_POST['medida_metros']);
            $s->capacidad = intval($_POST['capacidad']);
            $s->precio_hora = floatval($_POST['precio_hora']);
            $s->descripcion = htmlspecialchars($_POST['descripcion']);
            $s->estado = 1;
            
            // Validación UX: Redireccionar en lugar de morir
            if ($s->precio_hora < 0 || $s->capacidad < 0) {
            echo "<script>alert('Error: Valores negativos no permitidos'); window.history.back();</script>";
            return;
            }

            //Recuperamos la imagen actual para mantenerla segura en caso de que no se suba una nueva imagen
            $salonActual = $this->model->buscarPorId($s->id);
            $s->imagen = ($salonActual) ? $salonActual->getImagen() : "salon_default.jpg";

            // Si se sube una nueva imagen, la procesamos y actualizamos el nombre en el objeto   
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $archivo = $_FILES['imagen'];
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $nuevoNombre = "salon_" . time() . "_" . rand(100, 999) . "." . $extension;
            $destino = "assets/img/salones/" . $nuevoNombre;

            if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                $s->imagen = $nuevoNombre;
                }
            }

        if ($this->model->editar($s)) {
            header("Location: index.php?c=salones&f=view_admin");
        } else {
            echo "Error: Falló la actualización en la BD.";
        }
        }
    }


    // Función para búsqueda AJAX
    public function buscar() {
    $texto = $_GET['texto'] ?? '';
    $salones = $this->model->buscarSalones($texto);

    if (empty($salones)) {
        echo '<p style="grid-column: 1 / -1; text-align: center; color: #777;">No se encontraron salones con ese criterio.</p>';
        return;
    }

    // Si hay resultados, los mostramos
    foreach ($salones as $salon) {        
        echo '
        <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            
            <img src="assets/img/salones/'. htmlspecialchars($salon->getImagen()) .'" 
                 alt="'. htmlspecialchars($salon->getNombre()) .'" 
                 style="width: 100%; height: 200px; object-fit: cover; display: block;">
            
            <div style="padding: 15px; background: #fff;">
                <h3 style="color: #1a3a5a; margin: 0;">'. htmlspecialchars($salon->getNombre()) .'</h3>
                <p style="font-weight: bold; color: #d4af37;">'. $salon->getMedidaMetros() .' m²</p>
                
                <ul style="list-style: none; padding: 0; font-size: 0.9em; color: #555;">
                    <li><strong>Ubicación:</strong> '. htmlspecialchars($salon->getUbicacion()) .'</li>
                    <li><strong>Capacidad:</strong> '. $salon->getCapacidad() .' personas</li>
                    <li><strong>Precio:</strong> $'. number_format($salon->getPrecioHora(), 2) .' / hora</li>
                </ul>
                
                <p style="font-style: italic; font-size: 0.85em; color: #777;">
                    '. htmlspecialchars($salon->getDescripcion()) .'
                </p>
                
                <button style="width: 100%; padding: 10px; background: #1a3a5a; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    COTIZAR
                </button>
            </div>
        </div>';
    }
}
}