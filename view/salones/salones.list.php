<!-- autor: Bryan López -->
 <?php require_once HEADER; ?>

<main class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Nuestros Salones</h2>
        <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1): ?>
            <a href="index.php?c=salones&f=view_admin" style="background: #007bff; color: white; padding: 10px; border-radius: 5px; text-decoration: none;">
                Gestionar Salones
            </a>
        <?php endif; ?>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
        <?php foreach ($resultados as $salon): ?>
            <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <img src="assets/img/salon_default.jpg" alt="Salón" style="width: 100%; height: 200px; object-fit: cover;">
                
                <div style="padding: 15px; background: #fff;">
                    <h3 style="color: #1a3a5a; margin: 0;"><?php echo htmlspecialchars($salon->getNombre()); ?></h3>
                    <p style="font-weight: bold; color: #0e0d0a;"><?php echo $salon->getMedidaMetros(); ?> m²</p>
                    
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
    </div>
</main>

<?php require_once FOOTER; ?>