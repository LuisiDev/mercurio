<?php
session_start();
include '../configuration/connection.php';

// Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../node_modules/phpmailer/src/Exception.php';
require '../../node_modules/phpmailer/src/PHPMailer.php';
require '../../node_modules/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set("America/Chihuahua");
    $idTicket = $_POST['idTicket'];
    $fhticket = date('Y-m-d H:i:s');
    $nombre = $_SESSION['nombre'];
    $numTrabajador = $_SESSION['user'];
    $numCliente = $_POST['numCliente'];
    $dispositivo = $_POST['dispositivo'];
    $imeiCliente = $_POST['imeiCliente'];
    $fhRevision = isset($_POST['fhRevision']) ? $_POST['fhRevision'] : null;
    $numContacto = $_POST['numContacto'];
    $nomContacto = $_POST['nomContacto'];
    $placasContacto = $_POST['placasContacto'];
    $marcaContacto = $_POST['marcaContacto'];
    $prioridad = 'Pendiente';
    $asunto = $_POST['asunto'];
    $descripcion = $_POST['descripcion'];
    $estado = '1';
    $domicilio = $_POST['domicilio'];
    $ciudad = $_POST['ciudad'];
    $domestado = $_POST['domestado'];
    $codpostal = $_POST['codpostal'];
    $domdescripcion = $_POST['domdescripcion'];
    $servicio  = $_POST['servicio'];
    $correo = $_POST['correo'];
    $token = $_POST['token'];

    $directorio = "../../assets/imgTickets/";
    $archivo = isset($_FILES['imagen']['name']) ? basename($_FILES['imagen']['name']) : null;
    $rutaArchivo = $directorio . $archivo;
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

    if (isset($_FILES['imagen']) && $_FILES["imagen"]["size"] > 0) {
        if (($tipoArchivo == "jpg" || $tipoArchivo == "png" || $tipoArchivo == "jpeg" || $tipoArchivo == "webp") && $_FILES["imagen"]["size"] <= 1000000) {
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                echo "Aparecer modal de error aquí";
                var_dump($_POST);
                echo $archivo;
                echo $rutaArchivo;
            }
        } else {
            echo "Aparecer modal de error aquí";
            var_dump($_POST);
            echo $archivo;
            echo $rutaArchivo;
            echo "<br>";
            echo "move_uploaded_file: " . move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo);
        }
    } else {
        $rutaArchivo = null;
    }

    $sql = "UPDATE tbticket SET fhticket=?, nombre=?, numTrabajador=?, numCliente=?, dispositivo=?, imeiCliente=?, fhRevision=?, numContacto=?, nomContacto=?, placasContacto=?, marcaContacto=?, prioridad=?, asunto=?, descripcion=?, estado=?, domicilio=?, ciudad=?, domestado=?, codpostal=?, domdescripcion=?, servicio=?, correo=?, evidencia=? WHERE idTicket=? AND token=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssssssssi", $fhticket, $nombre, $numTrabajador, $numCliente, $dispositivo, $imeiCliente, $fhRevision, $numContacto, $nomContacto, $placasContacto, $marcaContacto, $prioridad, $asunto, $descripcion, $estado, $domicilio, $ciudad, $domestado, $codpostal, $domdescripcion, $servicio, $correo, $archivo, $idTicket, $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $idTicket = $stmt->insert_id;
        echo "<script>alert('¡Ticket editado correctamente!');</script>";
        echo "<script>window.location.href = '../web/tickets.php';</script>";

        // Envio de correo al cliente
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
            $mail->Subject = '🎫 Generación de ticket';
            $mail->Body = '
            <div style="background: #1175cf;">
            <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px;">
            <div style="background: #0078e3;">
            <img src="https://grupocardinales.com/assets/img/gcLogo.png" style="display: block; margin: 0 auto; padding: 20px 0px 10px; width: 200px; height: auto" alt="Grupo Cardinales">
            </div>
            <div style="background: #fff; padding: 0 30px 0 30px;">
            <br>
            <h1 style="font-size: 24px; font-weight: 700; color: #191919">Visualización de ticket</h1>
            <p>¡Hola estimado cliente <b>' . $nomContacto . '</b>! Hemos generado un ticket con la solicitud de tu servicio. A continuación, te mostramos los detalles:</p>
            <br>
            <table style="width: 100%; border-collapse: collapse;">
            <tr>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Número de ticket:</td>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $idTicket . '</td>
            </tr>
            <tr>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Asunto:</td>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $asunto . '</td>
            </tr>
            <tr>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Servicio a realizar:</td>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $servicio . '</td>
            </tr>
            <tr>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea; font-weight: 700; color: #535353">Fecha y hora de creación:</td>
            <td style="padding: 10px 0; border-bottom: 1px solid #eaeaea">' . $fhticket . '</td>
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
            <p>Para visualizar el ticket y dar seguimiento a tu solicitud, haz clic en el siguiente enlace:</p>
            <div style="text-align: center; margin: 15px 0 0 0;">
            <a style="display: inline-block; text-decoration: none; background-color: #0078e3; color: #ffffff; padding: 10px 20px; font-weight: 700; border-radius: 5px;" target="_blank" href="http://localhost/mercurio/src/cliente/visualizacion.php?token=' . $token . '">Visualizar ticket</a>
            </div>
            <br>
            <p style="text-align: center; color: #535353; font-size: 11px; padding: 15px 0 15px 0"> Si no solicitaste esta solicitud, por favor ignora este mensaje.</p>
            </div>
            <div style="background: #0078e3; text-align: center; color: #fff; padding: 5px">
            <p style="font-size: 12px;">&copy; 2024. Grupo Cardinales. All Rights Reserved.</p>
            <p style="font-size: 12px;">Desarrollado por ATENEA</p>
            </div>
            </div>
            </div>';
            $mail->send();
            echo "<script>alert('Correo enviado nuevamente exitosamente.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('¡No se pudo enviar el correo! Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('¡No se pudo editar el ticket!');</script>";
        var_dump($_POST);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('¡No se pudo editar el ticket! Error en el proceso: {$conn->error}');</script>";
    echo "<script>window.location.href = '../web/tickets.php';</script>";
}