<?php
session_start();
include '../configuration/connection.php';

// Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

function generateToken()
{
    return bin2hex(random_bytes(50));
}

function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function logEmail($user, $date, $process, $ip)
{
    $logFile = '../../src/procesos/correos-log.json';
    $logData = [];

    if (file_exists($logFile)) {
        $logData = json_decode(file_get_contents($logFile), true);
    }

    $logData[] = [
        'user' => $user,
        'date' => $date,
        'process' => $process,
        'ip' => $ip
    ];

    file_put_contents($logFile, json_encode($logData, JSON_PRETTY_PRINT));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set("America/Mexico_City");
    $fhticket = date('Y-m-d H:i:s');
    $nombre = $_SESSION['nombre'];
    $numTrabajador = $_SESSION['userId'];
    $numCliente = $_POST['numCliente'];
    $dispositivo = $_POST['dispositivo'];
    $imeiCliente = $_POST['imeiCliente'];
    $iccidSIM = $_POST['iccidSIM'];
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
    $servicio = $_POST['servicio'];
    $correo = $_POST['correo'];
    $token = generateToken();

    $directorio = "../../assets/imgTickets/";
    $archivo = isset($_FILES['imagen']['name']) ? basename($_FILES['imagen']['name']) : null;
    $rutaArchivo = $directorio . $archivo;
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

    if (isset($_FILES['imagen']) && $_FILES["imagen"]["size"] > 0) {
        if (($tipoArchivo == "jpg" || $tipoArchivo == "png" || $tipoArchivo == "jpeg" || $tipoArchivo == "webp") && $_FILES["imagen"]["size"] <= 1000000) {
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                echo "<script>alert('¡La imagen se subio correctamente!');</script>";
                echo "<script>window.location.href = '../web/usuarios.php';</script>";
            }
        } else {
            echo "<script>alert('¡El archivo no es una imagen o excede el tamaño permitido!');</script>";
            echo "<script>window.location.href = '../web/usuarios.php';</script>";
        }
    } else {
        $rutaArchivo = null;
    }

    $sql = "INSERT INTO tbticket (fhticket, nombre, numTrabajador, numCliente, dispositivo, imeiCliente, iccidSIM, fhRevision, numContacto, nomContacto, placasContacto, marcaContacto, prioridad, asunto, descripcion, estado, domicilio, ciudad, domestado, codpostal, domdescripcion, servicio, correo, evidencia, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssssssss", $fhticket, $nombre, $numTrabajador, $numCliente, $dispositivo, $imeiCliente, $iccidSIM, $fhRevision, $numContacto, $nomContacto, $placasContacto, $marcaContacto, $prioridad, $asunto, $descripcion, $estado, $domicilio, $ciudad, $domestado, $codpostal, $domdescripcion, $servicio, $correo, $archivo, $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $idTicket = $stmt->insert_id;
        $_SESSION['ticket_created'] = true;
        echo "<script>alert('¡Ticket creado correctamente!');</script>";
        echo "<script>window.location.href = '../web/tickets.php';</script>";

        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pedravi.avi@gmail.com';
            $mail->Password = 'mkgjgzonblojlctp';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('pedravi.avi@gmail.com');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = '🎫 Generación de ticket';
            $mail->Body = '
            <div style="background: #1175cf;">
            <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px;">
            <div style="background: #0078e3;">
            <img src="https://atlantida.mx/assets/img/GPLogos/LOGO%20AT.png" style="display: block; margin: 0 auto; padding: 10px 0px 10px; width: 180px; height: auto" alt="ATLANTIDA">
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
            <a style="display: inline-block; text-decoration: none; background-color: #0078e3; color: #ffffff; padding: 10px 20px; font-weight: 700; border-radius: 5px;" target="_blank" href="http://localhost/mercurio/src/cliente/visualizacion?token=' . $token . '">Visualizar ticket</a>
            </div>
            <br>
            <p style="text-align: center; color: #535353; font-size: 11px; padding: 15px 0 15px 0"> Si no solicitaste esta solicitud, por favor ignora este mensaje.</p>
            </div>
            <div style="background: #0078e3; text-align: center; color: #fff; padding: 5px">
            <p style="font-size: 12px;">&copy; 2025. ATLANTIDA, miembro de Grupo Cardinales. All Rights Reserved.</p>
            <p style="font-size: 12px;">Desarrollado por ATENEA</p>
            </div>
            </div>
            </div>';
            $mail->send();
            echo "<script>alert('Correo enviado exitosamente.');</script>";

            // Log email details
            logEmail($nombre, $fhticket, 'Generacion de ticket', getUserIP());

        } catch (Exception $e) {
            echo "<script>alert('¡No se pudo enviar el correo! Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('¡No se pudo crear el ticket!');</script>";
    }

    $stmt->close();
    $conn->close();

} else {
    echo "<script>alert('¡No se pudo crear el ticket!');</script>";
    echo "<script>window.location.href = '../web/tickets.php';</script>";
}