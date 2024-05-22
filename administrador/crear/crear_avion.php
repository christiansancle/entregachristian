<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../../conexion.php';

    $modelo = $_POST['modelo'];
    $aerolinea_id = $_POST['aerolinea_id'];
    $capacidad_pasajeros = $_POST['capacidad_pasajeros'];
    $ano_fabricacion = $_POST['ano_fabricacion'];

    $sql = "INSERT INTO avion (modelo, aerolinea_id, capacidad_pasajeros, ano_fabricacion) 
            VALUES ('$modelo', '$aerolinea_id', '$capacidad_pasajeros', '$ano_fabricacion')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../aviones.php");
    } else {
        echo "Error al agregar avión: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Error en la solicitud";
}
?>
