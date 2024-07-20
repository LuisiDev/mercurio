<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['idTicket'];
    $prioridad = $_POST['prioridad'];
    $asignado = $_POST['asignado'];

    $sql = "UPDATE tbticket SET prioridad = ?, asignado = ? WHERE idTicket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $prioridad, $asignado, $id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Ticket asignado correctamente');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    } else {
        echo "<script>alert('No se pudo asignar el ticket');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    }
} else {
    echo "<script>alert('Error en el proceso');</script>";
    echo "<script>window.location.href = '../web/gestion.php';</script>";
}

$stmt->close();
$conn->close();