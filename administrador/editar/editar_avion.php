<?php
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    include '../../conexion.php';
    
    $id = trim($_GET['id']);
    
    $sql = "SELECT * FROM avion WHERE id = ?";
    
    if($stmt = $conexion->prepare($sql)){
        $stmt->bind_param("i", $param_id);
        
        $param_id = $id;
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                $modelo = $row['modelo'];
                $aerolinea_id = $row['aerolinea_id'];
                $capacidad_pasajeros = $row['capacidad_pasajeros'];
                $ano_fabricacion = $row['ano_fabricacion'];
            } else{
                header("location: error.php");
                exit();
            }
        } else{
            echo "Oops! Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
        }
        
        $stmt->close();
    } else {
        echo "Oops! Algo salió mal en la preparación de la consulta.";
    }
    
    // Obtener lista de aerolíneas
    $sql_aerolineas = "SELECT id, nombre FROM aerolinea";
    $result_aerolineas = $conexion->query($sql_aerolineas);
    $aerolineas = [];
    
    if($result_aerolineas->num_rows > 0){
        while($row = $result_aerolineas->fetch_assoc()){
            $aerolineas[] = $row;
        }
    } else {
        echo "No se encontraron aerolíneas.";
    }
    
    $conexion->close();
} else{
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Avión</title>
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
<body style="background-image: url('../../imagen/fondo14.jpeg'); background-size: cover;">

<div class="container">
    <h2>Editar Avión</h2>
    <form action="actualizar/actualizar_avion.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required>
        </div>
        <div class="mb-3">
            <label for="aerolinea_id" class="form-label">Aerolínea</label>
            <select class="form-control" id="aerolinea_id" name="aerolinea_id" required>
                <?php foreach($aerolineas as $aerolinea): ?>
                    <option value="<?php echo $aerolinea['id']; ?>" <?php echo ($aerolinea['id'] == $aerolinea_id) ? 'selected' : ''; ?>>
                        <?php echo $aerolinea['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="capacidad_pasajeros" class="form-label">Capacidad de Pasajeros</label>
            <input type="number" class="form-control" id="capacidad_pasajeros" name="capacidad_pasajeros" value="<?php echo $capacidad_pasajeros; ?>" required>
        </div>
        <div class="mb-3">
            <label for="ano_fabricacion" class="form-label">Año de Fabricación</label>
            <input type="number" class="form-control" id="ano_fabricacion" name="ano_fabricacion" value="<?php echo $ano_fabricacion; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Avión</button>
        <a href="../aviones.php" class="btn btn-secondary">Volver</a>

    </form>
</div>

</body>
</html>
