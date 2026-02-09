<!-- autor: Bryan López -->
<?php require_once HEADER; ?>

<main class="container">
    <h2>Panel de Gestión: Salones</h2>
    <div style="margin-bottom: 20px;">
        <a href="index.php?c=salones&f=view_new" style="background: #28a745; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">+ Registrar Nuevo Salón</a>
        <a href="index.php?c=salones&f=index" style="background: #6c757d; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; margin-left: 10px;">Volver a Vista Cliente</a>
    </div>

    
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <tr style="background: #eee;">
            <th>ID</th>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Capacidad</th>
            <th>Precio/h</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($resultados as $s): ?>
        <tr>
            <td><?php echo $s->getId(); ?></td>
            <td><?php echo htmlspecialchars($s->getNombre()); ?></td>
            <td><?php echo htmlspecialchars($s->getUbicacion()); ?></td>
            <td><?php echo $s->getCapacidad(); ?></td>
            <td>$<?php echo number_format($s->getPrecioHora(), 2); ?></td>
            <td>
                <a href="index.php?c=salones&f=view_edit&id=<?php echo $s->getId(); ?>">Editar</a> | 
                <a href="index.php?c=salones&f=eliminar&id=<?php echo $s->getId(); ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php require_once FOOTER; ?>