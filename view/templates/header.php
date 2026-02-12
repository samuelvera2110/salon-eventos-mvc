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
    <div class="container d-flex justify-content-between align-items-center">
      <a class="navbar-brand" href="index.php">Eventix</a>

      <?php
      $rol = $_SESSION['rol_id'] ?? 0;
      $roles = [
          1 => "Administrador",
          2 => "Usuario",
          3 => "Contador"
      ];
      $rolNombre = $roles[$rol] ?? "Invitado";
      ?>

      <!-- Contenedor central para los links -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex justify-content-center">
        <?php if ($rol == 1): ?> <!-- ADMIN -->
          <li class="nav-item"><a class="nav-link" href="index.php?c=Cliente&f=index">Clientes</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?c=Salones&f=index">Salones</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?c=Servicio&f=index">Servicios</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?c=Reserva&f=index">Reservas</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?c=Eventos&f=index">Eventos</a></li>
        <?php endif; ?>

        <?php if ($rol == 3): ?> <!-- CONTADOR -->
          <li class="nav-item"><a class="nav-link" href="index.php?c=Eventos&f=index">Eventos</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?c=Reserva&f=index">Reservas</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?c=Salones&f=index">Salones</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?c=Servicio&f=index">Servicios</a></li>
        <?php endif; ?>

        <?php if ($rol == 2): ?> <!-- USUARIO -->
          <li class="nav-item"><a class="nav-link" href="index.php?c=Cliente&f=index">Clientes</a></li>
        <?php endif; ?>
      </ul>

      <div class="d-flex align-items-center">
        <span class="text-white me-2"><?php echo $rolNombre; ?></span>
        <a class="btn btn-danger" href="index.php?c=login&f=logout">Cerrar sesión</a>
      </div>
    </div>
  </nav>
</body>
</html>
