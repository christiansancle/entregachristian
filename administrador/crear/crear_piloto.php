<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../../conexion.php';
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $aerolinea_id = $_POST['aerolinea_id'];

    $sql = "INSERT INTO piloto (nombre, apellido, aerolinea_id) VALUES ('$nombre', '$apellido', '$aerolinea_id')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../pilotos.php");
    } else {
        echo "Error al agregar piloto: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Error en la solicitud";
}
?>
