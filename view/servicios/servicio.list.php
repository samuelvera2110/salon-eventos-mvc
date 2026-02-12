<?php require_once HEADER; ?>
<!--Jeremy Guncay-->
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Servicios</h2>
        <a href="index.php?c=Servicio&f=crear" class="btn btn-success">Nuevo Servicio</a>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Servicio</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($servicios as $s): ?>
            <tr>
                <td><?= $s['nombre_servicio'] ?></td>
                <td>$<?= number_format($s['precio'], 2) ?></td>
                <td>
                    <?php if ($s['estado']): ?>
                        <span class="badge bg-success">Activo</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Inactivo</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?c=Servicio&f=editar&id=<?= $s['id_servicio'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="index.php?c=Servicio&f=eliminar&id=<?= $s['id_servicio'] ?>"
                       onclick="return confirm('¿Eliminar servicio?')"
                       class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once FOOTER; ?>
