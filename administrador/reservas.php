<?php
session_start();
include '../conexion.php';
if (!isset($_SESSION['email'])) {
    header("Location: ../inicio_sesion.html");
    exit();
}

// Obtener todas las reservas
$sql = "SELECT reserva.id, vuelo.numero_vuelo, usuario.nombre AS nombre_usuario, vuelo.origen, vuelo.destino, vuelo.hora_salida, vuelo.hora_llegada 
        FROM reserva 
        INNER JOIN vuelo ON reserva.vuelo_id = vuelo.id 
        INNER JOIN usuario ON reserva.usuario_id = usuario.id";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Reservas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
</head>
<body style="background-image: url('../imagen/fondo2.jpeg'); background-size: cover;">
    <div class="container my-5">
        <h2 class="text-center mb-4">Gestión de Reservas</h2>

        <div class="text-end mb-3">
            <a href="añadir_reserva.php" class="btn btn-success">Añadir Reserva</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Reserva</th>
                            <th>Número de Vuelo</th>
                            <th>Usuario</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Hora de Salida</th>
                            <th>Hora de Llegada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["numero_vuelo"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["nombre_usuario"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["origen"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["destino"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["hora_salida"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["hora_llegada"]) . "</td>";
                                echo "<td>";
                                echo "<form action='eliminar/delete_reserva.php' method='post' style='display:inline;'>";
                                echo "<input type='hidden' name='reserva_id' value='" . htmlspecialchars($row["id"]) . "'>";
                                echo "<button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>No se encontraron reservas.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-end mt-3">
            <a href="admin.php" class="btn btn-primary">Volver al Panel de Administración</a>
        </div>
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
$conexion->close();
?>
