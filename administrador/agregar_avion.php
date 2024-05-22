<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Avión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body style="background-image: url('../imagen/fondo18.jpg'); background-size: cover;">

<div class="container">
    <h2>Agregar Avión</h2>
    <form action="crear/crear_avion.php" method="POST">
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required>
        </div>
        <div class="mb-3">
            <label for="aerolinea_id" class="form-label">ID de Aerolínea</label>
            <select class="form-select" id="aerolinea_id" name="aerolinea_id" required>
                <?php
                include '../conexion.php';

                $sql_aerolineas = "SELECT id, nombre FROM aerolinea";
                $result_aerolineas = $conexion->query($sql_aerolineas);

                if ($result_aerolineas->num_rows > 0) {
                    while($row = $result_aerolineas->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay aerolíneas disponibles</option>";
                }

                $conexion->close();
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="capacidad_pasajeros" class="form-label">Capacidad de Pasajeros</label>
            <input type="number" class="form-control" id="capacidad_pasajeros" name="capacidad_pasajeros" required>
        </div>
        <div class="mb-3">
            <label for="ano_fabricacion" class="form-label">Año de Fabricación</label>
            <input type="number" class="form-control" id="ano_fabricacion" name="ano_fabricacion" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Avión</button>
        <a href="aviones.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

</body>
</html>
