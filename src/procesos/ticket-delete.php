<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTicket = $_POST['idTicket'] ?? null;
    $motivo = $_POST['motivo_eliminacion'] ?? null;
    $eliminadoPor = $_POST['eliminadoPor'] ?? null;

    if ($idTicket && $motivo && $eliminadoPor) {
        // Lógica para eliminar el ticket en la base de datos
        $stmt = $pdo->prepare('DELETE FROM tickets WHERE id = :id');
        $stmt->execute(['id' => $idTicket]);

        if ($stmt->rowCount() > 0) {
            echo 'Ticket eliminado';
        } else {
            http_response_code(400);
            echo 'No se pudo eliminar el ticket';
        }
    } else {
        http_response_code(400);
        echo 'Faltan datos para eliminar el ticket';
    }
} else {
    http_response_code(405);
    echo 'Método no permitido';
}
?>
