<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../../conexion.php';

    $nombre = $_POST['nombre'];
    $pais_origen = $_POST['pais_origen'];
    $contacto = $_POST['contacto'];

    $sql = "INSERT INTO aerolinea (nombre, pais_origen, contacto) VALUES ('$nombre', '$pais_origen', '$contacto')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../aerolineas.php");
    } else {
        echo "Error al agregar aerolínea: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Error en la solicitud";
}
?>
