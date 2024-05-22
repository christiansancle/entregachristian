<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../../../conexion.php';
    
    $vuelo_id = $_POST['vuelo_id'];
    $numero_vuelo = $_POST['numero_vuelo'];
    $aerolinea_id = $_POST['aerolinea_id'];
    $avion_id = $_POST['avion_id'];
    $piloto_id = $_POST['piloto_id'];
    $hora_salida = $_POST['hora_salida'];
    $hora_llegada = $_POST['hora_llegada'];

    if(empty($vuelo_id) || empty($numero_vuelo) || empty($aerolinea_id) || empty($avion_id) || empty($piloto_id) || empty($hora_salida) || empty($hora_llegada)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    $sql = "UPDATE vuelo SET 
                numero_vuelo = ?, 
                aerolinea_id = ?, 
                avion_id = ?, 
                piloto_id = ?, 
                hora_salida = ?, 
                hora_llegada = ? 
            WHERE id = ?";

    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        echo "Error al preparar la consulta: " . $conexion->error;
        exit;
    }

    $stmt->bind_param("siiissi", $numero_vuelo, $aerolinea_id, $avion_id, $piloto_id, $hora_salida, $hora_llegada, $vuelo_id);

    if ($stmt->execute() === TRUE) {
        header("Location: ../../vuelos.php");
        exit;
    } else {
        echo "Error al actualizar vuelo: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no permitido.";
}
?>
