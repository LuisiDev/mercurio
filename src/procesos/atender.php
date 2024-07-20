<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['idTicket'];
    $prioridad = $_POST['prioridad'];
    $asignado = $_POST['asignado'];
    $estado = $_POST['estado'];
    $contestacion = $_POST['contestacion'];
    $fhcontestacion = date('Y-m-d H:i:s');

    $sql = "UPDATE tbticket SET prioridad = ?, asignado = ?, estado = ?, txt_contestacion = ?, fh_contestacion = ? WHERE idTicket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $prioridad, $asignado, $estado, $contestacion, $fhcontestacion, $id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Ticket atendido exitosamente.');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    } else {
        echo "<script>alert('No se pudo asignar el ticket');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    }
} else {
    echo "<script>alert('Error en el proceso, por favor, atender este problema.');</script>";
    echo "<script>window.location.href = '../web/gestion.php';</script>";
}

$stmt->close();
$conn->close();