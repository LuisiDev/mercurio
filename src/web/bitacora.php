<?php
include '../configuration/connection.php';
include '../components/sidebar.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <title>Mercurio | Gestión de tickets</title>
</head>

<body>
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="grid grid-cols-1 gap-4 mb-4">
                <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <caption
                            class="p-5 text-lg semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Tabla de tickets generados
                        </caption>
                        <div
                            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                            <div>
                                <button type="button" id="dropdownShowButton" data-dropdown-toggle="dropdownShow"
                                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dar:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    <span class="sr-only">Botón de mostrar</span>
                                    10
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                                <div id="dropdownShow"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownShowButton">
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">10</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">30</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">50</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">100</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <label for="table-search" class="sr-only">Buscador</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search-tickets"
                                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:boder-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Buscar ticket">
                            </div>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Usuario
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        No. de trabajador
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Fecha y hora de acceso
                                            <a href="#">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M12.832 3.445a1 1 0 0 0-1.664 0l-4 6A1 1 0 0 0 8 11h8a1 1 0 0 0 .832-1.555l-4-6Zm-1.664 17.11a1 1 0 0 0 1.664 0l4-6A1 1 0 0 0 16 13H8a1 1 0 0 0-.832 1.555l4 6Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Dispositivo
                                            <a href="#">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M12.832 3.445a1 1 0 0 0-1.664 0l-4 6A1 1 0 0 0 8 11h8a1 1 0 0 0 .832-1.555l-4-6Zm-1.664 17.11a1 1 0 0 0 1.664 0l4-6A1 1 0 0 0 16 13H8a1 1 0 0 0-.832 1.555l4 6Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            IP
                                            <a href="#">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M12.832 3.445a1 1 0 0 0-1.664 0l-4 6A1 1 0 0 0 8 11h8a1 1 0 0 0 .832-1.555l-4-6Zm-1.664 17.11a1 1 0 0 0 1.664 0l4-6A1 1 0 0 0 16 13H8a1 1 0 0 0-.832 1.555l4 6Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Usuario
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        000
                                    </td>
                                    <td class="px-6 py-4">
                                        00/00/0000 00:00:00
                                    </td>
                                    <td class="px-6 py-4">
                                        Dispositivo
                                    </td>
                                    <td class="px-6 py-4">
                                        000.000.0.000
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
                            aria-label="Navegación">
                            <span
                                class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Mostrando
                                <span class="font-semibold text-gray-900 dark:text-white">00-00</span> de <span
                                    class="font-semibold text-gray-900 dark:text-white">000</span></span>
                            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                                </li>
                                <li>
                                    <a href="#" aria-current="page"
                                        class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/redir.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>