<?php
session_start();
include '../configuration/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['idTicket'] ?? null;
    $servCalificacion = $_POST['servCalificacion'] ?? null;
    $servSatisEvi = $_POST['servSatisEvi'] ?? null;
    $servProbEfec = $_POST['servProbEfec'] ?? null;
    $servProbEfecMotivo = $_POST['servProbEfecMotivo'] ?? null;
    $servSatisSistVis = $_POST['servSatisSistVis'] ?? null;
    $tecnAtencion = $_POST['tecnAtencion'] ?? null;
    $tecnComentario = $_POST['tecnComentario'] ?? null;
    $prodSatis = $_POST['prodSatis'] ?? null;
    $prodUso = $_POST['prodUso'] ?? null;
    $prodUsoFrec = $_POST['prodUsoFrec'] ?? null;
    $prodCaract = $_POST['prodCaract'] ?? null;
    $empSent = $_POST['empSent'] ?? null;
    $empMejExp = $_POST['empMejExp'] ?? null;
    $empComp = $_POST['empComp'] ?? null;
    $empPalabra = $_POST['empPalabra'] ?? null;
    $firma = $_POST['firma'];
    $comentario = $_POST['comentario'] ?? null;
    $token = $_POST['token'];

    if ($firma) {
        $firma = str_replace('data:image/png;base64,', '', $firma);
        $firma = str_replace(' ', '+', $firma);
        $data = base64_decode($firma);
        $directory = '../../assets/imgFirmas/';
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $filename = uniqid() . '.png';
        $file = $directory . $filename;
        file_put_contents($file, $data);
        $firma = $filename; // Guardar solo el nombre del archivo en la base de datos
    }
    $sql = "INSERT INTO formsatisfaccion (idTicket, servCalificacion, servSatisEvi, servProbEfec, servProbEfecMotivo, servSatisSistVis, tecnAtencion, tecnComentario, prodSatis, prodUso, prodUsoFrec, prodCaract, empSent, empMejExp, empComp, empPalabra, firma, comentario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isssssssssssssssss', $id, $servCalificacion, $servSatisEvi, $servProbEfec, $servProbEfecMotivo, $servSatisSistVis, $tecnAtencion, $tecnComentario, $prodSatis, $prodUso, $prodUsoFrec, $prodCaract, $empSent, $empMejExp, $empComp, $empPalabra, $firma, $comentario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $token = $_POST['token'];
        if ($token) {
            $deleteTokenSql = "UPDATE tbticket SET token = NULL WHERE token = ?";
            $deleteTokenStmt = $conn->prepare($deleteTokenSql);
            $deleteTokenStmt->bind_param('s', $token);
            $deleteTokenStmt->execute();
            if ($deleteTokenStmt->affected_rows > 0) {
                echo "<script>alert('Token eliminado correctamente');</script>";
            } else {
                echo "<script>alert('No se pudo eliminar el token');</script>";
            }
        } else {
            echo "<script>alert('No se encontró el token');</script>";
        }

        // $correoSql = "SELECT correo FROM tbticket WHERE idTicket = ?";
        // $correoStmt = $conn->prepare($correoSql);
        // $correoStmt->bind_param('i', $id);
        // $correoStmt->execute();
        // $correoResult = $correoStmt->get_result();
        // $correoRow = $correoResult->fetch_assoc();
        // $correo = $correoRow['correo'] ?? null;

        // if ($correo) {
        //     $mail = new PHPMailer(true);
        //     try {
        //         $mail->CharSet = 'UTF-8';
        //         $mail->isSMTP();
        //         $mail->Host = 'email-smtp.us-east-1.amazonaws.com';
        //         $mail->SMTPAuth = true;
        //         $mail->Username = 'AKIA3HJXVSKBDCQSUVUK';
        //         $mail->Password = 'BBJq0wi3aCh0zuMhCuO2jlNTWaejJ8Mw8h7gBg8XMyRv';
        //         $mail->SMTPSecure = 'tls';
        //         $mail->Port = 587;
        //         $mail->setFrom('mercurio@atlantida.mx');
        //         $mail->addAddress($correo);
        //         $mail->isHTML(true);
        //         $mail->Subject = '🎫 Formulario contestado correctamente';
        //         $mail->Body = '
        //         <div style="background: #1175cf;">
        //         <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px;">
        //         <div style="background: #0078e3;">
        //         <img src="https://grupocardinales.com/assets/img/gcLogo.png" style="display: block; margin: 0 auto; padding: 20px 0px 10px; width: 200px; height: auto" alt="Grupo Cardinales">
        //         </div>
        //         <div style="background: #fff; padding: 0 30px 0 30px;">
        //         <br>
        //         <h1 style="font-size: 24px; font-weight: 700; color: #191919">Visualización de ticket</h1>
        //         <p>¡Hola estimado cliente <b>' . $nomContacto . '</b>! Hemos generado un ticket con la solicitud de tu servicio. A continuación, te mostramos los detalles:</p>
        //         <br>
        //         <table style="width: 100%; border-collapse: collapse;">
        //         <tr>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Número de ticket:</td>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $idTicket . '</td>
        //         </tr>
        //         <tr>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Asunto:</td>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $asunto . '</td>
        //         </tr>
        //         <tr>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Servicio a realizar:</td>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $servicio . '</td>
        //         </tr>
        //         <tr>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Fecha y hora de creación:</td>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $fhticket . '</td>
        //         </tr>
        //         <tr>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Número de cliente:</td>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $numCliente . '</td>
        //         </tr>
        //         <tr>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Dispositivo:</td>
        //         <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $dispositivo . '</td>
        //         </tr>
        //         </table>
        //         <br>
        //         <p>Para visualizar el ticket y dar seguimiento a tu solicitud, haz clic en el siguiente enlace:</p>
        //         <div style="text-align: center; margin: 15px 0 0 0;">
        //         <a style="display: inline-block; text-decoration: none; background-color: #0078e3; color: #ffffff; padding: 10px 20px; font-weight: 700; border-radius: 5px;" target="_blank" href="http://localhost/mercurio/src/cliente/visualizacion?token=' . $token . '">Visualizar ticket</a>
        //         </div>
        //         <br>
        //         <p style="text-align: center; color: #535353; font-size: 11px; padding: 15px 0 15px 0"> Si no solicitaste esta solicitud, por favor ignora este mensaje.</p>
        //         </div>
        //         <div style="background: #0078e3; text-align: center; color: #fff; padding: 5px">
        //         <p style="font-size: 12px;">&copy; 2024. Grupo Cardinales. All Rights Reserved.</p>
        //         <p style="font-size: 12px;">Desarrollado por ATENEA</p>
        //         </div>
        //         </div>
        //         </div>';
        //         $mail->send();
        //     } catch (Exception $e) {
        //         echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        //     }
        // }

        echo "<script>alert('Calificación enviada correctamente');</script>";
        echo "<script>window.location.href = '../cliente/gracias-por-contestar.php';</script>";
    } else {
        echo "<script>alert('No se pudo enviar la calificación');</script>";
        echo "<script>window.history.back();</script>";
    }
}