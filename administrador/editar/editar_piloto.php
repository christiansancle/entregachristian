<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Piloto</title>
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
<body style="background-image: url('../../imagen/fondo11.jpg'); background-size: cover;">

<div class="container">
    <h2>Editar Piloto</h2>
    <?php
    if (isset($_GET['id'])) {
        $piloto_id = $_GET['id'];

        include '../../conexion.php';

        $sql = "SELECT * FROM piloto WHERE id = $piloto_id";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="actualizar/actualizar_piloto.php" method="POST">
        <input type="hidden" name="piloto_id" value="<?php echo $piloto_id; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="aerolinea_id" class="form-label">Aerolínea</label>
            <select class="form-select" id="aerolinea_id" name="aerolinea_id" required>
                <?php
                $sql_aerolineas = "SELECT id, nombre FROM aerolinea";
                $result_aerolineas = $conexion->query($sql_aerolineas);

                if ($result_aerolineas->num_rows > 0) {
                    while($row_aerolineas = $result_aerolineas->fetch_assoc()) {
                        $selected = ($row_aerolineas['id'] == $row['aerolinea_id']) ? 'selected' : '';
                        echo "<option value='" . $row_aerolineas['id'] . "' $selected>" . $row_aerolineas['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Piloto</button>
        <a href="../pilotos.php" class="btn btn-secondary">Volver</a>
    </form>
    <?php
        } else {
            echo "No se encontró el piloto.";
        }
        $conexion->close();
    } else {
        echo "ID de piloto no especificado.";
    }
    ?>
</div>

</body>
</html>
