<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vuelo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1200px;
            text-align: center;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .btn-container {
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-image: url('../../imagen/fondo16.jpeg'); background-size: cover;">
<div class="container">
    <h2>Editar Vuelo</h2>
    <?php
    if(isset($_GET['id'])) {
        $vuelo_id = $_GET['id'];
        
        include '../../conexion.php';

        $sql = "SELECT * FROM vuelo WHERE id = $vuelo_id";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="actualizar/actualizar_vuelo.php" method="POST">
        <input type="hidden" name="vuelo_id" value="<?php echo $row['id']; ?>">
        <div class="mb-3">
            <label for="numero_vuelo" class="form-label">Número de Vuelo</label>
            <input type="text" class="form-control" id="numero_vuelo" name="numero_vuelo" value="<?php echo htmlspecialchars($row['numero_vuelo']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="aerolinea_id" class="form-label">Aerolínea</label>
            <select class="form-select" id="aerolinea_id" name="aerolinea_id" required onchange="cargarDatos()">
                <?php
                // Consulta SQL para obtener las opciones de ID de Aerolínea
                $sql_aerolinea = "SELECT id, nombre FROM aerolinea";
                $result_aerolinea = $conexion->query($sql_aerolinea);
                if ($result_aerolinea->num_rows > 0) {
                    while($row_aerolinea = $result_aerolinea->fetch_assoc()) {
                        $selected = ($row_aerolinea['id'] == $row['aerolinea_id']) ? "selected" : "";
                        echo "<option value='" . $row_aerolinea['id'] . "' $selected>" . $row_aerolinea['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="avion_id" class="form-label">Avión</label>
            <select class="form-select" id="avion_id" name="avion_id" required>
                <?php
                // Consulta SQL para obtener las opciones de ID de Avión
                $sql_avion = "SELECT id, modelo FROM avion";
                $result_avion = $conexion->query($sql_avion);
                if ($result_avion->num_rows > 0) {
                    while($row_avion = $result_avion->fetch_assoc()) {
                        $selected = ($row_avion['id'] == $row['avion_id']) ? "selected" : "";
                        echo "<option value='" . $row_avion['id'] . "' $selected>" . $row_avion['modelo'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="piloto_id" class="form-label">Piloto</label>
            <select class="form-select" id="piloto_id" name="piloto_id" required>
                <?php
                // Consulta SQL para obtener las opciones de ID de Piloto
                $sql_piloto = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM piloto";
                $result_piloto = $conexion->query($sql_piloto);
                if ($result_piloto->num_rows > 0) {
                    while($row_piloto = $result_piloto->fetch_assoc()) {
                        $selected = ($row_piloto['id'] == $row['piloto_id']) ? "selected" : "";
                        echo "<option value='" . $row_piloto['id'] . "' $selected>" . $row_piloto['nombre_completo'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora de Salida</label>
            <input type="datetime-local" class="form-control" id="hora_salida" name="hora_salida" value="<?php echo date('Y-m-d\TH:i', strtotime($row['hora_salida'])); ?>" required>
        </div>
        <div class="mb-3">
            <label for="hora_llegada" class="form-label">Hora de Llegada</label>
            <input type="datetime-local" class="form-control" id="hora_llegada" name="hora_llegada" value="<?php echo date('Y-m-d\TH:i', strtotime($row['hora_llegada'])); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Vuelo</button>
        <a href="../vuelos.php" class="btn btn-secondary">Volver</a>
    </form>
    <?php
        } else {
            echo "No se encontró el vuelo.";
        }
        $conexion->close();
    } else {
        echo "ID de vuelo no especificado.";
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function cargarDatos() {
    var aerolinea_id = document.getElementById("aerolinea_id").value;
    cargarPilotos(aerolinea_id);
    cargarAviones(aerolinea_id);
}

function cargarPilotos(aerolinea_id) {
    $.ajax({
        url: '../obtener_pilotos.php',
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
        url: '../obtener_aviones.php',
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

window.onload = function() {
    cargarDatos(); // Cargar datos iniciales al cargar la página
};
</script>

</body>
</html>
