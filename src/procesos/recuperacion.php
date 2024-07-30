<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

function generateToken()
{
    return bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'email-smtp.us-east-1.amazonaws.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'AKIA3HJXVSKBDCQSUVUK';
    $mail->Password = 'BBJq0wi3aCh0zuMhCuO2jlNTWaejJ8Mw8h7gBg8XMyRv';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('mercurio@atlantida.mx');

    $email = $_POST["email"];
    $token = generateToken();

    $mysqli = new mysqli('localhost', 'root', 'root', 'mercurio');
    if ($mysqli->connect_error) {
        die('Error de conexión: ' . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT userId FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id);
        $stmt->fetch();

        date_default_timezone_set('America/Chihuahua');

        // Fecha de expiración
        $token_expiration = date('Y-m-d H:i:s', strtotime('+50 minutes'));

        $stmt = $mysqli->prepare("UPDATE users SET token = ?, token_expiration = ? WHERE userId = ?");
        $stmt->bind_param("ssi", $token, $token_expiration, $id);
        $stmt->execute();

        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = '🔐 Restablecer contraseña';
        $mail->Body = '
            <div style="background: #1175cf;">
            <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px;">
            <div style="background: #0078e3;">
            <img src="https://grupocardinales.com/assets/img/gcLogo.png" style="display: block; margin: 0 auto; padding: 20px 0px 10px; width: 200px; height: auto" alt="Grupo Cardinales">
            </div>
            <div style="background: #fff; padding: 0 30px 0 30px;">
            <br>
            <h1 style="font-size: 24px; font-weight: 700; color: #191919">Restablecer contraseña</h1>
            <p>¡Hola estimado usuario <b>' . $email . '</b>! Hemos recibido una solicitud para restablecer tu contraseña. Cuentas con 50 minutos para realizar el cambio.</p>
            <p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
            <div style="text-align: center; margin: 15px 0 0 0;">
            <a style="display: inline-block; text-decoration: none; background-color: #0078e3; color: #ffffff; padding: 10px 20px; font-weight: 700; border-radius: 5px;" target="_blank" href="http://localhost/mercurio/src/restablecer-contrasena?token=' . $token . '">Restablecer contraseña</a>
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

        echo "<script>alert('Se ha enviado un correo electrónico con instrucciones para recuperar tu contraseña.'); document.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('El correo electrónico no se encuentra registrado. Por favor, ingrese un correo válido o inténtalo más tarde.'); document.location.href = '../index.php';</script>";
    }

    $stmt->close();
    $mysqli->close();
}