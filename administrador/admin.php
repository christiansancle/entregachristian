<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .menu {
            text-align: center;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .menu h2 {
            margin-bottom: 20px;
        }
        .menu a {
            display: block;
            margin: 10px 0;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
        }
        .menu a:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body style="background-image: url('../imagen/fondo6.avif'); background-size: cover;">
    <div class="menu">
        <h2>Panel de Administrador</h2>
        <a href="usuarios.php">Gestión de Usuarios</a>
        <a href="aerolineas.php">Gestión de Aerolíneas</a>
        <a href="pilotos.php">Gestión de Pilotos</a>
        <a href="aviones.php">Gestión de Aviones</a>
        <a href="vuelos.php">Gestión de Vuelos</a>
        <a href="reservas.php">Gestión de Reservas</a> 
        <hr>
        <a href="../cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</body>
</html>
