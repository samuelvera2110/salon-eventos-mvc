<?php require_once HEADER; ?>

<h2>Nuevo Servicio</h2>

<form method="POST" action="index.php?c=Servicio&f=guardar">

    <input type="text" name="nombre" placeholder="Nombre del servicio" required>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>

    <select name="estado">
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>

    <button type="submit">Guardar</button>
</form>

<?php require_once FOOTER; ?>
