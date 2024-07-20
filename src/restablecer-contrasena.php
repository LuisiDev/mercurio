<?php
session_start();
date_default_timezone_set('America/Chihuahua');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $mysqli = new mysqli('localhost', 'root', 'root', 'mercurio');
    if ($mysqli->connect_error) {
        die('Error de conexión: ' . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT userId, token_expiration FROM users WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $token_expiration);
        $stmt->fetch();

        $current_time = time();
        $expiration_time = strtotime($token_expiration);

        if ($current_time <= $expiration_time) {
            $_SESSION['reset_token'] = $token;
        } else {
            $_SESSION['error_message'] = 'El token ha expirado';
            header('Location: enlace-expirado');
            exit();
        }

    } else {
        $_SESSION['error_message'] = 'Token inválido';
        header('Location: enlace-invalido');
        exit();
    }

    $stmt->close();
    $mysqli->close();

} else {
    $_SESSION['error_message'] = 'Token no proporcionado';
    header('Location: enlace-invalido');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <title>Mercurio | Login</title>
</head>

<body>

    <style>
        .slide-in {
            animation: slide-in 0.5s forwards;
        }

        @keyframes slide-in {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    <nav
        class="bg-[#487790] dark:bg-gray-900 w-full lg:md:fixed sm:sticky z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-900">
        <div class="max-w-screen-xl items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <img class="h-auto max-w-lg mx-auto" src="../assets/img/logoATL_w.webp" alt="logo">
            </div>
        </div>
    </nav>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="slide-in w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div id="login-form" class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Restablecer contraseña
                    </h1>
                    <form action="procesos/restablecer-contrasena.php" method="POST" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="newPassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva
                                contraseña</label>
                            <input type="password" name="newPassword" id="newPassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="confirmPassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar
                                contraseña</label>
                            <input type="password" name="confirmPassword" id="confirmPassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <a href="index"
                                    class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500 text-wrap">Iniciar
                                    sesión</a>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-[#468FAF] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Entrar</button>
                    </form>
                    <!-- <div class="mt-4 flex items-center justify-between">
                        <span class="border-b w-1/3 lg:w-1/4"></span>
                        <span class="text-xs text-center text-gray-500 uppercase">Ó</span>
                        <span class="border-b w-1/3 lg:w-1/4"></span>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-[#468FAF] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Registrarse</button> -->
                </div>
            </div>
        </div>
    </section>

    <script src="../assets/js/index.js"></script>
    <script src="../node_modules/flowbite/dist/flowbite.js"></script>
</body>

</html>