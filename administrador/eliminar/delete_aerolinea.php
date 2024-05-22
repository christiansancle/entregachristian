<?php
if (isset($_GET['id'])) {
    $aerolinea_id = $_GET['id'];

    include '../../conexion.php';

    // Eliminar vuelos asociados a los pilotos de la aerolínea
    $sql_select_pilotos = "SELECT id FROM piloto WHERE aerolinea_id = $aerolinea_id";
    $result_pilotos = $conexion->query($sql_select_pilotos);
    
    if ($result_pilotos) {
        while ($row = $result_pilotos->fetch_assoc()) {
            $piloto_id = $row['id'];
            $sql_delete_vuelos = "DELETE FROM vuelo WHERE piloto_id = $piloto_id";
            if ($conexion->query($sql_delete_vuelos) === FALSE) {
                echo "Error al eliminar vuelos: " . $conexion->error;
                exit;
            }
        }
    } else {
        echo "Error al seleccionar pilotos: " . $conexion->error;
        exit;
    }

    // Eliminar pilotos asociados a la aerolínea
    $sql_delete_pilotos = "DELETE FROM piloto WHERE aerolinea_id = $aerolinea_id";
    if ($conexion->query($sql_delete_pilotos) === FALSE) {
        echo "Error al eliminar pilotos: " . $conexion->error;
        exit;
    }

    // Eliminar aviones asociados a la aerolínea
    $sql_delete_aviones = "DELETE FROM avion WHERE aerolinea_id = $aerolinea_id";
    if ($conexion->query($sql_delete_aviones) === FALSE) {
        echo "Error al eliminar aviones: " . $conexion->error;
        exit;
    }

    // Eliminar la aerolínea
    $sql_delete_aerolinea = "DELETE FROM aerolinea WHERE id = $aerolinea_id";
    if ($conexion->query($sql_delete_aerolinea) === TRUE) {
        header("Location: ../aerolineas.php");
    } else {
        echo "Error al eliminar aerolínea: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "ID de aerolínea no especificado.";
}
?>
