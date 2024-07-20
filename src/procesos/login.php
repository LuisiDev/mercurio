<?php
session_start();
$conn = new mysqli('localhost', 'root', 'root', 'mercurio');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$usuario = $_POST['user'];
$contrasena = $_POST['password']; //o usar SHA1($_POST['password']

$sql = "SELECT * FROM users WHERE user = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    $hashedPassword = $fila['password'];

    if (password_verify($contrasena, $hashedPassword)) {
        $_SESSION['user'] = $fila['user'];
        $_SESSION['tipo'] = $fila['tipo'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['apellido'] = $fila['apellido'];
        $_SESSION['imagen'] = $fila['imagen'];
        $_SESSION['email'] = $fila['email'];

        if ($fila['tipo'] == 'admin') {
            echo "<script>window.location.href = '../web/usuarios.php';</script>";
        } else {
            echo "<script>window.location.href = '../web/tickets.php';</script>";
        }
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        // echo "<script>window.location.href = '../index.php';</script>";
        echo $hashedPassword;
        echo $result;
    }
} else {
    echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    // echo "<script>window.location.href = '../index.php';</script>";
    echo $hashedPassword;
    echo $result;
}

$conn->close();