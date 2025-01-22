<?php
session_start();
$conn = new mysqli('localhost', 'root', 'root', 'mercurio');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['user']) && isset($_POST['password'])) {
    $usuario = $_POST['user'];
    $contrasena = $_POST['password']; // o usar SHA1($_POST['password']) (No recomendable, pero funcional para el uso únicamente de pruebas)

    $stmt = $conn->prepare("SELECT * FROM users WHERE BINARY user = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $hashedPassword = $fila['password'];

        if (password_verify($contrasena, $hashedPassword)) {
            if ($fila['userStatus'] == '1') {
                echo "<script>alert('Este usuario ha sido eliminado.');</script>";
                echo "<script>window.location.href = '../index.php';</script>";
                exit;
            }

            $_SESSION['user'] = $fila['user'];
            $_SESSION['tipo'] = $fila['tipo'];
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['apellido'] = $fila['apellido'];
            $_SESSION['imagen'] = $fila['imagen'];
            $_SESSION['email'] = $fila['email'];
            $_SESSION['userStatus'] = $fila['userStatus'];

            $_SESSION['userId'] = $fila['userId'];

            if ($fila['tipo'] == 'admin') {
                echo "<script>window.location.href = '../web/dashboard';</script>";
            } else {
                echo "<script>window.location.href = '../web/tickets';</script>";
            }
            exit;
        } else {
            // Contraseña incorrecta
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
    }

    $stmt->close();
} else {
    // Campos user o password no están presentes
    echo "<script>alert('Por favor, ingrese usuario y contraseña');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
}

$conn->close();