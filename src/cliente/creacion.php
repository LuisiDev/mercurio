<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Mercurio | Creación de ticket</title>
</head>

<nav class="bg-blue-700 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="inicio.php" class="flex items-center space-x-3 rtl:space-x-reverse mx-auto">
            <img src="../../assets/img/logoATL_w.webp" alt="Logo ATLANTIDA">
        </a>
    </div>
</nav>

<body class="bg-gray-50 dark:bg-gray-700 overscroll-none">
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <div class="md:flex p-6">
        <ul
            class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
            <li>
                <input id="tab-ticket-1" type="radio" name="list-ticket" value="" class="hidden peer" checked>
                <label for="tab-ticket-1"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 peer-checked:bg-blue-700 peer-checked:text-gray-50 hover:bg-gray-100 border border-gray-200 peer-checked:border-none w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-4 h-4 me-2 peer-checked:text-gray-50 hover:peer-checked:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 2 22 22">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                    Términos y condiciones
                </label>
            </li>
            <li>
                <input id="tab-ticket-2" type="radio" name="list-ticket" value="" class="hidden peer">
                <label for="tab-ticket-2"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 peer-checked:bg-blue-700 peer-checked:text-gray-50 hover:bg-gray-100 border border-gray-200 peer-checked:border-none w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-4 h-4 me-2 peer-checked:text-gray-50 hover:peer-checked:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                            clip-rule="evenodd" />
                    </svg>
                    Datos del usuario
                </label>
            </li>
            <li>
                <input id="tab-ticket-3" type="radio" name="list-ticket" value="" class="hidden peer">
                <label for="tab-ticket-3"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 peer-checked:bg-blue-700 peer-checked:text-gray-50 hover:bg-gray-100 border border-gray-200 peer-checked:border-none w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-4 h-4 me-2 peer-checked:text-gray-50 hover:peer-checked:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.356 3.066a1 1 0 0 0-.712 0l-7 2.666A1 1 0 0 0 4 6.68a17.695 17.695 0 0 0 2.022 7.98 17.405 17.405 0 0 0 5.403 6.158 1 1 0 0 0 1.15 0 17.406 17.406 0 0 0 5.402-6.157A17.694 17.694 0 0 0 20 6.68a1 1 0 0 0-.644-.949l-7-2.666Z" />
                    </svg>
                    Datos del problema
                </label>
            </li>
            <!-- <li>
                <input id="tab-ticket-4" type="radio" name="list-ticket" value="" class="hidden peer">
                <label for="tab-ticket-4"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 peer-checked:bg-blue-700 peer-checked:text-gray-50 hover:bg-gray-100 border border-gray-200 peer-checked:border-none w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-4 h-4 me-2 peer-checked:text-gray-50 hover:peer-checked:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 0 0-2 2v9a1 1 0 0 0 1 1h.535a3.5 3.5 0 1 0 6.93 0h3.07a3.5 3.5 0 1 0 6.93 0H21a1 1 0 0 0 1-1v-4a.999.999 0 0 0-.106-.447l-2-4A1 1 0 0 0 19 6h-5a2 2 0 0 0-2-2H4Zm14.192 11.59.016.02a1.5 1.5 0 1 1-.016-.021Zm-10 0 .016.02a1.5 1.5 0 1 1-.016-.021Zm5.806-5.572v-2.02h4.396l1 2.02h-5.396Z"
                            clip-rule="evenodd" />
                    </svg>
                    Datos de la unidad
                </label>
            </li> -->
            <li>
                <input id="tab-ticket-4" type="radio" name="list-ticket" value="" class="hidden peer">
                <label for="tab-ticket-4"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 peer-checked:bg-blue-700 peer-checked:text-gray-50 hover:bg-gray-100 border border-gray-200 peer-checked:border-none w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-4 h-4 me-2 peer-checked:text-gray-50 hover:peer-checked:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.356 3.066a1 1 0 0 0-.712 0l-7 2.666A1 1 0 0 0 4 6.68a17.695 17.695 0 0 0 2.022 7.98 17.405 17.405 0 0 0 5.403 6.158 1 1 0 0 0 1.15 0 17.406 17.406 0 0 0 5.402-6.157A17.694 17.694 0 0 0 20 6.68a1 1 0 0 0-.644-.949l-7-2.666Z" />
                    </svg>
                    Ubicación
                </label>
            </li>
            <li>
                <input id="tab-ticket-5" type="radio" name="list-ticket" value="" class="hidden peer">
                <label for="tab-ticket-5"
                    class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 peer-checked:bg-blue-700 peer-checked:text-gray-50 hover:bg-gray-100 border border-gray-200 peer-checked:border-none w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-4 h-4 me-2 peer-checked:text-gray-50 hover:peer-checked:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                            clip-rule="evenodd" />
                    </svg>
                    Verificación
                </label>
            </li>
        </ul>

        <div id="tab-ticket-1-content"
            class="p-6 bg-gray-50 border border-gray-200 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full grid grid-cols-1 tab-content content-between">
            <div class="">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Términos y condiciones</h3>
                <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu rutrum mauris, at
                    euismod leo. Pellentesque pretium pellentesque ipsum, blandit tincidunt mauris luctus eget. Proin eu
                    lacus laoreet est pellentesque consequat nec vel nisl. Morbi lacinia vehicula efficitur. Duis
                    dignissim
                    lacus id tincidunt viverra. Ut accumsan, nisl ac scelerisque convallis, ipsum ante condimentum
                    massa,
                    nec efficitur sem purus quis tortor. Integer nec massa quis est blandit sagittis non vitae eros.
                    Proin
                    at egestas ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                    egestas. Sed pulvinar nunc quis metus pellentesque convallis. Pellentesque id turpis quis metus
                    tincidunt rhoncus. Fusce sollicitudin nulla eu quam interdum, id mollis dui pharetra. Pellentesque
                    maximus dolor malesuada lectus volutpat, lobortis facilisis est euismod. Aliquam mollis lacus nec
                    tellus
                    faucibus, eu dignissim sem rhoncus.</p>
            </div>
            <div>
                <div class="flex items-center mb-6">
                    <input id="link-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">He
                        leído y acepto los <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">términos
                            y
                            condiciones</a>.</label>
                </div>
                <button id="next-button"
                    class="w-auto bg-gray-300 text-gray-500 cursor-not-allowed focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    disabled>Siguiente</button>
            </div>
        </div>

        <div id="tab-ticket-2-content"
            class="p-6 bg-gray-50 border border-gray-200 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full grid grid-cols-1 hidden tab-content content-between">
            <div class="">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5">Datos del usuario</h3>
                <form action="" class="grid grid-cols-2 gap-x-8">
                    <div class="mb-5">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre(s)*</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nombre completo" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos*</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Apellidos" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la
                            empresa</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Empresa (Opcional)" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="numCliente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                            de
                            cliente*</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Número de cliente" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="numCliente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                            de teléfono</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Número de teléfono (Opcional)" required>
                        </div>
                    </div>
                    <div class="mb-8">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                            electrónico*</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Correo de electrónico" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex space-x-4">
                <button id="prev-button"
                    class="w-auto bg-gray-100 text-gray-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Anterior</button>
                <button id="next-button"
                    class="w-auto bg-gray-300 text-gray-500 cursor-not-allowed focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    disabled>Siguiente</button>
            </div>
        </div>

        <div id="tab-ticket-3-content"
            class="p-6 bg-gray-50 border border-gray-200 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full grid grid-cols-1 hidden tab-content content-between">
            <div class="">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5">Datos del problema</h3>
                <form action="" class="grid grid-cols-2 gap-x-8">
                    <div class="mb-5 col-span-2">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asunto*</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nombre completo" required>
                        </div>
                    </div>
                    <div class="mb-5 col-span-2">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción*</label>
                        <textarea id="descripcion" name="descripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Descripción del ticket..."></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de paquete</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Empresa (Opcional)" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dispositivo</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Número de cliente" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ESN/IMEI del
                            dispositivo</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Número de teléfono (Opcional)" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="evidencia"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir
                            evidencia</label>
                        <input type="file" id="evidencia" name="imagen"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            onchange="loadFile(event)" accept=".jpeg, .jpg, .png, .webp"
                            aria-describedby="evidencia_creado">
                        <div id="evidencia_creado" class="mt-1 text-sm text-gray-500 dark:text-gray-300">Solamente
                            se aceptan archivos JPEG, JPG y PNG de menos de 3 MB</div>
                    </div>
                    <h3 class="text-md font-bold text-gray-900 dark:text-white mb-5 col-span-2">Unidad</h3>
                    <div class="mb-8">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Placas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Correo de electrónico" required>
                        </div>
                    </div>
                    <div class="mb-8">
                        <label for="numCliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca/Modelo</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="numCliente" name="numCliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Correo de electrónico" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex space-x-4">
                <button id="prev-button"
                    class="w-auto bg-gray-100 text-gray-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Anterior</button>
                <button id="next-button"
                    class="w-auto bg-gray-300 text-gray-500 cursor-not-allowed focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    disabled>Siguiente</button>
            </div>
        </div>

        <div id="tab-ticket-4-content"
            class="p-6 bg-gray-50 border border-gray-200 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full grid grid-cols-1 hidden tab-content content-between">
            <div class="">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5">Ubicación de encuentro</h3>
                <form action="" class="grid grid-cols-2 gap-x-8">
                    <div class="mb-5 col-span-2">
                        <div id="map" class="w-full h-1/4 rounded-lg hidden"></div>
                    </div>
                    <div class="mb-5 col-span-2 block justify-center items-center">
                        <label for="showMe" id="labelShowMe"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buscar
                            ubicación</label>
                        <button type="button" id="showMe"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Buscar ubicación
                        </button>
                        <div id="btnLabel" class="mt-1 text-sm text-gray-500 dark:text-gray-300">Puedes localizar la
                            ubicación a través de Maps al presionar el botón</div>
                    </div>
                    <div class="mb-5 flex justify-center items-center col-span-2">
                        <div id="locationList" class="block max-w-md font-normal text-gray-700 dark:text-gray-400">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domicilio o URL de
                            ubicación</label>
                        <div class="relative flex">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="address" name="domicilio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Domicilio de encuentro o url de la ubicación">
                            <button class="ml-2" data-tooltip-target="tooltip-animation" type="button">
                                <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="tooltip-animation" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 w-4/12 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <p class="mb-2">Puedes ingresar un domicilio o una URL de ubicación para facilitar
                                    el
                                    encuentro, como se encuentra en la imagen representativa.</p>
                                <img src="../../assets/img/Tooltip1.gif" alt="Imagen de ayuda">
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="locality"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="locality" name="ciudad"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Ciudad de encuentro">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="postal_code"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código
                            postal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="postal_code" name="codpostal"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Código postal de encuentro">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="state"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="state" name="domestado"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Estado de encuentro">
                        </div>
                    </div>
                    <div class="mb-8 col-span-2">
                        <label for="domdescripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción del
                            lugar</label>
                        <textarea id="domdescripcion" name="domdescripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Descripción del ticket..."></textarea>
                    </div>
                </form>
            </div>
            <div class="flex space-x-4">
                <button id="prev-button"
                    class="w-auto bg-gray-100 text-gray-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Anterior</button>
                <button id="next-button"
                    class="w-auto bg-gray-300 text-gray-500 cursor-not-allowed focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    disabled>Siguiente</button>
            </div>
        </div>

        <div id="tab-ticket-5-content"
            class="p-6 bg-gray-50 border border-gray-200 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full grid grid-cols-1 hidden tab-content content-between">
            <div class="">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Verificación de datos</h3>
                <p class="mb-4">Por favor verifica que los datos ingresados sean correctos antes de enviar el
                    ticket.</p>
                <div>
                    <div class="flex items-center mb-2">
                        <span class="text-sm font-medium text-gray-900 dark:text-white mr-2">Nombre completo:</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Prueba de texto</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Correo electrónico</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                    </div>
                </div>
                <div>
                    <div class="flex items-center mb-6">
                        <input id="link-checkbox" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">He
                            leído y acepto los <a href="#"
                                class="text-blue-600 dark:text-blue-500 hover:underline">términos
                                y
                                condiciones</a>.</label>
                    </div>
                    <button id="next-button"
                        class="w-auto bg-gray-300 text-gray-500 cursor-not-allowed focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        disabled>Siguiente</button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const radioButtons = document.querySelectorAll('input[name="list-ticket"]');
                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function () {
                        document.querySelectorAll('.tab-content').forEach(content => {
                            content.classList.add('hidden');
                        });
                        const selectedContent = document.getElementById(`${this.id}-content`);
                        if (selectedContent) {
                            selectedContent.classList.remove('hidden');
                        }
                    });
                });
            });
        </script>

        <script>
            const checkbox = document.getElementById('link-checkbox');
            const nextButton = document.getElementById('next-button');

            checkbox.addEventListener('change', function () {
                nextButton.disabled = !this.checked;
                if (this.checked) {
                    nextButton.classList.remove('bg-gray-300');
                    nextButton.classList.remove('cursor-not-allowed');
                    nextButton.classList.add('bg-blue-700');
                    nextButton.classList.add('text-white');
                } else {
                    nextButton.classList.remove('bg-blue-700');
                    nextButton.classList.remove('text-white');
                    nextButton.classList.add('bg-gray-300');
                    nextButton.classList.add('cursor-not-allowed');
                }
            });
        </script>
        <script src="../../assets/js/materialize.js"></script>
        <script async src="../../assets/js/showLocation.js"></script>
        <script async src="../../assets/js/location.js"></script>
        <script src="../../assets/js/jquery.js"></script>
        <!-- <script src="../procesos/proceso_ticket.js"></script> -->
        <!-- <script src="../../assets/js/script.js"></script> -->
        <script src="../../assets/js/redir.js"></script>
        <script src="../../assets/js/nuevo.js"></script>
        <script src="../../node_modules/flowbite/dist/datepicker.js"></script>
        <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>