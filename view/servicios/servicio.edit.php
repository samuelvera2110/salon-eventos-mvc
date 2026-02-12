<?php require_once HEADER; ?>
<!--Jeremy Guncay-->
<div class="container mt-5">
    <h2 class="mb-4">Editar Servicio</h2>

    <form method="POST" action="index.php?c=Servicio&f=actualizar">

        <input type="hidden" name="id_servicio" value="<?= $servicio['id_servicio'] ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Servicio</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                   value="<?= $servicio['nombre_servicio'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"><?= $servicio['descripcion'] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" step="0.01"
                   id="precio" name="precio"
                   value="<?= $servicio['precio'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado">
                <option value="1" <?= $servicio['estado']==1?'selected':'' ?>>Activo</option>
                <option value="0" <?= $servicio['estado']==0?'selected':'' ?>>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php require_once FOOTER; ?>
