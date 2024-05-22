<?php
include '../../conexion.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Eliminar las reservas asociadas al usuario
    $sql_delete_reservas = "DELETE FROM reserva WHERE usuario_id = $id";
    if ($conexion->query($sql_delete_reservas) === FALSE) {
        echo "Error al eliminar reservas: " . $conexion->error;
        exit;
    }

    // Luego, eliminar al usuario
    $sql = "DELETE FROM usuario WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: ../usuarios.php");
    } else {
        echo "Error al eliminar usuario: " . $conexion->error;
    }
} else {
    echo "ID de usuario no especificado.";
}

$conexion->close();
?>
