<?php
session_start();

if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = uniqid();
}

if (isset($_SESSION['user'])) {
    header('Location: web/sesion.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="../manifest.json">
    <title>Mercurio | Login</title>
</head>

<style>
    .custom-shape-divider-bottom-1726768976 {
        position: relative;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        transform: rotate(180deg);
    }

    .custom-shape-divider-bottom-1726768976 svg {
        position: relative;
        display: block;
        width: auto;
        height: 180px;
        transform: rotateY(180deg);
    }

    @media (min-width: 640px) {
        .custom-shape-divider-bottom-1726768976 svg {
            width: calc(100% + 1.3px);
            position: relative;
            display: block;
            height: 180px;
            transform: rotateY(180deg);
        }
    }

    .custom-shape-divider-bottom-1726768976 .shape-fill {
        fill: rgb(28 100 242 / var(--tw-bg-opacity));
    }

    .slide-in {
        animation: slide-in 0.5s forwards;
    }

    @keyframes slide-in {
        0% {
            transform: translateY(100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<body class="bg-gray-100 overscroll-none">

    <nav
        class="bg-blue-600 dark:bg-gray-900 w-full lg:md:fixed sm:sticky z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-900">
        <div class="max-w-screen-xl items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <img class="w-40 mx-auto" src="../assets/img/logoATL_w.webp" alt="logo">
            </div>
        </div>
    </nav>

    <section class="sm:mt-16">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-[70vh] lg:py-0">
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
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Entrar</button>
                        <div class="flex justify-center py-1">
                            <a href="#" onclick="showForgotPasswordForm()"
                                class="text-gray-500 text-xs font-medium text-primary-600 hover:underline dark:text-primary-500 text-wrap">¿Olvidaste
                                tu contraseña?</a>
                        </div>
                    </form>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="border-b w-1/3 lg:w-1/4"></span>
                        <span class="text-xs text-center text-gray-500 uppercase">Ó</span>
                        <span class="border-b w-1/3 lg:w-1/4"></span>
                    </div>
                    <button
                        class="w-full text-white bg-[#468FAF] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        onclick="showRegistrationForm()">Registrarse</button>
                </div>
                <div id="recuperacion-form" style="display: none;" class="slide-in p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Recuperar contraseña
                    </h1>
                    <form action="procesos/recuperacion" method="POST" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                                electrónico</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Enviar</button>
                        <div class="flex justify-center py-1">
                            <a href="#" onclick="showLoginForm()"
                                class="text-gray-500 text-xs font-medium text-primary-600 hover:underline dark:text-primary-500 text-wrap">Volver
                                a
                                inicio de sesión</a>
                        </div>
                    </form>
                </div>
                <div id="registro-form" style="display: none;" class="slide-in p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Registro de usuario
                    </h1>
                    <form action="procesos/recuperacion" method="POST" class="space-y-4 md:space-y-6">
                        <div class="mb-2">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                                electrónico</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                            <input type="password" name="password" id="password" data-popover-target="popover-password"
                                data-popover-placement="bottom"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            <div data-popover id="popover-password" role="tooltip"
                                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Must have at least 6
                                        characters</h3>
                                    <div class="grid grid-cols-4 gap-2">
                                        <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                        <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                        <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                        <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                    </div>
                                    <p>It’s better to have:</p>
                                    <ul>
                                        <li class="flex items-center mb-1">
                                            <svg class="w-3.5 h-3.5 me-2 text-green-400 dark:text-green-500"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5.917 5.724 10.5 15 1.5" />
                                            </svg>
                                            Upper & lower case letters
                                        </li>
                                        <li class="flex items-center mb-1">
                                            <svg class="w-3 h-3 me-2.5 text-gray-300 dark:text-gray-400"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            A symbol (#$&)
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-3 h-3 me-2.5 text-gray-300 dark:text-gray-400"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            A longer password (min. 12 chars.)
                                        </li>
                                    </ul>
                                </div>
                                <div data-popper-arrow></div>
                            </div>

                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Enviar</button>
                        <div class="flex justify-center py-1">
                            <a href="#" onclick="showLoginForm()"
                                class="text-gray-500 text-xs font-medium text-primary-600 hover:underline dark:text-primary-500 text-wrap">Volver
                                a
                                inicio de sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <div class="grid grid-cols-1">
        <div class="custom-shape-divider-bottom-1726768976">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                    opacity=".25" class="shape-fill"></path>
                <path
                    d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                    opacity=".5" class="shape-fill"></path>
                <path
                    d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                    class="shape-fill"></path>
            </svg>
        </div>

        <div>
            <?php include('components/ix-footer.php'); ?>
        </div>
    </div>

    <script src="../assets/js/index.js"></script>
    <script src="../node_modules/flowbite/dist/flowbite.js"></script>
    <script async src="../loadSW.js"></script>
    <script async src="../serviceworker.js"></script>
</body>

</html>