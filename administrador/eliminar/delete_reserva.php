<?php
session_start();
include '../../conexion.php';
if (!isset($_SESSION['email'])) {
    header("Location: ../../inicio_sesion.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $reserva_id = $_POST['reserva_id'];

    // Eliminar la reserva
    $sql = "DELETE FROM reserva WHERE id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $reserva_id);
        if ($stmt->execute()) {
            header("Location: ../reservas.php");
            exit();
        } else {
            echo "Error al eliminar la reserva.";
        }
        $stmt->close();
    }
}

$conexion->close();
?>
