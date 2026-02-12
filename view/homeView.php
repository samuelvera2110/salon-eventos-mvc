<?php require_once HEADER; ?>

<div class="container mt-5">

    <!-- HERO SECTION -->
    <div class="text-center p-5 mb-5 bg-light rounded shadow">
        <h1 class="display-4 fw-bold text-dark">Bienvenido a Eventix</h1>
        <p class="lead text-muted">
            Gestiona eventos, reservas, clientes y salones de manera profesional y eficiente.
        </p>
        <hr class="my-4">
        <p class="text-secondary">
            Sistema integral para administración de eventos con control de roles y gestión completa.
        </p>
    </div>

    <!-- TARJETAS PRINCIPALES -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestión de Clientes</h5>
                    <p class="card-text">
                        Administra información de clientes de manera organizada y segura.
                    </p>
                    <a href="index.php?c=Cliente&f=index" class="btn btn-dark">
                        Ir a Clientes
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Reservas y Eventos</h5>
                    <p class="card-text">
                        Control total sobre eventos programados y reservas activas.
                    </p>
                    <a href="index.php?c=Eventos&f=index" class="btn btn-dark">
                        Ver Eventos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Salones y Servicios</h5>
                    <p class="card-text">
                        Administra espacios y servicios disponibles para cada evento.
                    </p>
                    <a href="index.php?c=Salones&f=index" class="btn btn-dark">
                        Ver Salones
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- FOOTER INFO SECTION -->
    <div class="text-center mt-5 p-4">
        <h4 class="fw-light text-secondary">Sistema desarrollado con arquitectura MVC</h4>
        <p class="text-muted">Versión 1.0 | Panel de administración profesional</p>
    </div>

</div>

<?php require_once FOOTER; ?>
