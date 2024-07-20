<?php
include '../configuration/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $fhbaja = date('Y-m-d H:i:s');

    $query = "UPDATE users SET userStatus = 1, fhBaja = ? WHERE userId = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("si", $fhbaja, $userId);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Usuario dado de baja correctamente.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al dar de baja al usuario.'));
        }
        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al preparar la consulta en la eliminación del usuario.'));
    }
}