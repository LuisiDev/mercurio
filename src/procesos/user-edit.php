<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set("America/Chihuahua");
    $id = $_POST['userId'];
    $user = $_POST['user'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $fhCreacion = date('Y-m-d H:i:s');

    $directorio = "../../assets/imgUsers/";
    $archivo = isset($_FILES['imagen']['name']) ? basename($_FILES['imagen']['name']) : null;
    $rutaArchivo = $directorio . $archivo;
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

    if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
        if (($tipoArchivo == "jpg" || $tipoArchivo == "png" || $tipoArchivo == "jpeg" || $tipoArchivo == "webp") && $_FILES['imagen']['size'] <= 1000000) {
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                echo "<script>alert('¡La imagen se subio correctamente!');</script>";
                echo "<script>window.location.href = '../web/usuarios.php';</script>";
            }
        } else {
            echo "<script>alert('¡Usuario actualizado correctamente!');</script>";
            echo "<script>window.location.href = '../web/usuarios.php';</script>";
        }
    } else {
        $rutaArchivo = null;
    }

    $sql = "UPDATE users SET user = ?, nombre = ?, apellido = ?, email = ?, imagen = ?, tipo = ? WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssi', $user, $nombre, $apellido, $email, $archivo, $tipo, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('¡Usuario actualizado correctamente!');</script>";
        echo "<script>window.location.href = '../web/usuarios.php';</script>";
    } else {
        echo "<script>alert('¡No se pudo actualizar el usuario!');</script>";
        echo "<script>window.location.href = '../web/usuarios.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('¡No se pudo actualizar el usuario!');</script>";
    echo "<script>window.location.href = '../web/usuarios.php';</script>";
}