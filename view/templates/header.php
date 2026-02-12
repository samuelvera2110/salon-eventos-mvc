<?php
if (!isset($_SESSION))
  session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Eventix</a>

      <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Cliente&f=index">Clientes</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Salones&f=index">Salones</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Servicio&f=index">Servicios</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?c=Reserva&f=index">Reservas</a>
          </li>

        </ul>
      </div>

      <a class="btn btn-danger" href="index.php?c=login&f=logout">
        Cerrar sesión
      </a>
    </div>
  </nav>

  </ul>

  </nav>