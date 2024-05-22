<?php
session_start();
include '../conexion.php'; // Asegúrate de que la ruta es correcta
if (!isset($_SESSION['email'])) {
    header("Location: ../inicio_sesion.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vuelo_id = $_POST['vuelo_id'];
    $usuario_id = $_POST['usuario_id'];

    $sql = "INSERT INTO reserva (vuelo_id, usuario_id) VALUES (?, ?)";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ii", $vuelo_id, $usuario_id);
        if ($stmt->execute()) {
            header("Location: reservas.php");
            exit();
        } else {
            echo "Error al añadir la reserva.";
        }
        $stmt->close();
    }
}

// Obtener usuarios
$sql_usuarios = "SELECT id, nombre FROM usuario";
$result_usuarios = $conexion->query($sql_usuarios);

// Obtener vuelos
$sql_vuelos = "SELECT id, numero_vuelo FROM vuelo";
$result_vuelos = $conexion->query($sql_vuelos);

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Reserva</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body style="background-image: url('../imagen/fondo2.jpeg'); background-size: cover;">
    <div class="container my-5">
        <h2 class="text-center mb-4">Añadir Reserva</h2>
        <div class="card">
            <div class="card-body">
                <form action="añadir_reserva.php" method="post">
                    <div class="mb-3">
                        <label for="usuario_id" class="form-label">Usuario</label>
                        <select class="form-control" id="usuario_id" name="usuario_id" required>
                            <option value="">Seleccione un usuario</option>
                            <?php
                            if ($result_usuarios->num_rows > 0) {
                                while($row_usuario = $result_usuarios->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row_usuario["id"]) . "'>" . htmlspecialchars($row_usuario["nombre"]) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vuelo_id" class="form-label">Vuelo</label>
                        <select class="form-control" id="vuelo_id" name="vuelo_id" required>
                            <option value="">Seleccione un vuelo</option>
                            <?php
                            if ($result_vuelos->num_rows > 0) {
                                while($row_vuelo = $result_vuelos->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row_vuelo["id"]) . "'>" . htmlspecialchars($row_vuelo["numero_vuelo"]) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Añadir Reserva</button>
                </form>
            </div>
        </div>
        <div class="text-end mt-3">
            <a href="reservas.php" class="btn btn-primary">Volver a Gestión de Reservas</a>
        </div>
    </div>

    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
