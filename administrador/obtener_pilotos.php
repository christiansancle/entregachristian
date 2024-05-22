<?php
if (isset($_GET['aerolinea_id'])) {
    include '../conexion.php';

    $aerolinea_id = $_GET['aerolinea_id'];
    $sql = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM piloto WHERE aerolinea_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $aerolinea_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $pilotos = [];
    while ($row = $result->fetch_assoc()) {
        $pilotos[] = $row;
    }
    
    echo json_encode($pilotos);

    $stmt->close();
    $conexion->close();
}
?>
