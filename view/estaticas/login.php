<!-- autor: Samuel Vera -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eventix</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #181818, #181818);
            height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 15px;
        }

        .login-card .card-body {
            padding: 40px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-custom {
            border-radius: 10px;
            font-weight: 600;
        }

        .logo-title {
            font-weight: bold;
            color: rgb(0, 0, 0);
        }
    </style>
</head>

<body class="login-bg d-flex align-items-center justify-content-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <div class="card shadow-lg login-card">
                    <div class="card-body">

                        <h3 class="text-center mb-4 logo-title">
                            🎉 Eventix
                        </h3>

                        <form method="POST" action="index.php?c=login&f=validar">

                            <div class="mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="usuario" class="form-control" placeholder="Ingrese su usuario" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="clave" class="form-control" placeholder="Ingrese su contraseña" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-custom">
                                    Ingresar
                                </button>
                            </div>

                        </form>

                        <?php if (isset($_SESSION['mensaje'])): ?>
                            <div class="alert alert-danger mt-3 text-center">
                                <?= htmlspecialchars($_SESSION['mensaje']) ?>
                            </div>
                            <?php unset($_SESSION['mensaje']); ?>
                        <?php endif; ?>

                    </div>
                </div>

                <p class="text-center text-white mt-3">
                    © <?= date("Y") ?> Eventix - Sistema de Gestión
                </p>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
