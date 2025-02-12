<?php
include '../configuration/connection.php';

$year = isset($_GET['year']) ? (int) $_GET['year'] : date('Y');
$week = isset($_GET['week']) ? (int) $_GET['week'] : date('W');
$tecnicoId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Consulta optimizada para filtrar por semana
$sqlTickets = "
    SELECT * FROM tbticket
    WHERE (estado = 6 OR (estado = 0 AND token IS NULL)) AND WEEK(fhticket, 1) = ? AND YEAR(fhticket) = ? AND asignado = ?
";
$stmtTickets = $conn->prepare($sqlTickets);
$stmtTickets->bind_param('iii', $week, $year, $tecnicoId);
$stmtTickets->execute();
$resultTickets = $stmtTickets->get_result();

$tickets = [];
while ($row = $resultTickets->fetch_assoc()) {
    $tickets[] = $row;
}

echo json_encode($tickets);