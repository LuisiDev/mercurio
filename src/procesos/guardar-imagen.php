<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_POST['image'];
    $idTicket = $_POST['idTicket'];
    $tipoEvidencia = $_POST['tipoEvidencia'];

    // Decodificar la imagen de base64
    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

    // Guardar la imagen en el servidor (opcional)
    $filePath = "../../assets/imgTickets/$tipoEvidencia-$idTicket.png";
    file_put_contents($filePath, $data);

    // Actualizar la columna correspondiente
    $sql = "UPDATE tbticket SET $tipoEvidencia = ? WHERE idTicket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $filePath, $idTicket);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Imagen guardada correctamente.";
    } else {
        echo "Error al guardar la imagen.";
    }

    $stmt->close();
    $conn->close();
}