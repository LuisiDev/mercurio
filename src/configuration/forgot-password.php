<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../node_modules/phpmailer/src/Exception.php';
require '../../node_modules/phpmailer/src/PHPMailer.php';
require '../../node_modules/phpmailer/src/SMTP.php';

function generateToken() {
    return bin2hex(random_bytes(50));
}

if(isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pedravi.avi@gmai.com';
    $mail->Password = 'ngzhuxmqqdcfikmc';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('pedravi.avi@gmail.com');

    $email = $_POST["email"];
    $token = generateToken();

    $mysqli = new mysqli('localhost', 'root', 'root', 'mercurio');
    if($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id);
        $stmt->fetch();

        date_default_timezone_set('America/Chihuahua');

        $token_expiration = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $stmt = $mysqli->prepare("UPDATE users SET token = ?, token_expiration = ? WHERE id = ?");
        $stmt->bind_param("ssi", $token, $token_expiration, $id);
        $stmt->execute();

        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body = '
        Para recuperar tu contraseña, haz clic en el siguiente enlace: 
        <a href="http://localhost:8080/src/configuration/reset-password.php?token=' . $token . '" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Recuperar contraseña
        </a>';

        $mail->send();

        echo "<script>alert('El correo se ha enviado');</script>";
    } else {
        echo "<script>alert('El correo no existe');</script>";
    }

    $stmt->close();
    $mysqli->close();
}