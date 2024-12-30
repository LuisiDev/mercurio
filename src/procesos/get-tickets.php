<?php
include '../configuration/connection.php';

header ('Content-Type: application/json');

$sql = "SELECT id, asunto, estado, fecha FROM tbticket";
$result = $conn->query($sql);

$tickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}

echo json_encode($tickets);
?>