<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    // Verificar si el usuario ha iniciado sesión
    if(isset($_SESSION['email'])) {
        $vueloId = $_POST['vuelo_id'];
        // Obtener el ID de usuario de la sesión iniciada
        $email = $_SESSION['email'];
        $query = "SELECT id FROM usuario WHERE correo_electronico='$email'";
        $result = $conexion->query($query);
        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usuarioId = $row['id'];

            $vueloQuery = "SELECT * FROM vuelo WHERE id = $vueloId";
            $vueloResult = $conexion->query($vueloQuery);
            
            if ($vueloResult->num_rows > 0) {
                $insertReserva = "INSERT INTO reserva (vuelo_id, usuario_id) VALUES ('$vueloId', '$usuarioId')";
                
                if ($conexion->query($insertReserva) === TRUE) {
                    header("Location: usuario.php");
                } else {
                    echo "Error al realizar la reserva: " . $conexion->error;
                }
            } else {
                echo "El vuelo especificado no existe en la base de datos.";
            }
        } else {
            echo "Error al obtener el ID de usuario.";
        }
    } else {
        echo "No se ha iniciado sesión.";
    }
} else {
    header("Location: usuario.php");
    exit();
}
$conexion->close();
?>
