<?php
include '../configuration/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $fhbaja = date('Y-m-d H:i:s');

    $query = "UPDATE users SET userStatus = 0, fhBaja = NULL WHERE userId = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Usuario activado correctamente.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al activar al usuario.'));
        }
        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al preparar la consulta en la activación del usuario.'));
    }
}