<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../../../conexion.php';
    $aerolinea_id = $_POST['aerolinea_id'];
    $nombre = $_POST['nombre'];
    $pais_origen = $_POST['pais_origen'];
    $contacto = $_POST['contacto'];
    $sql = "UPDATE aerolinea SET nombre='$nombre', pais_origen='$pais_origen', contacto='$contacto' WHERE id='$aerolinea_id'";
    if ($conexion->query($sql) === TRUE) {
        header("Location: ../../aerolineas.php");
    } else {
        echo "Error al actualizar aerolínea: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Error en la solicitud";
}
?>
