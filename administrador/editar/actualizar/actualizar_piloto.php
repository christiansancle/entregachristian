<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../../../conexion.php';

    $piloto_id = $_POST['piloto_id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $aerolinea_id = $_POST['aerolinea_id'];

    $sql = "UPDATE piloto SET nombre='$nombre', apellido='$apellido', aerolinea_id='$aerolinea_id' WHERE id='$piloto_id'";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../../pilotos.php");
    } else {
        echo "Error al actualizar piloto: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Error en la solicitud";
}
?>
