<?php
session_start();
include '../conexion.php';
if (!isset($_SESSION['email'])) {
    header("Location: ../inicio_sesion.html");
    exit();
}

$usuario_id = $_SESSION['usuario_id']; // Supongamos que el ID del usuario se almacena en la sesión

// Inicializar variables para filtros de fecha y ciudad
$fechaInicio = '';
$fechaFin = '';
$origen = '';
$destino = '';

// Verificar si se enviaron datos de formulario para aplicar filtros
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
}

// Obtener la fecha actual en formato de base de datos (YYYY-MM-DD)
$hoy = date('Y-m-d');

// Preparar una consulta SQL para seleccionar los vuelos según los filtros especificados
$sql = "SELECT vuelo.id, vuelo.numero_vuelo, aerolinea.nombre AS nombre_aerolinea, vuelo.origen, vuelo.destino, vuelo.hora_salida, vuelo.hora_llegada 
        FROM vuelo 
        INNER JOIN aerolinea ON vuelo.aerolinea_id = aerolinea.id 
        WHERE DATE(vuelo.hora_salida) >= ?";

$params = [$hoy];
if (!empty($fechaInicio)) {
    $sql .= " AND DATE(vuelo.hora_salida) >= ?";
    $params[] = $fechaInicio;
}
if (!empty($fechaFin)) {
    $sql .= " AND DATE(vuelo.hora_salida) <= ?";
    $params[] = $fechaFin;
}
if (!empty($origen)) {
    $sql .= " AND vuelo.origen = ?";
    $params[] = $origen;
}
if (!empty($destino)) {
    $sql .= " AND vuelo.destino = ?";
    $params[] = $destino;
}

$stmt = $conexion->prepare($sql);
$stmt->bind_param(str_repeat('s', count($params)), ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Vuelos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
</head>
<body style="background-image: url('../imagen/fondo2.jpeg'); background-size: cover;">
    <div class="container my-5">
        <h2 class="text-center mb-4">Consulta de Vuelos</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form method="post" class="row g-3">
                    <div class="col-md-3">
                        <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($fechaInicio); ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($fechaFin); ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="origen" class="form-label">Ciudad de origen:</label>
                        <input type="text" class="form-control" id="origen" name="origen" value="<?php echo htmlspecialchars($origen); ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="destino" class="form-label">Ciudad de destino:</label>
                        <input type="text" class="form-control" id="destino" name="destino" value="<?php echo htmlspecialchars($destino); ?>">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Buscar Vuelos</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Número de Vuelo</th>
                            <th>Aerolínea</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Hora de Salida</th>
                            <th>Hora de Llegada</th>
                            <th>Reserva</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Verificar si el usuario ya tiene una reserva para este vuelo
                                $vuelo_id = $row["id"];
                                $check_sql = "SELECT * FROM reserva WHERE usuario_id = ? AND vuelo_id = ?";
                                $check_stmt = $conexion->prepare($check_sql);
                                $check_stmt->bind_param("ii", $usuario_id, $vuelo_id);
                                $check_stmt->execute();
                                $check_result = $check_stmt->get_result();
                                
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["numero_vuelo"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["nombre_aerolinea"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["origen"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["destino"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["hora_salida"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["hora_llegada"]) . "</td>";
                                echo "<td>";
                                if ($check_result->num_rows > 0) {
                                    echo "<span class='text-danger'>Ya tienes una reserva</span>";
                                } else {
                                    echo "<form action='reservar.php' method='post'>";
                                    echo "<input type='hidden' name='vuelo_id' value='" . htmlspecialchars($row["id"]) . "'>"; 
                                    echo "<input type='hidden' name='usuario_id' value='" . htmlspecialchars($usuario_id) . "'>"; 
                                    echo "<button type='submit' class='btn btn-primary btn-sm'>Reservar aquí</button>";
                                    echo "</form>";
                                }
                                echo "</td>";
                                echo "</tr>";
                                $check_stmt->close();
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No se encontraron vuelos con los criterios de búsqueda especificados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-end mt-3">
            <a href="../cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
            <form action="modificar_usuario.php" method="get" style="display:inline;">
            <button type="submit" class="btn btn-warning">Modificar Información</button>
        </form>
        <form action="consultar_reservas.php" method="get" style="display:inline;">
            <button type="submit" class="btn btn-info">Consultar Vuelos Reservados</button>
        </form>
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
$stmt->close();
$conexion->close();
?>
