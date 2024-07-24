<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    date_default_timezone_set("America/Chihuahua");
    $user = $_POST['user'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userStatus = 'activo';
    $fhCreacion = date('Y-m-d H:i:s');

    $directorio = "../../assets/imgUsers/";
    $archivo = isset($_FILES['imagen']['name']) ? basename($_FILES['imagen']['name']) : null;
    $rutaArchivo = $directorio . $archivo;
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

    if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
        if (($tipoArchivo == "jpg" || $tipoArchivo == "png" || $tipoArchivo == "jpeg" || $tipoArchivo == "webp") && $_FILES["imagen"]["size"] <= 1000000) {
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                echo "<script>alert('¡La imagen se subio correctamente!');</script>";
                echo "<script>window.location.href = '../web/usuarios.php';</script>";
            }
        } else {
            echo "<script>alert('¡La imagen no se subio correctamente!');</script>";
            echo "<script>window.location.href = '../web/usuarios.php';</script>";
        }
    } else {
        $rutaArchivo = null;
    }

    $sql = "INSERT INTO users (user, nombre, apellido, email, imagen, tipo, password, userStatus, fhCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssss', $user, $nombre, $apellido, $email, $archivo, $tipo, $password, $userStatus, $fhCreacion);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('¡Usuario creado correctamente!');</script>";
        echo "<script>window.location.href = '../web/usuarios.php';</script>";
    } else {
        echo "<script>alert('¡No se pudo crear el usuario!');</script>";
        echo "<script>window.location.href = '../web/usuarios.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('¡No se pudo crear el usuario!');</script>";
    echo "<script>window.location.href = '../web/usuarios.php';</script>";
}