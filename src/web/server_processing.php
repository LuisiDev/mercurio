<?php
include '../configuration/conn-session.php';

header('Content-Type: application/json');

$requestData = $_POST;

$columns = [
    0 => 'idTicket',
    1 => 'asunto',
    2 => 'numCliente',
    3 => 'fhticket',
    4 => 'servicio',
    5 => 'asignado',
    6 => 'prioridad',
    7 => 'estado'
];

$sql = "SELECT t.*, u.imagen FROM tbticket t LEFT JOIN users u ON t.asignado = u.userId WHERE t.estado <> 0";
$query = $conn->query($sql);
$totalData = $query->num_rows;
$totalFiltered = $totalData;

$sql = "SELECT t.*, u.imagen FROM tbticket t LEFT JOIN users u ON t.asignado = u.userId WHERE t.estado <> 0";

if (!empty($requestData['search']['value'])) {
    $sql .= " AND (idTicket LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR asunto LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR numCliente LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR fhticket LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR servicio LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR asignado LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR prioridad LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR estado LIKE '%" . $requestData['search']['value'] . "%' )";
}

$query = $conn->query($sql);
$totalFiltered = $query->num_rows;

$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . ", " . $requestData['length'] . " ";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    $nestedData = [];
    $nestedData[] = $row['idTicket'];
    $nestedData[] = $row['asunto'];
    $nestedData[] = $row['numCliente'];
    $nestedData[] = $row['fhticket'];
    $nestedData[] = $row['servicio'];
    $nestedData[] = $row['asignado'];
    $nestedData[] = $row['prioridad'];
    $nestedData[] = $row['estado'];
    $data[] = $nestedData;
}

$json_data = [
    "draw" => intval($requestData['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
];

echo json_encode($json_data);
?>