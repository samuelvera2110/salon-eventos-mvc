<!-- autor: Bryan López -->
<?php require_once HEADER; ?>

<main class="container">
    <h2>Editar Salón</h2>
    
    <form action="index.php?c=salones&f=update" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo $salon->getId(); ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" class="form-control" required value="<?php echo htmlspecialchars($salon->getNombre()); ?>">

        <label>Ubicación:</label>
        <input type="text" name="ubicacion" class="form-control" required value="<?php echo htmlspecialchars($salon->getUbicacion()); ?>">

        <label>Medida (m²):</label>
        <input type="number" step="0.01" name="medida_metros" class="form-control" required value="<?php echo $salon->getMedidaMetros(); ?>">

        <label>Capacidad:</label>
        <input type="number" name="capacidad" class="form-control" required value="<?php echo $salon->getCapacidad(); ?>">

        <label>Precio/Hora ($):</label>
        <input type="number" step="0.01" name="precio_hora" class="form-control" required value="<?php echo $salon->getPrecioHora(); ?>">

        <label>Descripción:</label>
        <textarea name="descripcion" rows="4" class="form-control"><?php echo htmlspecialchars($salon->getDescripcion()); ?></textarea>

        <div style="margin: 15px 0;">
            <p>Imagen Actual:</p>
            <img id="imagenPrevia" src="assets/img/salones/<?php echo $salon->getImagen(); ?>" style="width: 150px; height: 100px; object-fit: cover; border: 1px solid #ddd;">
        </div>

        <label>Cambiar Imagen (Dejar vacío para mantener la actual):</label>
        <input type="file" name="imagen" id="inputImagen" accept="image/*" class="form-control">

        <br><br>
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none;">Actualizar</button>
        <a href="index.php?c=salones&f=view_admin" style="margin-left: 10px;">Cancelar</a>
    </form>

    <script>
        // Script con objetivo de mostrar una vista previa de la nueva imagen seleccionada
        const input = document.getElementById('inputImagen');
        const imagen = document.getElementById('imagenPrevia');

        if (input) {
            input.addEventListener('change', function(evento) {
                const archivo = evento.target.files[0];

                if (archivo) {
                    const nuevaURL = URL.createObjectURL(archivo);
                    imagen.src = nuevaURL;
                }
            });
        }
    </script>
</main>

<?php require_once FOOTER; ?>