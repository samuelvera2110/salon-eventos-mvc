<?php require_once HEADER; ?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Evento</h2>

    <form method="post" action="index.php?c=Eventos&f=actualizar">

        <input type="hidden" name="id_evento" value="<?= $evento['id_evento'] ?>">

        <div class="mb-3">
            <label class="form-label">Nombre del evento</label>
            <input type="text" class="form-control" name="nombre_evento"
                value="<?= htmlspecialchars($evento['nombre_evento']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select class="form-select" name="tipo_evento" required>
                <?php
                $tipos = ["Fiesta Ejecutiva","Matrimonio","Quinceañera","Bautizo","Cumpleaños","Despedida de soltero"];
                foreach ($tipos as $t):
                ?>
                    <option value="<?= $t ?>" <?= ($evento['tipo_evento'] == $t) ? 'selected' : '' ?>>
                        <?= $t ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha_evento"
                value="<?= $evento['fecha_evento'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hora</label>
            <input type="time" class="form-control" name="hora_evento"
                value="<?= $evento['hora_evento'] ?>" required>
        </div>

        <!-- CLIENTE DINÁMICO -->
        <div class="mb-3">
    <label for="cliente" class="form-label">Cliente</label>
    <select id="cliente" name="cliente" class="form-select" required>
        <option value="">Selecciona un cliente</option>

        <?php if ($clientes && is_array($clientes)): ?>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['nombre']; ?>"
                    <?= ($evento['cliente'] == $c['nombre']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['nombre']); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option disabled>No hay clientes disponibles</option>
        <?php endif; ?>
    </select>
</div>


        <!-- SALÓN DINÁMICO -->
        <div class="mb-3">
            <label for="id_salon" class="form-label">Salón</label>
            <select id="id_salon" name="id_salon" class="form-select" required>
                <option value="">Selecciona un salón</option>

                <?php if ($salones && is_array($salones)): ?>
                    <?php foreach ($salones as $salon): ?>
                        <option value="<?= $salon->getId(); ?>"
                            <?= ($evento['id_salon'] == $salon->getId()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($salon->getNombre()); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>No hay salones disponibles</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Asistentes</label>
            <input type="number" class="form-control" name="asistentes"
                value="<?= $evento['asistentes'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="index.php?c=Eventos" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<?php require_once FOOTER; ?>
