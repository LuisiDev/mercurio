<?php
session_start();
include '../configuration/connection.php';

if (count($_FILES) <= 0 || empty($_FILES["audio"])) {
    exit("No se encontró ningún archivo de audio");
}

$rutaAudioSubido = $_FILES["audio"]["tmp_name"];
$nuevoNombre = uniqid() . ".mp3";

$directorioAudios = __DIR__ . "/../../assets/audios";
$rutaGuardado = $directorioAudios . "/" . $nuevoNombre;

if (!file_exists($directorioAudios)) {
    mkdir($directorioAudios, 0777, true);
}

if (move_uploaded_file($rutaAudioSubido, $rutaGuardado)) {
    $idTicket = $_POST['idTicket'];
    $sql = "UPDATE tbticket SET evidenciaAudio = ? WHERE idTicket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $nuevoNombre, $idTicket);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo $nuevoNombre;
} else {
    echo "Error al mover el archivo de audio.";
}