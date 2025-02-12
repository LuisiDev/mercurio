<?php
require_once '../configuration/connection.php';

session_start();
$userId = $_SESSION['userId'];
$tipo = $_SESSION['tipo'];

// Parámetros de paginación
$paginaActual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$registrosPorPagina = 10;
$offset = ($paginaActual - 1) * $registrosPorPagina;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sqlCount = ($tipo == 'tecnico')
    ? "SELECT COUNT(*) as total FROM tbticket WHERE asignado = ? AND estado <> 0 AND (numCliente LIKE ? OR fhticket LIKE ? OR servicio LIKE ? OR prioridad LIKE ? OR estado LIKE ? OR asunto LIKE ? OR descripcion LIKE ?)"
    : "SELECT COUNT(*) as total FROM tbticket WHERE estado <> 0 AND (numCliente LIKE ? OR fhticket LIKE ? OR servicio LIKE ? OR prioridad LIKE ? OR estado LIKE ? OR asunto LIKE ? OR descripcion LIKE ?)";

$stmtCount = $conn->prepare($sqlCount);
$searchParam = '%' . $search . '%';
switch ($tipo) {
    case 'tecnico':
        $stmtCount->bind_param("isssssss", $userId, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
        $stmtCount->execute();
        $resultCount = $stmtCount->get_result();
        $totalTickets = $resultCount->fetch_assoc()['total'];

        $sql = "SELECT t.*, u.nombre, u.imagen, u.tipo
                FROM tbticket t
                LEFT JOIN users u ON t.asignado = u.userId
                WHERE t.asignado = ? AND t.estado <> 0 AND (t.numCliente LIKE ? OR t.fhticket LIKE ? OR t.servicio LIKE ? OR t.prioridad LIKE ? OR t.estado LIKE ? OR t.asunto LIKE ? OR t.descripcion LIKE ?)
                ORDER BY t.fhticket DESC
                LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssssi", $userId, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        break;

    default:
        $stmtCount->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
        $stmtCount->execute();
        $resultCount = $stmtCount->get_result();
        $totalTickets = $resultCount->fetch_assoc()['total'];

        $sql = "SELECT t.*, u.nombre, u.imagen, u.tipo
                FROM tbticket t
                LEFT JOIN users u ON t.asignado = u.userId
                WHERE t.estado <> 0 AND (t.numCliente LIKE ? OR t.fhticket LIKE ? OR t.servicio LIKE ? OR t.prioridad LIKE ? OR t.estado LIKE ? OR t.asunto LIKE ? OR t.descripcion LIKE ?)
                ORDER BY t.fhticket DESC
                LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
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
    'paginaActual' => $paginaActual,
    'userId' => $userId,
    'tipo' => $tipo
]);