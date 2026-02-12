<?php require_once HEADER; ?>
<!--Jeremy Guncay-->
<div class="container mt-5">
    <h2 class="mb-4">Nuevo Servicio</h2>

    <form method="POST" action="index.php?c=Servicio&f=guardar">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Servicio</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del servicio" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" step="0.01" id="precio" name="precio" placeholder="Precio" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<?php require_once FOOTER; ?>
