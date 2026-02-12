<!-- autor: Bryan López -->
<?php require_once HEADER; ?>

<main class="container">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Nuestros Salones</h2>
        
        <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1): ?>
            <a href="index.php?c=salones&f=view_admin" style="background: #007bff; color: white; padding: 10px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Gestionar Salones
            </a>
        <?php endif; ?>
    </div>

    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #ddd;">
        <form onsubmit="event.preventDefault()" style="display: flex; gap: 10px;">
            <input type="text" id="busqueda" name="b" placeholder="🔍 Buscar salón por nombre o ubicación..." 
                   style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">

        </form>
    </div>

    <div id="contenedor-salones" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(500px, 1fr)); gap: 20px;">
        <?php if (!empty($resultados)): ?>
            <?php foreach ($resultados as $salon): ?>
                <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    
                    <img src="assets/img/salones/<?php echo htmlspecialchars($salon->getImagen()); ?>" 
                         alt="<?php echo htmlspecialchars($salon->getNombre()); ?>" 
                         style="width: 100%; height: 200px; object-fit: cover; display: block;">
                    
                    <div style="padding: 15px; background: #fff;">
                        <h3 style="color: #1a3a5a; margin: 0;"><?php echo htmlspecialchars($salon->getNombre()); ?></h3>
                        <p style="font-weight: bold; color: #d4af37;"><?php echo $salon->getMedidaMetros(); ?> m²</p>
                        
                        <ul style="list-style: none; padding: 0; font-size: 0.9em; color: #555;">
                            <li><strong>Ubicación:</strong> <?php echo htmlspecialchars($salon->getUbicacion()); ?></li>
                            <li><strong>Capacidad:</strong> <?php echo $salon->getCapacidad(); ?> personas</li>
                            <li><strong>Precio:</strong> $<?php echo number_format($salon->getPrecioHora(), 2); ?> / hora</li>
                        </ul>
                        
                        <p style="font-style: italic; font-size: 0.85em; color: #777;">
                            <?php echo htmlspecialchars($salon->getDescripcion()); ?>
                        </p>
                        
                        <button style="width: 100%; padding: 10px; background: #1a3a5a; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            COTIZAR
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="grid-column: 1 / -1; text-align: center; color: #777;">No se encontraron salones.</p>
        <?php endif; ?>
    </div>
</main>

<script>

    // Funcionalidad de búsqueda en tiempo real
    // Cuando el usuario escribe, hacer una solicitud AJAX para obtener los resultados filtrados
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