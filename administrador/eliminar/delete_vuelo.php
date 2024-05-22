<?php
if (isset($_GET['id'])) {
    $vuelo_id = $_GET['id'];

    include '../../conexion.php';

    $sql_delete_reservas = "DELETE FROM reserva WHERE vuelo_id = $vuelo_id";

    if ($conexion->query($sql_delete_reservas) === TRUE) {
        $sql_delete_vuelo = "DELETE FROM vuelo WHERE id = $vuelo_id";

        if ($conexion->query($sql_delete_vuelo) === TRUE) {
            header("Location: ../vuelos.php");
        } else {
            echo "Error al eliminar vuelo: " . $conexion->error;
        }
    } else {
        echo "Error al eliminar reservas asociadas al vuelo: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "ID de vuelo no especificado.";
}
?>
