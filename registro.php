<?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $nacionalidad = $_POST['nacionalidad'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO usuario (nombre, apellido, correo_electronico, telefono, fecha_nacimiento, nacionalidad, contrasena) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$fecha_nacimiento', '$nacionalidad', '$password')";

    if ($conexion->query($sql) === TRUE) {
        header("Location:inicio_sesion.html");
    } else {
        echo "Error al registrar el usuario: " . $conexion->error;
    }
} else {
    echo "Error en la solicitud";
}
?>
