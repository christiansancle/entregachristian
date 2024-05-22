<?php
include '../../conexion.php';

if(isset($_GET['id'])) {
    $piloto_id = $_GET['id'];

    // Verificar si el piloto tiene vuelos programados
    $sql_check_vuelos = "SELECT COUNT(*) AS num_vuelos FROM vuelo WHERE piloto_id = $piloto_id";
    $result = $conexion->query($sql_check_vuelos);

    if ($result) {
        $row = $result->fetch_assoc();
        $num_vuelos = $row['num_vuelos'];

        if ($num_vuelos > 0) {
            // Mostrar alerta y volver atrás en el historial del navegador
            echo "<script>alert('No se puede eliminar el piloto porque tiene vuelos registrados.'); window.history.back();</script>";
            exit();
        } else {
            // No hay vuelos programados para este piloto, proceder con la eliminación
            $sql_delete_piloto = "DELETE FROM piloto WHERE id = $piloto_id";
            if ($conexion->query($sql_delete_piloto) === TRUE) {
                // Mostrar alerta de éxito y redirigir a la página de pilotos
                echo "<script>alert('Piloto eliminado con éxito.'); window.location.href='../pilotos.php';</script>";
            } else {
                echo "Error al eliminar piloto: " . $conexion->error;
            }
        }
    } else {
        echo "Error al verificar vuelos del piloto: " . $conexion->error;
    }
} else {
    echo "ID de piloto no especificado.";
}

$conexion->close();
?>
