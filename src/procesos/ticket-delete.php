<?php
include '../configuration/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idTicket = $_POST['idTicket'];
    $motivo = $_POST['motivo_eliminacion'];
    $fh_eliminacion = date('Y-m-d H:i:s');
    $eliminadoPor = $_SESSION['user'];

    $query = "UPDATE tbticket SET estado = 0, motivo_eliminacion = ?, fh_eliminacion = ?, eliminadopor = ? WHERE idTicket = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("sssi", $motivo, $fh_eliminacion, $eliminadoPor, $idTicket);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Ticket eliminado correctamente'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar el ticket'));
        }
        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al preparar la consulta'));
    }
}