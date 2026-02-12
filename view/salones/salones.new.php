<!-- autor: Bryan López -->
 <?php require_once HEADER; ?>

<main class="container">
    <h2>Registrar Nuevo Salón</h2>
    
    <form action="index.php?c=salones&f=create" method="POST" enctype="multipart/form-data">
        
        <label>Nombre del Salón:</label>
        <input type="text" name="nombre" required class="form-control">

        <label>Ubicación:</label>
        <input type="text" name="ubicacion" required class="form-control">

        <label>Medida (m²):</label>
        <input type="number" step="0.01" name="medida_metros" required class="form-control">

        <label>Capacidad (personas):</label>
        <input type="number" name="capacidad" required class="form-control">

        <label>Precio por Hora ($):</label>
        <input type="number" step="0.01" name="precio_hora" required class="form-control">

        <label>Foto del Salón:</label>
        <input type="file" name="imagen" accept="image/*" class="form-control">

        <label>Descripción:</label>
        <textarea name="descripcion" rows="4" class="form-control"></textarea>

        <br>
        <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none;">Guardar Salón</button>
        <a href="index.php?c=salones&f=index">Cancelar</a>
    </form>
</main>

<?php require_once FOOTER; ?>