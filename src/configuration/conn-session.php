<?php
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: ../index.php");
   exit();
}

include '../configuration/connection.php';

$tipo = $_SESSION['tipo'];
$userId = $_SESSION['userId'];

if ($tipo == 'tecnico') {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE asignado = ? AND estado <> 0";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param('i', $userId);
   $stmt->execute();
   $resultado = $stmt->get_result();
   $fila = $resultado->fetch_assoc();
   $totalTickets = $fila['total'];
} else {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE estado <> 0";
   $resultado = $conn->query($sql);
   $fila = $resultado->fetch_assoc();
   $totalTickets = $fila['total'];
}

if ($tipo == 'tecnico') {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE (estado = '0' || estado = '4') AND token != '' AND asignado = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param('i', $userId);
   $stmt->execute();
   $resultado = $stmt->get_result();
   $fila = $resultado->fetch_assoc();
   $totalEncuestas = $fila['total'];
} else {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE (estado = '0' || estado = '4') AND token != ''";
   $resultado = $conn->query($sql);
   $fila = $resultado->fetch_assoc();
   $totalEncuestas = $fila['total'];
}

$sql = "SELECT userId, nombre, apellido, imagen, tipo FROM users";
$stmt = $conn->prepare($sql);

if (!$stmt) {
   die("Error al preparar: (" . $stmt->errno . ") " . $stmt->error);
}

if (!$stmt->execute()) {
   die("Error al ejecutar: (" . $stmt->errno . ") " . $stmt->error);
}

$userResult = $stmt->get_result();

if (!$userResult) {
   die("Error al obtener resultados (" . $stmt->errno . ") " . $stmt->error);
}

function userType($type)
{
   switch ($type) {
      case "admin":
         echo 'Administrador';
         break;
      case "coordinador":
         echo 'Coordinador';
         break;
      case "comercializacion":
         echo 'Comercialización';
         break;
      case "acomercial":
         echo 'Asistente de comercialización';
         break;
      case "tecnico":
         echo 'Técnico';
         break;
   }
}

// $notificationSql = "SELECT * FROM notificaciones WHERE userId = ? ORDER BY created_at DESC";
// $notificationStmt = $conn->prepare($notificationSql);
// $notificationStmt->bind_param('i', $userId);
// $notificationStmt->execute();
// $notificationResult = $notificationStmt->get_result();