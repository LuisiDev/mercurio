<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['idTicket'];
    $prioridad = $_POST['prioridad'];
    $asignado = $_POST['asignado'];
    $estado = $_POST['estado'];
    $contestacion = $_POST['contestacion'];
    $fhcontestacion = date('Y-m-d H:i:s');

    $sqlGetEvidencias = "SELECT evidenciaAbierto, evidenciaHaciendo, evidenciaHecho FROM tbticket WHERE idTicket = ?";
    $stmtGetEvidencias = $conn->prepare($sqlGetEvidencias);
    $stmtGetEvidencias->bind_param('i', $id);
    $stmtGetEvidencias->execute();
    $stmtGetEvidencias->bind_result($rutaActualEvidenciaAbierto, $rutaActualEvidenciaHaciendo, $rutaActualEvidenciaHecho);
    $stmtGetEvidencias->fetch();
    $stmtGetEvidencias->close();

    $rutaEvidenciaAbierto = $rutaActualEvidenciaAbierto;
    $rutaEvidenciaHaciendo = $rutaActualEvidenciaHaciendo;
    $rutaEvidenciaHecho = $rutaActualEvidenciaHecho;

    function subirEvidencia($campo, $destino) {
        if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] == 0) {
            $archivoTmp = $_FILES[$campo]['tmp_name'];
            $nombreArchivo = time() . '_' . basename($_FILES[$campo]['name']);
            $rutaDestino = $destino . '/' . $nombreArchivo;

            $tipoArchivo = pathinfo($rutaDestino, PATHINFO_EXTENSION);
            if ($_FILES[$campo]['size'] <= 3145728 && in_array($tipoArchivo, ['jpeg', 'jpg', 'png', 'webp'])) {
                if (move_uploaded_file($archivoTmp, $rutaDestino)) {
                    return $nombreArchivo;
                }
            }
        }
        return null;
    }

    $carpetaDestino = "../../assets/imgTickets";

    if (!empty($_FILES['evidenciaAbierto']['name'])) {
        $rutaEvidenciaAbierto = subirEvidencia('evidenciaAbierto', $carpetaDestino);
    }
    if (!empty($_FILES['evidenciaHaciendo']['name'])) {
        $rutaEvidenciaHaciendo = subirEvidencia('evidenciaHaciendo', $carpetaDestino);
    }
    if (!empty($_FILES['evidenciaHecho']['name'])) {
        $rutaEvidenciaHecho = subirEvidencia('evidenciaHecho', $carpetaDestino);
    }

    $sql = "UPDATE tbticket SET prioridad = ?, asignado = ?, estado = ?, txt_contestacion = ?, fh_contestacion = ?, evidenciaAbierto = ?, evidenciaHaciendo = ?, evidenciaHecho = ? WHERE idTicket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssi', $prioridad, $asignado, $estado, $contestacion, $fhcontestacion, $rutaEvidenciaAbierto, $rutaEvidenciaHaciendo, $rutaEvidenciaHecho, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Ticket atendido exitosamente.');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    } else {
        echo "<script>alert('No se pudo asignar el ticket');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    }
} else {
    echo "<script>alert('Error en el proceso, por favor, atender este problema.');</script>";
    echo "<script>window.location.href = '../web/gestion.php';</script>";
}

$stmt->close();
$conn->close();