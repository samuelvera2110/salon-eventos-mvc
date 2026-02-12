<!-- Autor: Samuel Vera -->
<?php require_once HEADER; ?>

<div class="container mt-5">
    <h1 class="mb-4">Lista de Reservas</h1>
    <?php if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 3): ?>
        <a href="index.php?c=reserva&f=crear" class="btn btn-primary mb-3">Crear Nueva Reserva</a>
    <?php endif; ?>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <?php if ($reservas && is_array($reservas)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Salón</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Precio Pactado Salón</th>
                    <th>Estado</th>
                    <th>Servicios</th>
                    <?php if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 3): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reserva['id']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['cliente_nombre'] . ' ' . ($reserva['cliente_apellido'] ?? '')); ?></td>
                        <td><?php echo htmlspecialchars($reserva['salon_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['fecha_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['fecha_fin']); ?></td>
                        <td>$<?php echo htmlspecialchars($reserva['precio_pactado_salon']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                        <td>
                            <?php
                            require_once "config/Conexion.php";
                            $conexion = Conexion::getConexion();
                            $stmt = $conexion->prepare("SELECT s.nombre_servicio, rs.cantidad FROM reserva_servicios rs JOIN servicios s ON rs.id_servicio = s.id_servicio WHERE rs.id_reserva = ?");
                            $stmt->execute([$reserva['id']]);
                            $serviciosReserva = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if ($serviciosReserva) {
                                foreach ($serviciosReserva as $serv) {
                                    echo htmlspecialchars($serv['nombre_servicio'] . ' (x' . $serv['cantidad'] . ')') . '<br>';
                                }
                            } else {
                                echo 'Ninguno';
                            }
                            ?>
                        </td>
                        <?php if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 3): ?>
                            <td>
                                <a href="index.php?c=reserva&f=editar&id=<?php echo $reserva['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?c=reserva&f=eliminar&id=<?php echo $reserva['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta reserva?')">Eliminar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay reservas disponibles.</p>
    <?php endif; ?>
</div>

<?php require_once FOOTER; ?>