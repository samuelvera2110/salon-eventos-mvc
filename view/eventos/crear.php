<?php require_once HEADER; ?>

<div class="container mt-5">
    <h2 class="mb-4">Registrar Evento</h2>

    <form method="post" action="index.php?c=Eventos&f=guardar" id="formEvento">

        <div class="mb-3">
            <label class="form-label">Nombre del evento</label>
            <input type="text" class="form-control" name="nombre_evento" id="nombre_evento">
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de evento</label>
            <select class="form-select" name="tipo_evento" id="tipo_evento">
                <option value="">Seleccione</option>
                <option>Fiesta Ejecutiva</option>
                <option>Matrimonio</option>
                <option>Quinceañera</option>
                <option>Bautizo</option>
                <option>Cumpleaños</option>
                <option>Despedida de soltero</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha_evento" id="fecha_evento">
        </div>

        <div class="mb-3">
            <label class="form-label">Hora</label>
            <input type="time" class="form-control" name="hora_evento" id="hora_evento">
        </div>

        <div class="col-md-6">
    <label for="id_cliente" class="form-label">Cliente:</label>
    <select id="id_cliente" name="id_cliente" class="form-select" required>
        <option value="">Selecciona un cliente</option>
        <?php if ($clientes && is_array($clientes)): ?>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['nombre']; ?>">
                    <?php echo htmlspecialchars($cliente['nombre']); ?>
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
                    <?php echo htmlspecialchars($salon->getNombre()); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option disabled>No hay salones disponibles</option>
        <?php endif; ?>
    </select>
</div>

        <div class="mb-3">
            <label class="form-label">Asistentes</label>
            <input type="number" class="form-control" name="asistentes" id="asistentes">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Evento</button>
        <a href="index.php?c=Eventos" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<?php require_once FOOTER; ?>
