<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Vuelo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-image: url('../imagen/fondo20.jpeg'); background-size: cover;">

<div class="container">
    <h2>Agregar Vuelo</h2>
    <form action="crear/crear_vuelo.php" method="POST">
        <div class="mb-3">
            <label for="numero_vuelo" class="form-label">Número de Vuelo</label>
            <input type="text" class="form-control" id="numero_vuelo" name="numero_vuelo" required>
        </div>
        <div class="mb-3">
            <label for="aerolinea_id" class="form-label">ID de Aerolínea</label>
            <select class="form-select" id="aerolinea_id" name="aerolinea_id" onchange="cargarDatos()" required>
                <?php
                include '../conexion.php';
                $sql = "SELECT id, nombre FROM aerolinea";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                    }
                }
                $conexion->close();
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="avion_id" class="form-label">ID de Avión</label>
            <select class="form-select" id="avion_id" name="avion_id" required>
                <!-- Los aviones se cargarán dinámicamente mediante JavaScript -->
            </select>
        </div>
        <div class="mb-3">
            <label for="piloto_id" class="form-label">ID de Piloto</label>
            <select class="form-select" id="piloto_id" name="piloto_id" required>
                <!-- Los pilotos se cargarán dinámicamente mediante JavaScript -->
            </select>
        </div>
        <div class="mb-3">
            <label for="origen" class="form-label">Origen</label>
            <input type="text" class="form-control" id="origen" name="origen" required>
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" class="form-control" id="destino" name="destino" required>
        </div>
        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora de Salida</label>
            <input type="datetime-local" class="form-control" id="hora_salida" name="hora_salida" required>
        </div>
        <div class="mb-3">
            <label for="hora_llegada" class="form-label">Hora de Llegada</label>
            <input type="datetime-local" class="form-control" id="hora_llegada" name="hora_llegada" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Vuelo</button>
        <a href="vuelos.php" class="btn btn-secondary">Volver</a>

    </form>
</div>

<script>
function cargarDatos() {
    var aerolinea_id = document.getElementById("aerolinea_id").value;
    cargarPilotos(aerolinea_id);
    cargarAviones(aerolinea_id);
}

function cargarPilotos(aerolinea_id) {
    $.ajax({
        url: 'obtener_pilotos.php',
        type: 'GET',
        data: {aerolinea_id: aerolinea_id},
        success: function(response) {
            var pilotos = JSON.parse(response);
            var pilotoSelect = document.getElementById("piloto_id");
            pilotoSelect.innerHTML = "";
            pilotos.forEach(function(piloto) {
                var option = document.createElement("option");
                option.value = piloto.id;
                option.text = piloto.nombre_completo;
                pilotoSelect.add(option);
            });
        },
        error: function() {
            alert("Error al cargar pilotos.");
        }
    });
}

function cargarAviones(aerolinea_id) {
    $.ajax({
        url: 'obtener_aviones.php',
        type: 'GET',
        data: {aerolinea_id: aerolinea_id},
        success: function(response) {
            var aviones = JSON.parse(response);
            var avionSelect = document.getElementById("avion_id");
            avionSelect.innerHTML = "";
            aviones.forEach(function(avion) {
                var option = document.createElement("option");
                option.value = avion.id;
                option.text = avion.modelo;
                avionSelect.add(option);
            });
        },
        error: function() {
            alert("Error al cargar aviones.");
        }
    });
}
</script>

</body>
</html>
