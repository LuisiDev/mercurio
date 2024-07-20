<?php
session_start();
$conn = new mysqli('localhost', 'root', 'root', 'mercurio');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si los campos user y password están presentes
if (isset($_POST['user']) && isset($_POST['password'])) {
    $usuario = $_POST['user'];
    $contrasena = $_POST['password']; // o usar SHA1($_POST['password'])

    $stmt = $conn->prepare("SELECT * FROM users WHERE user = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $hashedPassword = $fila['password'];

        if (password_verify($contrasena, $hashedPassword)) {
            // Establecer las variables de sesión
            $_SESSION['user'] = $fila['user'];
            $_SESSION['tipo'] = $fila['tipo'];
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['apellido'] = $fila['apellido'];
            $_SESSION['imagen'] = $fila['imagen'];
            $_SESSION['email'] = $fila['email'];

            // Redirigir según el tipo de usuario
            if ($fila['tipo'] == 'admin') {
                echo "<script>window.location.href = '../web/usuarios.php';</script>";
            } else {
                echo "<script>window.location.href = '../web/tickets.php';</script>";
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