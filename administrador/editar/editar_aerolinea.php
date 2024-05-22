<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Aerolínea</title>
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
    <h2>Editar Aerolínea</h2>
    <?php
    if (isset($_GET['id'])) {
        $aerolinea_id = $_GET['id'];
        include '../../conexion.php';

        $sql = "SELECT * FROM aerolinea WHERE id = $aerolinea_id";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="actualizar/actualizar_aerolinea.php" method="POST">
        <input type="hidden" name="aerolinea_id" value="<?php echo $aerolinea_id; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="pais_origen" class="form-label">País de Origen</label>
            <input type="text" class="form-control" id="pais_origen" name="pais_origen" value="<?php echo $row['pais_origen']; ?>">
        </div>
        <div class="mb-3">
            <label for="contacto" class="form-label">Contacto</label>
            <input type="text" class="form-control" id="contacto" name="contacto" value="<?php echo $row['contacto']; ?>">
        </div>
        <button type="submit" class="btn btn-primary"> Actualizar Aerolínea</button>
        <a href="../aerolineas.php" class="btn btn-secondary">Volver</a>
    </form>
    <?php
        } else {
            echo "No se encontró la aerolínea.";
        }
        $conexion->close();
    } else {
        echo "ID de aerolínea no especificado.";
    }
    ?>
</div>

</body>
</html>
