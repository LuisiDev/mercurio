<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../node_modules/phpmailer/src/Exception.php';
require '../../node_modules/phpmailer/src/PHPMailer.php';
require '../../node_modules/phpmailer/src/SMTP.php';

function generateToken() {
    return bin2hex(random_bytes(50));
}

if (isset($_POST["send"])) {
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
        die('Connection failed: ' . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT id FROM tbticket WHERE correo = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id);
        $stmt->fetch();

        date_default_timezone_set('America/Chihuahua');

        $stmt = $mysqli->prepare("UPDATE tbticket SET token = ? WHERE id = ?");
        $stmt->bind_param("si", $token, $id);
        $stmt->execute();

        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Generación de ticket';
        $mail->Body = '
        <h3>Generación de ticket realizado</h3>
        <p>Se ha generado un ticket con éxito para su unidad. Para visualizarlo, haz clic en el siguiente enlace:
        <br>
        <a style="display: inline-block; text-decoration: none; color: #ffffff; background: #9333ea; height: 24px; font-weight: 400; padding: 12px 20px 11px; margin: 0px" target="_blank" href="http://localhost/mercurio/src/cliente/visualizacion.php?token=' . $token . '">Visualizar ticket</a>
        <br>
        </p>';
        $mail->send();

        echo "<script>alert('Correo enviado exitosamente.');</script>";
    } else {
        echo "<script>alert('Test')</script>";
    }
}