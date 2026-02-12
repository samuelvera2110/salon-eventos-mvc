<!-- autor: Bryan López -->
<?php require_once HEADER; ?>

<main class="container mt-5">
    <h2 class="mb-4">Panel de Gestión: Salones</h2>

    <!-- Botones de acción -->
    <div class="mb-4">
        <a href="index.php?c=salones&f=view_new" class="btn btn-success me-2">
            + Registrar Nuevo Salón
        </a>
        <a href="index.php?c=salones&f=index" class="btn btn-secondary">
            Volver a Vista Cliente
        </a>
    </div>

    <!-- Tabla de salones -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Capacidad</th>
                    <th>Precio/h</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $s): ?>
                <tr>
                    <td><?php echo $s->getId(); ?></td>
                    <td><?php echo htmlspecialchars($s->getNombre()); ?></td>
                    <td><?php echo htmlspecialchars($s->getUbicacion()); ?></td>
                    <td><?php echo $s->getCapacidad(); ?></td>
                    <td>$<?php echo number_format($s->getPrecioHora(), 2); ?></td>
                    <td>
                        <a href="index.php?c=salones&f=view_edit&id=<?php echo $s->getId(); ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="index.php?c=salones&f=eliminar&id=<?php echo $s->getId(); ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once FOOTER; ?>
