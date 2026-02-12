<!--autor: Joel Gortaire-->
<h2 class="eventos-modulo">Registrar Evento</h2>

<form method="post" action="index.php?c=Eventos&f=guardar"
      id="formEvento" class="form-eventos">


    <div>
        <label>Nombre del evento</label><br>
        <input type="text" name="nombre_evento" id="nombre_evento">
    </div>

    <div>
        <label>Tipo de evento</label><br>
        <select name="tipo_evento" id="tipo_evento">
            <option value="">Seleccione</option>
            <option>Fiesta Ejecutiva</option>
            <option>Matrimonio</option>
            <option>Quinceañera</option>
            <option>Bautizo</option>
            <option>Cumpleaños</option>
            <option>Despedida de soltero</option>
        </select>
    </div>

    <div>
        <label>Fecha</label><br>
        <input type="date" name="fecha_evento" id="fecha_evento">
    </div>

    <div>
        <label>Hora</label><br>
        <input type="time" name="hora_evento" id="hora_evento">
    </div>

    <div>
        <label>Cliente</label><br>
        <input type="text" name="cliente" id="cliente">
    </div>

    <div>
        <label>Salón</label><br>
        <select name="salon" id="salon">
            <option value="">Seleccione</option>
            <option value="1">Sala A</option>
            <option value="2">Sala B</option>
            <option value="3">Salón Principal</option>
        </select>
    </div>

    <div>
        <label>Asistentes</label><br>
        <input type="number" name="asistentes" id="asistentes">
    </div>

    <br>
    <button type="submit">Guardar Evento</button>
</form>

<script>
document.getElementById("formEvento").addEventListener("submit", function(e) {

    // eliminar mensajes anteriores
    document.querySelectorAll(".error").forEach(el => el.remove());

    let valido = true;

    function mostrarError(elemento, mensaje) {
        let span = document.createElement("span");
        span.className = "error";
        span.style.color = "red";
        span.style.marginLeft = "10px";
        span.textContent = mensaje;
        elemento.parentNode.appendChild(span);
    }

    let nombre = document.getElementById("nombre_evento");
    let tipo = document.getElementById("tipo_evento");
    let fecha = document.getElementById("fecha_evento");
    let hora = document.getElementById("hora_evento");
    let cliente = document.getElementById("cliente");
    let salon = document.getElementById("salon");
    let asistentes = document.getElementById("asistentes");

    // 1️⃣ Nombre del evento
    if (nombre.value.trim() === "") {
        mostrarError(nombre, "El nombre es obligatorio");
        valido = false;
    } else if (nombre.value.length < 5) {
        mostrarError(nombre, "Mínimo 5 caracteres");
        valido = false;
    }

    // 2️⃣ Tipo de evento
    if (tipo.value === "") {
        mostrarError(tipo, "Seleccione un tipo de evento");
        valido = false;
    }

    // 3️⃣ Fecha
    if (fecha.value === "") {
        mostrarError(fecha, "La fecha es obligatoria");
        valido = false;
    }

    // 4️⃣ Hora
    if (hora.value === "") {
        mostrarError(hora, "La hora es obligatoria");
        valido = false;
    }

    // 5️⃣ Cliente
    if (cliente.value.trim() === "") {
        mostrarError(cliente, "El nombre del cliente es obligatorio");
        valido = false;
    } else if (!/^[a-zA-Z\s]+$/.test(cliente.value)) {
        mostrarError(cliente, "Solo letras y espacios");
        valido = false;
    }

    // 6️⃣ Salón
    if (salon.value === "") {
        mostrarError(salon, "Seleccione un salón");
        valido = false;
    }

    // 7️⃣ Asistentes
    if (asistentes.value === "" || asistentes.value <= 0) {
        mostrarError(asistentes, "Ingrese una cantidad válida");
        valido = false;
    }

    if (!valido) {
        e.preventDefault(); // bloquea el envío
    }
});
</script>
