<?php
if (isset($_GET['aerolinea_id'])) {
    include '../conexion.php';

    $aerolinea_id = $_GET['aerolinea_id'];
    $sql = "SELECT id, modelo FROM avion WHERE aerolinea_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $aerolinea_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $aviones = [];
    while ($row = $result->fetch_assoc()) {
        $aviones[] = $row;
    }
    
    echo json_encode($aviones);

    $stmt->close();
    $conexion->close();
}
?>
