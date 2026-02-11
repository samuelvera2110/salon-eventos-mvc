<?php require_once HEADER; ?>
<!--Aragundi Fernandez-->
<h2>Nuevo Cliente</h2>

<form action="index.php?c=Cliente&f=guardar" method="POST">
    Cédula: <input type="text" name="cedula" required><br>
    Nombre: <input type="text" name="nombre" required><br>
    Apellido: <input type="text" name="apellido" required><br>
    Email: <input type="email" name="email" required><br>
    Teléfono: <input type="text" name="telefono"><br>
    <button type="submit">Guardar</button>
</form>

<?php require_once FOOTER; ?>
