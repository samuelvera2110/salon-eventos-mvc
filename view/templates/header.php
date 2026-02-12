<?php
if (!isset($_SESSION))
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="/index.php">Eventix</a>
        <ul>
    <li><a href="index.php?c=Cliente&f=index">Clientes</a></li>
    <li><a href="index.php?c=Salones&f=index">Salones</a></li>
    <li><a href="index.php?c=Servicio&f=index">Servicios</a></li>
    <li><a href="">Reservas</a></li>
    <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 3): ?>
        <li><a href="index.php?p=facturas">Facturas</a></li>
    <?php endif; ?>
    <li><a href="index.php?c=login&f=logout">Cerrar sesión</a></li>
</ul>

    </nav>