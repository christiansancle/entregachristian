<?php
session_start();
include '../conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: inicio_sesion.html");
    exit();
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo_electronico = $_POST['correo_electronico'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$nacionalidad = $_POST['nacionalidad'];

// Obtener el ID del usuario desde la sesión
$email = $_SESSION['email'];
$query = "SELECT id FROM usuario WHERE correo_electronico='$email'";
$result = $conexion->query($query);

if ($result->num_rows == 1) {
    $usuario = $result->fetch_assoc();
    $usuarioId = $usuario['id'];

    // Actualizar la información del usuario en la base de datos
    $updateQuery = "UPDATE usuario SET 
                    nombre='$nombre', 
                    apellido='$apellido', 
                    correo_electronico='$correo_electronico', 
                    telefono='$telefono', 
                    fecha_nacimiento='$fecha_nacimiento', 
                    nacionalidad='$nacionalidad' 
                    WHERE id=$usuarioId";

    if ($conexion->query($updateQuery) === TRUE) {
        // Actualizar el correo electrónico en la sesión si se cambió
        $_SESSION['email'] = $correo_electronico;
        echo "Información actualizada exitosamente.";
        // Redirigir a la página de usuario o mostrar mensaje de éxito
        header("Location: usuario.php");
    } else {
        echo "Error al actualizar la información: " . $conexion->error;
    }
} else {
    echo "Error al obtener el ID del usuario.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
