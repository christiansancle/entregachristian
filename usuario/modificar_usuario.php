<?php
session_start();
include '../conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: ../inicio_sesion.html");
    exit();
}

// Obtener la información del usuario desde la base de datos
$email = $_SESSION['email'];
$query = "SELECT * FROM usuario WHERE correo_electronico='$email'";
$result = $conexion->query($query);

if ($result->num_rows == 1) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Error al obtener la información del usuario.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Información</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../assets/css/styles.css">



</head>
<body style="background-image: url('../imagen/fondo4.jpg'); background-size: cover;">
    <div class="container">
        <h2>Modificar Información</h2>
        <form action="procesar_modificacion.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $usuario['apellido']; ?>" required>
            </div>
            <div class="form-group">
                <label for="correo_electronico">Correo electrónico:</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo $usuario['correo_electronico']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $usuario['fecha_nacimiento']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?php echo $usuario['nacionalidad']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="usuario.php" class="btn btn-secondary">Volver</a>

        </form>
    </div>

</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
