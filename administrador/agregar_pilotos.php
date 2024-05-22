<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Piloto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body style="background-image: url('../imagen/fondo19.jpg'); background-size: cover;">

<div class="container">
    <h2>Agregar Piloto</h2>
    <form action="crear/crear_piloto.php" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="aerolinea_id" class="form-label">Aerolínea</label>
            <select class="form-select" id="aerolinea_id" name="aerolinea_id" required>
                <?php
                include '../conexion.php';

                $sql = "SELECT id, nombre FROM aerolinea";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Piloto</button>
        <a href="pilotos.php" class="btn btn-secondary">Volver</a>

    </form>
</div>

</body>
</html>
