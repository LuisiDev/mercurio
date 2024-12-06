<?php
include '../../configuration/connection.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../output.css">
    <title>Ticket no encontrado | Mercurio</title>
</head>

<body class="bg-gray-100 overscroll-none">

    <nav class="bg-blue-700 fixed w-full z-20 top-0 start-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse mx-auto">
                <img class="w-40" src="../../../assets/img/logoATL_w.webp" alt="Logo ATLANTIDA">
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-40 flex flex-col items-center justify-center">
        <img src="../../../assets/img/invalido.png" class="mb-8" alt="Invalido">
        <h1 class="text-3xl font-bold mb-4 text-center">El <span
                class="text-transparent bg-clip-text bg-gradient-to-r to-blue-600 from-sky-400">enlace</span> se ingreso
            erróneamente o el <span
                class="text-transparent bg-clip-text bg-gradient-to-r to-blue-600 from-sky-400">ticket</span> ha
            finalizado.</h1>
        <h3 class="text-lg text-center">Por favor, verifica que el enlace sea correcto o solicita uno nuevo.</h3>
        <div class="mt-4">
            <button onclick="location.href='../inicio'"
                class="mt-4 bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-5 rounded-full">Volver</button>
        </div>
    </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>