<?php
session_start();
include '../conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: inicio_sesion.html");
    exit();
}

// Obtener el ID del usuario desde la sesión
$email = $_SESSION['email'];
$query = "SELECT id FROM usuario WHERE correo_electronico='$email'";
$result = $conexion->query($query);

if ($result->num_rows == 1) {
    $usuario = $result->fetch_assoc();
    $usuarioId = $usuario['id'];

    // Obtener las reservas del usuario
    $reservasQuery = "SELECT vuelo.numero_vuelo, aerolinea.nombre AS nombre_aerolinea, vuelo.origen, vuelo.destino, vuelo.hora_salida, vuelo.hora_llegada 
                      FROM reserva 
                      INNER JOIN vuelo ON reserva.vuelo_id = vuelo.id 
                      INNER JOIN aerolinea ON vuelo.aerolinea_id = aerolinea.id 
                      WHERE reserva.usuario_id = $usuarioId";
    $reservasResult = $conexion->query($reservasQuery);
} else {
    echo "Error al obtener el ID del usuario.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Vuelos Reservados</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body style="background-image: url('../imagen/fondo5.jpg'); background-size: cover;">
    <div class="container">
        <h2>Vuelos Reservados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Número de Vuelo</th>
                    <th>Aerolínea</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Hora de Salida</th>
                    <th>Hora de Llegada</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($reservasResult->num_rows > 0) {
                    while($row = $reservasResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["numero_vuelo"] . "</td>";
                        echo "<td>" . $row["nombre_aerolinea"] . "</td>";
                        echo "<td>" . $row["origen"] . "</td>";
                        echo "<td>" . $row["destino"] . "</td>";
                        echo "<td>" . $row["hora_salida"] . "</td>";
                        echo "<td>" . $row["hora_llegada"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No tienes vuelos reservados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="usuario.php" class="btn btn-primary">Volver</a>
    </div>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
