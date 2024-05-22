<?php
    include '../../conexion.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero_vuelo = $_POST['numero_vuelo'];
    $aerolinea_id = $_POST['aerolinea_id'];
    $avion_id = $_POST['avion_id'];
    $piloto_id = $_POST['piloto_id'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $hora_salida = $_POST['hora_salida'];
    $hora_llegada = $_POST['hora_llegada'];

    $sql = "INSERT INTO vuelo (numero_vuelo, aerolinea_id, avion_id, piloto_id, origen, destino, hora_salida, hora_llegada) VALUES ('$numero_vuelo', '$aerolinea_id', '$avion_id', '$piloto_id', '$origen', '$destino', '$hora_salida', '$hora_llegada')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../vuelos.php");
    } else {
        echo "Error al crear vuelo: " . $conexion->error;
    }
} else {
    echo "Error en la solicitud";
}
?>
