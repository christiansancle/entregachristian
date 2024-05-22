<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
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
            max-width: 600px;
            text-align: center;
        }
    </style>
</head>
<body style="background-image: url('../../imagen/fondo8.jpeg'); background-size: cover;">
    <div class="container">
        <h2>Editar Usuario</h2>
        <?php
        include '../../conexion.php';

        if(isset($_GET['id']) && !empty(trim($_GET['id']))) {
            $id = trim($_GET['id']);
            
            $sql = "SELECT * FROM usuario WHERE id = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $param_id);
                $param_id = $id;
                
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        ?>
                        <form action="actualizar/actualizar_usuario.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="apellido">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($row['apellido']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="correo">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($row['correo_electronico']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($row['telefono']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($row['fecha_nacimiento']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nacionalidad">Nacionalidad:</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?php echo htmlspecialchars($row['nacionalidad']); ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="../usuarios.php" class="btn btn-secondary">Volver</a>
                        </form>
                      
                        <?php
                    } else {
                        echo "No se encontró un usuario con ese ID.";
                    }
                } else {
                    echo "Oops! Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
                }

                $stmt->close();
            }
            
            $conexion->close();
        } else {
            echo "ID de usuario no especificado.";
        }
        ?>
    </div>
</body>
</html>
