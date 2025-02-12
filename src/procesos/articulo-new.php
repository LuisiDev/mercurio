<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    date_default_timezone_set("America/Chihuahua");
    $artNombre = $_POST['artNombre'];
    $artSubNombre = $_POST['artSubNombre'] ?? null;
    $marca = $_POST['marca'] ?? null;
    $categoria = $_POST['categoria'];
    $precioPublico = $_POST['precioPublico'] ?? null;
    $precioInstalacion = $_POST['precioInstalacion'] ?? null;
    $comComercial = $_POST['comComercial'] ?? null;
    $comInstalacion = $_POST['comInstalacion'] ?? null;
    $concepto = $_POST['concepto'];
    $paquete = $_POST['opcionPaquete'] == '1' ? implode(',', $_POST['paquetes']) : $_POST['opcionPaquete'];
    $fhRegistro = date('Y-m-d H:i:s');

    $directorio = "../../assets/imgArticulos/";
    $archivo = isset($_FILES['artImg']['name']) ? basename($_FILES['artImg']['name']) : null;
    $rutaArchivo = $directorio . $archivo;
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

    if (isset($_FILES['artImg']) && $_FILES['artImg']['size'] > 0) {
        if (($tipoArchivo == "jpg" || $tipoArchivo == "png" || $tipoArchivo == "jpeg" || $tipoArchivo == "webp") && $_FILES["artImg"]["size"] <= 1000000) {
            if (!move_uploaded_file($_FILES['artImg']['tmp_name'], $rutaArchivo)) {
                echo "<script>alert('¡La imagen se subio correctamente!');</script>";
                echo "<script>window.location.href = '../web/articulos.php';</script>";
            }
        } else {
            echo "<script>alert('¡La imagen no se subio correctamente!');</script>";
            echo "<script>window.location.href = '../web/articulos.php';</script>";
        }
    } else {
        $rutaArchivo = null;
    }

    $sql = "INSERT INTO articulos (artNombre, artSubNombre, marca, categoria, precioPublico, precioInstalacion, comComercial, comInstalacion, concepto, paquete, artImg, fhRegistro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssssss', $artNombre, $artSubNombre, $marca, $categoria, $precioPublico, $precioInstalacion, $comComercial, $comInstalacion, $concepto, $paquete, $archivo, $fhRegistro);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('¡Artículo creado correctamente!');</script>";
        echo "<script>window.location.href = '../web/articulos.php';</script>";
    } else {
        echo "<script>alert('¡No se pudo crear el artículo!');</script>";
        echo "<script>window.location.href = '../web/articulos.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('¡No se pudo crear el artículo!');</script>";
    echo "<script>window.location.href = '../web/articulos';</script>";
}
?>