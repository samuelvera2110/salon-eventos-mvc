<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Reservas</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Listar Reservas</h1>
    <a href="index.php?c=Reserva&f=crear">Nueva Reserva</a>
    <table>
        <thead>
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
                        <td><?php echo htmlspecialchars($reserva['id']); ?></td>  <!-- Cambiado: usa array en lugar de objeto -->
                        <td><?php echo htmlspecialchars($reserva['cliente']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['salon']); ?></td>
                        <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($reserva['fecha_inicio']))); ?></td>
                        <td><?php echo htmlspecialchars(date('H:i', strtotime($reserva['fecha_inicio']))); ?></td>
                        <td><?php echo htmlspecialchars(date('H:i', strtotime($reserva['fecha_fin']))); ?></td>
                        <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                        <td>
                            <a href="index.php?c=reserva&f=editar&id=<?php echo $reserva['id']; ?>">Editar</a> |
                            <a href="index.php?c=reserva&f=eliminar&id=<?php echo $reserva['id']; ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">No hay reservas disponibles.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>