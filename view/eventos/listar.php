<!--autor: Joel Gortaire-->
<h2 class="titulo-modulo">Listado de Eventos</h2>

<div style="text-align:center;">
    <a href="index.php?c=Eventos&f=crear" class="btn-nuevo">+ Nuevo Evento</a>
</div>

<table class="tabla-eventos">
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

    <?php foreach ($eventos as $e): ?>
    <tr>
        <td><?= $e['id_evento'] ?></td>
        <td><?= htmlspecialchars($e['nombre_evento']) ?></td>
        <td><?= $e['tipo_evento'] ?></td>
        <td><?= $e['fecha_evento'] ?></td>
        <td><?= $e['hora_evento'] ?></td>
        <td><?= htmlspecialchars($e['cliente']) ?></td>
        <td><?= $e['nombre_salon'] ?></td>
        <td><?= $e['asistentes'] ?></td>
        <td class="acciones">
            <a class="editar" href="index.php?c=Eventos&f=editar&id=<?= $e['id_evento'] ?>">Editar</a>
            |
            <a class="eliminar"
               href="index.php?c=Eventos&f=eliminar&id=<?= $e['id_evento'] ?>"
               onclick="return confirm('¿Eliminar este evento?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
