<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Encriptar la contraseña ingresada con MD5 para compararla con la contraseña en la base de datos
    $hashed_password = md5($password);

    $sql = "SELECT * FROM usuario WHERE correo_electronico='$email' AND contrasena='$hashed_password'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['usuario_id'] = $usuario['id'];

        if ($usuario['rol'] == 'administrador') {
            header("Location: administrador/admin.php");
        } else {
            header("Location: usuario/usuario.php");
        }
    } else {
        header("Location: inicio_sesion.html");
    }
} else {
    echo "Error";
}
?>
