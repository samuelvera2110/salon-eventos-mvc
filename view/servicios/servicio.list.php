<?php require_once HEADER; ?>

<h2>Servicios</h2>

<a href="index.php?c=Servicio&f=crear">Nuevo Servicio</a>

<table border="1">
<tr>
    <th>Servicio</th>
    <th>Precio</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>

<?php foreach ($servicios as $s): ?>
<tr>
    <td><?= $s['nombre_servicio'] ?></td>
    <td>$<?= $s['precio'] ?></td>
    <td><?= $s['estado'] ? 'Activo' : 'Inactivo' ?></td>
    <td>
        <a href="index.php?c=Servicio&f=editar&id=<?= $s['id_servicio'] ?>">Editar</a>
        <a href="index.php?c=Servicio&f=eliminar&id=<?= $s['id_servicio'] ?>"
           onclick="return confirm('¿Eliminar servicio?')">
           Eliminar
        </a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php require_once FOOTER; ?>
