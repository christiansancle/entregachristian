<?php
include '../../../conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $nacionalidad = $_POST['nacionalidad'];
    $sql = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', correo_electronico='$correo', telefono='$telefono', fecha_nacimiento='$fecha_nacimiento', nacionalidad='$nacionalidad' WHERE id=$id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: ../../usuarios.php");
    } else {
        echo "Error al actualizar usuario: " . $conexion->error;
    }
} else {
    echo "Método de solicitud no válido.";
}

$conexion->close();
?>
