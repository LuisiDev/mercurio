<?php
include '../components/sidebar.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Mercurio | Dashboard</title>
</head>

<body>
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <div class="p-4 lg:mb-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center items-center">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Técn</h5>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <div class="grid grid-cols-3 gap-3 mb-2">
                            <dl
                                class="bg-gray-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-500 text-gray-600 dark:text-gray-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-gray-600 dark:text-gray-300 text-sm font-medium">Sin iniciar</dd>
                            </dl>
                            <dl
                                class="bg-orange-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-orange-200 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Iniciando</dd>
                            </dl>
                            <dl
                                class="bg-blue-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-blue-200 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Haciendo</dd>
                            </dl>
                            <dl
                                class="bg-green-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-green-200 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-green-600 dark:text-green-300 text-sm font-medium">Hechos</dd>
                            </dl>
                            <dl
                                class="bg-yellow-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-yellow-200 dark:bg-gray-500 text-yellow-600 dark:text-yellow-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-yellow-600 dark:text-yellow-300 text-sm font-medium">Programados</dd>
                            </dl>
                            <dl
                                class="bg-indigo-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-indigo-200 dark:bg-gray-500 text-indigo-600 dark:text-indigo-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-indigo-600 dark:text-indigo-300 text-sm font-medium">Congelados</dd>
                            </dl>
                        </div>
                        <button data-collapse-toggle="more-details" type="button"
                            class="hover:underline text-xs text-gray-500 dark:text-gray-400 font-medium inline-flex items-center">Mostrar
                            más detalles <svg class="w-2 h-2 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="more-details"
                            class="border-gray-200 border-t dark:border-gray-600 pt-3 mt-3 space-y-2 hidden">
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Promedio de tickets
                                    completados:</dt>
                                <dd
                                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                    </svg> 57%
                                </dd>
                            </dl>
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Calificación:</dt>
                                <dd
                                    class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-600 dark:text-gray-30">
                                    5 estrellas</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="py-6" id="tecnico1-chart"></div>

                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <a href="#"
                                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Ver reporte completo
                                <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center items-center">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Técn. Nombre
                            </h5>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <div class="grid grid-cols-3 gap-3 mb-2">
                            <dl
                                class="bg-gray-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-500 text-gray-600 dark:text-gray-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-gray-600 dark:text-gray-300 text-sm font-medium">Sin iniciar</dd>
                            </dl>
                            <dl
                                class="bg-orange-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-orange-200 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Iniciando</dd>
                            </dl>
                            <dl
                                class="bg-blue-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-blue-200 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Haciendo</dd>
                            </dl>
                            <dl
                                class="bg-green-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-green-200 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-green-600 dark:text-green-300 text-sm font-medium">Hechos</dd>
                            </dl>
                            <dl
                                class="bg-yellow-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-yellow-50 dark:bg-gray-500 text-yellow-600 dark:text-yellow-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-yellow-600 dark:text-yellow-300 text-sm font-medium">Programados</dd>
                            </dl>
                            <dl
                                class="bg-indigo-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-indigo-200 dark:bg-gray-500 text-indigo-600 dark:text-indigo-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-indigo-600 dark:text-indigo-300 text-sm font-medium">Congelados</dd>
                            </dl>
                        </div>
                        <button data-collapse-toggle="more-details" type="button"
                            class="hover:underline text-xs text-gray-500 dark:text-gray-400 font-medium inline-flex items-center">Mostrar
                            más detalles <svg class="w-2 h-2 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="more-details"
                            class="border-gray-200 border-t dark:border-gray-600 pt-3 mt-3 space-y-2 hidden">
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Promedio de tickets
                                    completados:</dt>
                                <dd
                                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                    </svg> 57%
                                </dd>
                            </dl>
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Calificación:</dt>
                                <dd
                                    class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-600 dark:text-gray-30">
                                    5 estrellas</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="py-6" id="tecnico2-chart"></div>

                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <a href="#"
                                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Ver reporte completo
                                <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center items-center">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Técn. Nombre
                            </h5>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <div class="grid grid-cols-3 gap-3 mb-2">
                            <dl
                                class="bg-gray-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-500 text-gray-600 dark:text-gray-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-gray-600 dark:text-gray-300 text-sm font-medium">Sin iniciar</dd>
                            </dl>
                            <dl
                                class="bg-orange-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-orange-200 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Iniciando</dd>
                            </dl>
                            <dl
                                class="bg-blue-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-blue-200 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Haciendo</dd>
                            </dl>
                            <dl
                                class="bg-green-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-green-200 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-green-600 dark:text-green-300 text-sm font-medium">Hechos</dd>
                            </dl>
                            <dl
                                class="bg-yellow-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-yellow-50 dark:bg-gray-500 text-yellow-600 dark:text-yellow-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-yellow-600 dark:text-yellow-300 text-sm font-medium">Programados</dd>
                            </dl>
                            <dl
                                class="bg-indigo-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-indigo-200 dark:bg-gray-500 text-indigo-600 dark:text-indigo-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-indigo-600 dark:text-indigo-300 text-sm font-medium">Congelados</dd>
                            </dl>
                        </div>
                        <button data-collapse-toggle="more-details" type="button"
                            class="hover:underline text-xs text-gray-500 dark:text-gray-400 font-medium inline-flex items-center">Mostrar
                            más detalles <svg class="w-2 h-2 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="more-details"
                            class="border-gray-200 border-t dark:border-gray-600 pt-3 mt-3 space-y-2 hidden">
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Promedio de tickets
                                    completados:</dt>
                                <dd
                                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                    </svg> 57%
                                </dd>
                            </dl>
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Calificación:</dt>
                                <dd
                                    class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-600 dark:text-gray-30">
                                    5 estrellas</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="py-6" id="tecnico3-chart"></div>

                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <a href="#"
                                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Ver reporte completo
                                <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center items-center">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Técn. Nombre
                            </h5>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                        <div class="grid grid-cols-3 gap-3 mb-2">
                            <dl
                                class="bg-gray-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-500 text-gray-600 dark:text-gray-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-gray-600 dark:text-gray-300 text-sm font-medium">Sin iniciar</dd>
                            </dl>
                            <dl
                                class="bg-orange-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-orange-200 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Iniciando</dd>
                            </dl>
                            <dl
                                class="bg-blue-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-blue-200 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Haciendo</dd>
                            </dl>
                            <dl
                                class="bg-green-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-green-200 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-green-600 dark:text-green-300 text-sm font-medium">Hechos</dd>
                            </dl>
                            <dl
                                class="bg-yellow-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-yellow-50 dark:bg-gray-500 text-yellow-600 dark:text-yellow-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-yellow-600 dark:text-yellow-300 text-sm font-medium">Programados</dd>
                            </dl>
                            <dl
                                class="bg-indigo-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                <dt
                                    class="w-8 h-8 rounded-full bg-indigo-200 dark:bg-gray-500 text-indigo-600 dark:text-indigo-300 text-sm font-medium flex items-center justify-center mb-1">
                                    00</dt>
                                <dd class="text-indigo-600 dark:text-indigo-300 text-sm font-medium">Congelados</dd>
                            </dl>
                        </div>
                        <button data-collapse-toggle="more-details" type="button"
                            class="hover:underline text-xs text-gray-500 dark:text-gray-400 font-medium inline-flex items-center">Mostrar
                            más detalles <svg class="w-2 h-2 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="more-details"
                            class="border-gray-200 border-t dark:border-gray-600 pt-3 mt-3 space-y-2 hidden">
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Promedio de tickets
                                    completados:</dt>
                                <dd
                                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                    </svg> 57%
                                </dd>
                            </dl>
                            <dl class="flex items-center justify-between">
                                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Calificación:</dt>
                                <dd
                                    class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-600 dark:text-gray-30">
                                    5 estrellas</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="py-6" id="tecnico4-chart"></div>

                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <a href="#"
                                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Ver reporte completo
                                <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="grid sm:grid-cols-1 lg:grid-cols-3 gap-4 mb-4">

                <div class="sm:max-w-sm lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

                    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">000</h5>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                                    generados</p>
                            </div>
                        </div>
                        <div>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                </svg>
                                00%
                            </span>
                        </div>
                    </div>
                    <div id="tickets-chart"></div>
                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <button type="button"
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                                id="dropdownDaysButton" data-dropdown-toggle="lastDaysdropdown"
                                data-dropdown-placement="bottom">
                                El día de hoy
                                <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="lastDaysdropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDaysButton">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ayer</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">El
                                            día de hoy</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Últimos
                                            7 días</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Últimos
                                            30 días</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Últimos
                                            90 días</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="sm:max-w-sm lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

                    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">000</h5>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                                    generados</p>
                            </div>
                        </div>
                        <div>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                </svg>
                                00%
                            </span>
                        </div>
                    </div>
                    <div id="tickets-eliminados-chart"></div>
                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <button type="button"
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                                id="dropdownDaysButton" data-dropdown-toggle="lastDaysdropdown"
                                data-dropdown-placement="bottom">
                                El día de hoy
                                <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="lastDaysdropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDaysButton">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ayer</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">El
                                            día de hoy</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Últimos
                                            7 días</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Últimos
                                            30 días</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Últimos
                                            90 días</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../assets/js/charts.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>