<?php require_once HEADER; ?>
<!--Aragundi Fernandez-->
<h2>Listado de Clientes</h2>

<a href="index.php?c=Cliente&f=crear">Nuevo Cliente</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Cédula</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['cedula'] ?></td>
            <td><?= $c['nombre'] ?></td>
            <td><?= $c['apellido'] ?></td>
            <td><?= $c['email'] ?></td>
            <td><?= $c['telefono'] ?></td>
            <td>
                <a href="index.php?c=Cliente&f=eliminar&id=<?= $c['id'] ?>">
                    Eliminar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php require_once FOOTER; ?>
