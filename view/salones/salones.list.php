<!-- autor: Bryan López -->
<?php require_once HEADER; ?>

<main class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Nuestros Salones</h2>
        
        <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1): ?>
            <a href="index.php?c=salones&f=view_admin" class="btn btn-primary fw-bold">
                Gestionar Salones
            </a>
        <?php endif; ?>
    </div>

    <!-- Formulario de búsqueda -->
    <div class="mb-4">
        <form onsubmit="event.preventDefault()" class="input-group">
            <input type="text" id="busqueda" name="b" class="form-control" 
                   placeholder="🔍 Buscar salón por nombre o ubicación...">
        </form>
    </div>

    <!-- Contenedor de salones -->
    <div class="row row-cols-1 row-cols-md-2 g-4" id="contenedor-salones">
        <?php if (!empty($resultados)): ?>
            <?php foreach ($resultados as $salon): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="assets/img/salones/<?php echo htmlspecialchars($salon->getImagen()); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($salon->getNombre()); ?>" 
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary"><?php echo htmlspecialchars($salon->getNombre()); ?></h5>
                            <p class="text-warning fw-bold mb-2"><?php echo $salon->getMedidaMetros(); ?> m²</p>

                            <ul class="list-unstyled text-secondary small mb-3">
                                <li><strong>Ubicación:</strong> <?php echo htmlspecialchars($salon->getUbicacion()); ?></li>
                                <li><strong>Capacidad:</strong> <?php echo $salon->getCapacidad(); ?> personas</li>
                                <li><strong>Precio:</strong> $<?php echo number_format($salon->getPrecioHora(), 2); ?> / hora</li>
                            </ul>

                            <p class="text-muted fst-italic small mb-3">
                                <?php echo htmlspecialchars($salon->getDescripcion()); ?>
                            </p>

                            <button class="btn btn-dark mt-auto w-100">COTIZAR</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center text-muted">
                No se encontraron salones.
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
    // Búsqueda en tiempo real
    const inputBusqueda = document.getElementById('busqueda');
    const contenedor = document.getElementById('contenedor-salones');

    inputBusqueda.addEventListener('keyup', function() {
        const texto = inputBusqueda.value;

        fetch('index.php?c=salones&f=buscar&texto=' + encodeURIComponent(texto))
            .then(response => response.text())
            .then(html => {
                contenedor.innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
    });
</script>

<?php require_once FOOTER; ?>
