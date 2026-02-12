<?php require_once HEADER; ?>

<div class="container mt-5">
    <h2 class="mb-4">Listado de Eventos</h2>

    <a href="index.php?c=Eventos&f=crear" class="btn btn-primary mb-3">
        + Nuevo Evento
    </a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Evento</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Salón</th>
                <th>Asistentes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($eventos as $e): ?>
            <tr>
                <td><?= $e['id_evento'] ?></td>
                <td><?= htmlspecialchars($e['nombre_evento']) ?></td>
                <td><?= $e['tipo_evento'] ?></td>
                <td><?= $e['fecha_evento'] ?></td>
                <td><?= $e['hora_evento'] ?></td>
                <td><?= htmlspecialchars($e['cliente']) ?></td>
                <td><?= $e['nombre'] ?></td>
                <td><?= $e['asistentes'] ?></td>
                <td>
                    <a class="btn btn-warning btn-sm"
                       href="index.php?c=Eventos&f=editar&id=<?= $e['id_evento'] ?>">
                        Editar
                    </a>

                    <a class="btn btn-danger btn-sm"
                       href="index.php?c=Eventos&f=eliminar&id=<?= $e['id_evento'] ?>"
                       onclick="return confirm('¿Eliminar este evento?')">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once FOOTER; ?>
