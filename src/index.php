<?php
session_start();

if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = uniqid();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
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
        class="bg-blue-700 dark:bg-gray-900 w-full lg:md:fixed sm:sticky z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-900">
        <div class="max-w-screen-xl items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <img class="h-auto max-w-lg mx-auto" src="../assets/img/logoATL_w.webp" alt="logo">
            </div>
        </div>
    </nav>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="slide-in w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div id="login-form" class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Iniciar Sesión
                    </h1>
                    <form action="procesos/login" method="POST" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="user"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                            <input type="text" name="user" id="user"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="remember" aria-describedby="remember"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Recordar
                                        contraseña</label>
                                </div>
                            </div>
                            <div class="flex items-end">
                                <a href="#" onclick="showForgotPasswordForm()"
                                    class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500 text-wrap">¿Olvidaste
                                    tu contraseña?</a>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Entrar</button>
                    </form>
                    <!-- <div class="mt-4 flex items-center justify-between">
                        <span class="border-b w-1/3 lg:w-1/4"></span>
                        <span class="text-xs text-center text-gray-500 uppercase">Ó</span>
                        <span class="border-b w-1/3 lg:w-1/4"></span>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-[#468FAF] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Registrarse</button> -->
                </div>
                <div id="recuperacion-form" style="display: none;" class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Recuperar contraseña
                    </h1>
                    <form action="procesos/recuperacion" method="POST" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo electrónico</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="flex items-start">
                            <a href="#" onclick="showLoginForm()"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500 text-wrap">Iniciar sesión</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../assets/js/index.js"></script>
    <script src="../node_modules/flowbite/dist/flowbite.js"></script>
</body>

</html>