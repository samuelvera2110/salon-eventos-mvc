<?php require_once HEADER; ?>
<!-- Aragundi Fernandez -->

<div class="container mt-5">

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📋 Listado de Clientes</h4>
            <a href="index.php?c=Cliente&f=crear" class="btn btn-light btn-sm">
                + Nuevo Cliente
            </a>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($clientes)): ?>
                            <?php foreach ($clientes as $c): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <?= $c['id'] ?>
                                        </span>
                                    </td>
                                    <td><?= $c['cedula'] ?></td>
                                    <td><?= $c['nombre'] ?></td>
                                    <td><?= $c['apellido'] ?></td>
                                    <td><?= $c['email'] ?></td>
                                    <td><?= $c['telefono'] ?></td>
                                    <td class="text-center">
                                        <a href="index.php?c=Cliente&f=eliminar&id=<?= $c['id'] ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">
                                            🗑 Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No hay clientes registrados.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<?php require_once FOOTER; ?>
