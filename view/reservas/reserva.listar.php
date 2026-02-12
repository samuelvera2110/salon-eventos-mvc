<!-- Autor: Samuel Vera -->
<?php require_once HEADER; ?>

<div class="container mt-5">
    <h1 class="mb-4">Listar Reservas</h1>
    <a href="index.php?c=reserva&f=crear" class="btn btn-success mb-3">Nueva Reserva</a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Salón</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reservas && is_array($reservas)): ?>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reserva['id']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['cliente']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['salon']); ?></td>
                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($reserva['fecha_inicio']))); ?></td>
                            <td><?php echo htmlspecialchars(date('H:i', strtotime($reserva['fecha_inicio']))); ?></td>
                            <td><?php echo htmlspecialchars(date('H:i', strtotime($reserva['fecha_fin']))); ?></td>
                            <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                            <td>
                                <a href="index.php?c=reserva&f=editar&id=<?php echo $reserva['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?c=reserva&f=eliminar&id=<?php echo $reserva['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay reservas disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once FOOTER; ?>