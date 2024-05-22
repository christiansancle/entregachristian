<?php
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    include '../../conexion.php';
    
    $param_id = trim($_GET['id']);
    
    // Eliminar vuelos asociados al avión
    $sql_delete_vuelos = "DELETE FROM vuelo WHERE avion_id = ?";
    if ($stmt_vuelos = $conexion->prepare($sql_delete_vuelos)) {
        $stmt_vuelos->bind_param("i", $param_id);
        
        if ($stmt_vuelos->execute() === FALSE) {
            echo "Error al eliminar vuelos: " . $conexion->error;
            $stmt_vuelos->close();
            $conexion->close();
            exit();
        }
        $stmt_vuelos->close();
    } else {
        echo "Error al preparar la eliminación de vuelos: " . $conexion->error;
        $conexion->close();
        exit();
    }

    // Ahora eliminar el avión
    $sql_delete_avion = "DELETE FROM avion WHERE id = ?";
    if ($stmt_avion = $conexion->prepare($sql_delete_avion)) {
        $stmt_avion->bind_param("i", $param_id);
        
        if ($stmt_avion->execute()) {
            header("location: ../aviones.php");
            exit();
        } else {
            echo "Oops! Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
        }
        $stmt_avion->close();
    } else {
        echo "Error al preparar la eliminación del avión: " . $conexion->error;
    }

    $conexion->close();
} else {
    header("location: error.php");
    exit();
}
?>
