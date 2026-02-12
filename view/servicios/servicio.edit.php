<?php require_once HEADER; ?>
<!-- Autor: Jeremy Guncay-->
<h2>Editar Servicio</h2>

<form method="POST" action="index.php?c=Servicio&f=actualizar">

    <input type="hidden" name="id_servicio" value="<?= $servicio['id_servicio'] ?>">

    <input type="text" name="nombre"
           value="<?= $servicio['nombre_servicio'] ?>" required>

    <textarea name="descripcion">
        <?= $servicio['descripcion'] ?>
    </textarea>

    <input type="number" step="0.01"
           name="precio"
           value="<?= $servicio['precio'] ?>" required>

    <select name="estado">
        <option value="1" <?= $servicio['estado']==1?'selected':'' ?>>Activo</option>
        <option value="0" <?= $servicio['estado']==0?'selected':'' ?>>Inactivo</option>
    </select>

    <button type="submit">Actualizar</button>
</form>

<?php require_once FOOTER; ?>
