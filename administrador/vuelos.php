<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Vuelos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1200px;
            text-align: center;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .btn-container {
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-image: url('../imagen/fondo15.jpeg'); background-size: cover;">
    <div class="container">
        <h2>Gestión de Vuelos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número de Vuelo</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Hora de Salida</th>
                    <th>Hora de Llegada</th>
                    <th>Piloto ID</th>
                    <th>Avión ID</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                session_start();
                include '../conexion.php';

                if (!isset($_SESSION['email'])) {
                    header("Location: ../inicio_sesion.html");
                    exit();
                }

                $sql = "SELECT * FROM vuelo";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["numero_vuelo"] . "</td>";
                        echo "<td>" . $row["origen"] . "</td>";
                        echo "<td>" . $row["destino"] . "</td>";
                        echo "<td>" . $row["hora_salida"] . "</td>";
                        echo "<td>" . $row["hora_llegada"] . "</td>";
                        echo "<td>" . $row["piloto_id"] . "</td>";
                        echo "<td>" . $row["avion_id"] . "</td>";
                        echo "<td><a href='editar/editar_vuelo.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Editar</a> | <a href='eliminar/delete_vuelo.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No hay vuelos registrados</td></tr>";
                }
                $conexion->close();
            ?>
            </tbody>
        </table>
        <div class="btn-container">
            <a href="agregar_vuelo.php" class="btn btn-primary btn-sm">Agregar Vuelo</a>
            <a href="admin.php" class="btn btn-secondary btn-sm">Volver al Menú</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-CO.json'
                }
            });
        });
    </script>
</body>
</html>
