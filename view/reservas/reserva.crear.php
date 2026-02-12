<!-- Autor: Samuel Vera -->
<?php require_once HEADER; ?>

<div class="container mt-5">
    <h1 class="mb-4">Crear Nueva Reserva</h1>
    <a href="index.php?c=reserva&f=index" class="btn btn-secondary mb-3">Volver a la lista</a>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form action="index.php?c=reserva&f=guardar" method="post" class="row g-3">
        <div class="col-md-6">
            <label for="fecha_inicio" class="form-label">Fecha y Hora de Inicio:</label>
            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="fecha_fin" class="form-label">Fecha y Hora de Fin:</label>
            <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="id_cliente" class="form-label">Cliente:</label>
            <select id="id_cliente" name="id_cliente" class="form-select" required>
                <option value="">Selecciona un cliente</option>
                <?php if ($clientes && is_array($clientes)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo htmlspecialchars($cliente['id']); ?>">
                            <?php echo htmlspecialchars($cliente['nombre'] . ' ' . ($cliente['apellido'] ?? '')); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>No hay clientes disponibles</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="id_salon" class="form-label">Salón:</label>
            <select id="id_salon" name="id_salon" class="form-select" required>
                <option value="">Selecciona un salón</option>
                <?php if ($salones && is_array($salones)): ?>
                    <?php foreach ($salones as $salon): ?>
                        <option value="<?php echo htmlspecialchars($salon->getId()); ?>">
                            <?php echo htmlspecialchars($salon->getNombre() . ' - ' . $salon->getUbicacion()); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>No hay salones disponibles</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="precio_pactado" class="form-label">Precio Pactado:</label>
            <input type="number" step="0.01" id="precio_pactado" name="precio_pactado" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="estado" class="form-label">Estado:</label>
            <select id="estado" name="estado" class="form-select">
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        <div class="col-12">
            <label for="notas" class="form-label">Notas:</label>
            <textarea id="notas" name="notas" class="form-control" rows="4"></textarea>
        </div>

        <div class="col-12">
            <h5>Servicios Adicionales</h5>
            <p>Selecciona los servicios que deseas agregar marcando la casilla y ajustando la cantidad.</p>
            <?php if (isset($servicios) && is_array($servicios)): ?>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Seleccionar</th>
                            <th>Servicio</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicios as $servicio): ?>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="servicios[]" value="<?php echo htmlspecialchars($servicio['id_servicio']); ?>" id="servicio_<?php echo $servicio['id_servicio']; ?>">
                                </td>
                                <td><?php echo htmlspecialchars($servicio['nombre_servicio']); ?></td>
                                <td>$<?php echo htmlspecialchars($servicio['precio']); ?></td>
                                <td>
                                    <input type="number" name="cantidad_<?php echo $servicio['id_servicio']; ?>" class="form-control" style="width: 80px;" min="1" value="1">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay servicios disponibles.</p>
            <?php endif; ?>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Crear Reserva</button>
        </div>
    </form>
</div>

<?php require_once FOOTER; ?>