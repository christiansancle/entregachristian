<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../conexion.php';

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $nacionalidad = $_POST["nacionalidad"];
    $contrasena = md5($_POST['contrasena']);
    $rol = $_POST["rol"];

    $sql = "INSERT INTO usuario (nombre, apellido, correo_electronico, telefono, fecha_nacimiento, nacionalidad, contrasena, rol) VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$fecha_nacimiento', '$nacionalidad', '$contrasena', '$rol')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../usuarios.php");
    } else {
        echo "Error al agregar usuario: " . $conexion->error;
    }

    $conexion->close();
} else {
    header("Location: ../admin.php");
    exit;
}
?>
