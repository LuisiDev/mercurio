<?php
session_start();
include '../configuration/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['idTicket'];
    $prioridad = $_POST['prioridad'];
    $asignado = $_POST['asignado'];
    $estado = $_POST['estado'];
    $contestacion = $_POST['contestacion'];
    $fhcontestacion = date('Y-m-d H:i:s');

    $sqlGetEvidencias = "SELECT evidenciaArribo, evidenciaInicio, evidenciaRealizacion, evidenciaFinalizacion FROM tbticket WHERE idTicket = ?";
    $stmtGetEvidencias = $conn->prepare($sqlGetEvidencias);
    $stmtGetEvidencias->bind_param('i', $id);
    $stmtGetEvidencias->execute();
    $stmtGetEvidencias->bind_result($rutaActualEvidenciaArribo, $rutaActualEvidenciaInicio, $rutaActualEvidenciaRealizacion, $rutaActualEvidenciaFinalizacion);
    $stmtGetEvidencias->fetch();
    $stmtGetEvidencias->close();

    $rutaEvidenciaArribo = $rutaActualEvidenciaArribo;
    $rutaEvidenciaInicio = $rutaActualEvidenciaInicio;
    $rutaEvidenciaRealizacion = $rutaActualEvidenciaRealizacion;
    $rutaEvidenciaFinalizacion = $rutaActualEvidenciaFinalizacion;

    function subirEvidencia($campo, $destino)
    {
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

    if (!empty($_FILES['evidenciaArribo']['name'])) {
        $rutaEvidenciaArribo = subirEvidencia('evidenciaArribo', $carpetaDestino);
    }
    if (!empty($_FILES['evidenciaInicio']['name'])) {
        $rutaEvidenciaInicio = subirEvidencia('evidenciaInicio', $carpetaDestino);
    }
    if (!empty($_FILES['evidenciaRealizacion']['name'])) {
        $rutaEvidenciaRealizacion = subirEvidencia('evidenciaRealizacion', $carpetaDestino);
    }
    if (!empty($_FILES['evidenciaFinalizacion']['name'])) {
        $rutaEvidenciaFinalizacion = subirEvidencia('evidenciaFinalizacion', $carpetaDestino);
    }

    $sql = "UPDATE tbticket SET prioridad = ?, asignado = ?, estado = ?, txt_contestacion = ?, fhContestacion = ?, evidenciaArribo = ?, evidenciaInicio = ?, evidenciaRealizacion = ?, evidenciaFinalizacion = ? WHERE idTicket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssi', $prioridad, $asignado, $estado, $contestacion, $fhcontestacion, $rutaEvidenciaArribo, $rutaEvidenciaInicio, $rutaEvidenciaRealizacion, $rutaEvidenciaFinalizacion, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        if ($estado == "6") {
            $sqlCorreo = "SELECT correo, nomContacto, asunto, servicio, fhContestacion, txt_contestacion, numCliente, dispositivo FROM tbticket WHERE idTicket = ?";
            $stmtCorreo = $conn->prepare($sqlCorreo);
            $stmtCorreo->bind_param('i', $id);
            $stmtCorreo->execute();
            $stmtCorreo->bind_result($correo, $nomContacto, $asunto, $servicio, $fhcontestacion, $txtcontestacion, $numCliente, $dispositivo);
            $stmtCorreo->fetch();
            $stmtCorreo->close();

            $sqlUsuario = "SELECT nombre FROM users WHERE userId = ?";
            $stmtUsuario = $conn->prepare($sqlUsuario);
            $stmtUsuario->bind_param('s', $asignado);
            $stmtUsuario->execute();
            $stmtUsuario->bind_result($nombreAsignado);
            $stmtUsuario->fetch();
            $stmtUsuario->close();

            if (!empty($correo)) {
                $mail = new PHPMailer(true);

                try {
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host = 'email-smtp.us-east-1.amazonaws.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'AKIA3HJXVSKBDCQSUVUK';
                    $mail->Password = 'BBJq0wi3aCh0zuMhCuO2jlNTWaejJ8Mw8h7gBg8XMyRv';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('mercurio@atlantida.mx');
                    $mail->addAddress($correo);
                    $mail->isHTML(true);
                    $mail->Subject = '🎫 Finalización de Ticket';
                    $mail->Body = '
                    <div style="background: #1175cf;">
                    <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px;">
                    <div style="background: #0078e3;">
                    <img src="https://grupocardinales.com/assets/img/gcLogo.png" style="display: block; margin: 0 auto; padding: 20px 0px 10px; width: 200px; height: auto" alt="Grupo Cardinales">
                    </div>
                    <div style="background: #fff; padding: 0 30px 0 30px;">
                    <br>
                    <h1 style="font-size: 24px; font-weight: 700; color: #191919">Finalización de ticket</h1>
                    <p>¡Hola estimado cliente <b>' . $nomContacto . '</b>! Tu ticket ha sido marcado como Terminado. A continuación, te mostramos los detalles:</p>
                    <br>
                    <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Número de ticket:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $id . '</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Estado:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">Hecho</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Asunto:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $asunto . '</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Atendido por:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $nombreAsignado . '</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Servicio realizado:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $servicio . '</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Fecha y hora de finalización:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $fhcontestacion . '</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Comentarios finales:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $txtcontestacion . '</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Número de cliente:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $numCliente . '</td>
                    </tr>
                    <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Dispositivo:</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $dispositivo . '</td>
                    </tr>
                    </table>
                    <br>
                    <p style="text-align: center">Gracias por confiar en nuestros servicios.</p>
                    </div>
                    <div style="background: #0078e3; text-align: center; color: #fff; padding: 5px">
                    <p style="font-size: 12px;">&copy; 2024. Grupo Cardinales. All Rights Reserved.</p>
                    <p style="font-size: 12px;">Desarrollado por ATENEA</p>
                    </div>
                    </div>
                    </div>';
                    $mail->send();
                    echo "<script>alert('Ticket finalizado exitosamente y correo de finalización enviado correctamente.');</script>";
                    echo "<script>window.location.href = '../web/gestion.php';</script>";
                } catch (Exception $e) {
                    echo "<script>alert('No se pudo enviar el correo de finalización. Error: {$mail->ErrorInfo}');</script>";
                    echo "<script>window.location.href = '../web/gestion.php';</script>";
                }
            }
        }

        echo "<script>alert('Ticket atendido exitosamente.');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    } else {
        echo "<script>alert('No se pudo reasignar el ticket');</script>";
        echo "<script>window.location.href = '../web/gestion.php';</script>";
    }
} else {
    echo "<script>alert('Error en el proceso, por favor, atender este problema.');</script>";
    echo "<script>window.location.href = '../web/gestion.php';</script>";
}

$stmt->close();
$conn->close();