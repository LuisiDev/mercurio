<?php
session_start();
include '../configuration/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    $token = $_SESSION["reset_token"];

    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Las contraseñas no coinciden');</script>";
        echo "<script>history.back();</script>";
    } else {
        $stmt = $conn->prepare("SELECT userId FROM users WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); //o usar SHA1($newPassword)
            $stmt = $conn->prepare("UPDATE users SET password = ?, token = NULL, token_expiration = NULL WHERE token = ?");
            $stmt->bind_param("ss", $hashedPassword, $token);
            if ($stmt->execute()) {
                echo "<script>alert('Contraseña restablecida correctamente');</script>";
                echo "<script>window.location.href = '../index';</script>";

            } else {
                echo "<script>alert('No se pudo restablecer la contraseña.');</script>";
                echo "<script>history.back();</script>";
            }
        } else {
            echo "<script>alert('Token inválido');</script>";
            echo "<script>window.location.href = '../enlace-invalido';</script>";
        }
    }
}