<?php
require_once '../configuration/connection.php';

session_start();
$userId = $_SESSION['userId'];
$tipo = $_SESSION['tipo'];

// Parámetros de paginación
$paginaActual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$registrosPorPagina = 20;
$offset = ($paginaActual - 1) * $registrosPorPagina;

$sqlCount = ($tipo == 'tecnico')
    ? "SELECT COUNT(*) as total FROM tbticket WHERE asignado = ? AND estado <> 0"
    : "SELECT COUNT(*) as total FROM tbticket WHERE estado <> 0";

$stmtCount = $conn->prepare($sqlCount);
switch ($tipo) {
    case 'tecnico':
        $stmtCount->bind_param("i", $userId);
        $stmtCount->execute();
        $resultCount = $stmtCount->get_result();
        $totalTickets = $resultCount->fetch_assoc()['total'];

        $sql = "SELECT t.*, u.nombre, u.imagen 
                FROM tbticket t
                LEFT JOIN users u ON t.asignado = u.userId
                WHERE t.asignado = ? AND t.estado <> 0
                ORDER BY t.fhticket DESC
                LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $userId, $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        break;

    default:
        $stmtCount->execute();
        $resultCount = $stmtCount->get_result();
        $totalTickets = $resultCount->fetch_assoc()['total'];

        $sql = "SELECT t.*, u.nombre, u.imagen 
                FROM tbticket t
                LEFT JOIN users u ON t.asignado = u.userId
                WHERE t.estado <> 0
                ORDER BY t.fhticket DESC
                LIMIT $registrosPorPagina OFFSET $offset";
        $resultado = $conn->query($sql);
        break;
}

// Arreglo para almacenar los datos
$data = [];
while ($fila = $resultado->fetch_assoc()) {
    $data[] = $fila;
}

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode([
    'tickets' => $data,
    'totalTickets' => $totalTickets,
    'registrosPorPagina' => $registrosPorPagina,
    'paginaActual' => $paginaActual
]);