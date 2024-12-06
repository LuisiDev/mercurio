<?php
session_start();
include '../configuration/connection.php';
date_default_timezone_set('America/Chihuahua');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $mysqli = new mysqli('localhost', 'root', 'root', 'mercurio');
    if ($mysqli->connect_error) {
        die('Error de conexión: ' . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT idTicket, fhticket, nombre, numCliente, dispositivo, imeiCliente, numContacto, nomContacto, placasContacto, marcaContacto, asunto, descripcion, estado, domicilio, ciudad, domestado, codpostal, domdescripcion, servicio, asignado, evidencia, evidenciaAbierto, evidenciaHaciendo, evidenciaHecho, txt_contestacion, fh_contestacion, fh_programada FROM tbticket WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idTicket, $fhticket, $nombre, $numCliente, $dispositivo, $imeiCliente, $numContacto, $nomContacto, $placasContacto, $marcaContacto, $asunto, $descripcion, $estado, $domicilio, $ciudad, $domestado, $codpostal, $domdescripcion, $servicio, $asignado, $evidencia, $evidenciaAbierto, $evidenciaHaciendo, $evidenciaHecho, $txt_contestacion, $fh_contestacion, $fh_programada);
        $stmt->fetch();
    } else {
        $_SESSION['error_message'] = 'Token inválido';
        header('Location: ./error/expirado');
        exit();
    }

    $stmt->close();
    $mysqli->close();

} else {
    $_SESSION['error_message'] = 'Token no proporcionado';
    header('Location: ./error/no-valido');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Mercurio | Formulario de finalización</title>
    <style>
        .star {
            color: #d1d5db;
            cursor: pointer;
        }

        .star:hover,
        .star.hover,
        .star.selected {
            color: #fde047;
        }
    </style>
</head>

<body class="bg-gray-100 overscroll-none">

    <nav class="bg-blue-600 fixed w-full z-20 top-0 start-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse mx-auto">
                <img class="w-40" src="../../assets/img/logoATL_w.webp" alt="Logo ATLANTIDA">
            </a>
        </div>
    </nav>

    <div class="p-4">
        <div class="lg:pt-4">
            <div class="w-full bg-white border border-gray-200 rounded-lg shadow sm:p-8 mt-16">

                <form id="ratingForm" action="../procesos/form-calificacion.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="idTicket" value="<?php echo $idTicket ?>">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                    <div class="p-5">
                        <div class="flex mb-3">
                            <svg class="w-6 h-6 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m15 19-7-7 7-7" />
                            </svg>
                            <a href="../cliente/visualizacion?token=<?php echo $token; ?>"
                                class="text-blue-500 hover:underline">Regresar a la visualización del ticket</a>
                        </div>
                        <div class="w-4/5 lg:w-1/2 mx-auto mb-6">
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold mb-3 text-center">Formulario de finalización de servicio:
                                </h2>
                                <h2 class="text-2xl font-bold mb-6 text-center">Ticket #<?php echo $idTicket; ?> -
                                    <?php echo $asunto; ?>
                                </h2>
                                <hr class="my-6 border-blue-500">
                                <p class="text-gray-600 text-center">Nos ayudarías a mejorar respondiendo el formulario
                                    de
                                    finalización
                                    del servicio. Recuerda que este formulario es opcional, pero nos ayudarías mucho con
                                    tus
                                    respuestas para seguir mejorando.</p>
                            </div>

                            <div>
                                <div class="mb-6">
                                    <h3 class="text-xl font-semibold">Servicio</h3>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Cómo calificaría el servicio que se le dió?</p>
                                    </div>
                                    <div class="star-container">
                                        <div class="flex items-center">
                                            <button type="button" class="text-gray-300 star" data-value="1">
                                                <svg class="w-8 h-8" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="2">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="3">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="4">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="5">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <input type="hidden" name="servCalificacion" id="servCalificacion" value="">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Qué tan satisfecho se encuentra con las evidencias?
                                        </p>
                                    </div>
                                    <div class="star-container">
                                        <div class="flex items-center">
                                            <button type="button" class="text-gray-300 star" data-value="1">
                                                <svg class="w-8 h-8" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="2">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="3">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="4">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="5">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <input type="hidden" name="servSatisEvi" id="servSatisEvi" value="">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Se encuentra en acuerdo o en desacuerdo con que tu
                                            problema fue resuelto efectivamente?</p>
                                    </div>
                                    <div>
                                        <div class="flex items-center mb-4">
                                            <input id="probAcuerdo" name="servProbEfec" type="radio" value="1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                            <label for="probAcuerdo" class="ms-2 text-sm font-medium text-gray-900">En
                                                acuerdo</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="probDesacuerdo" name="servProbEfec" type="radio" value="2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                            <label for="probDesacuerdo"
                                                class="ms-2 text-sm font-medium text-gray-900">En
                                                desacuerdo</label>
                                        </div>
                                        <div class="my-4">
                                            <label for="message"
                                                class="block mb-2 text-sm font-medium text-gray-900">Explique el motivo
                                                <span class="text-gray-500">(Opcional)</span></label>
                                            <textarea id="message" name="servProbEfecMotivo" rows="4"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Motivos..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Qué tan satisfecho se encuentra con el sistema de
                                            visualización?</p>
                                    </div>
                                    <div class="star-container">
                                        <div class="flex items-center">
                                            <button type="button" class="text-gray-300 star" data-value="1">
                                                <svg class="w-8 h-8" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="2">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="3">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="4">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="5">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <input type="hidden" name="servSatisSistVis" id="servSatisSistVis" value="">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="my-6">
                                    <h3 class="text-xl font-semibold">Técnico</h3>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Cómo fue la atención que recibió de parte del técnico?
                                        </p>
                                    </div>
                                    <div class="star-container">
                                        <div class="flex items-center">
                                            <button type="button" class="text-gray-300 star" data-value="1">
                                                <svg class="w-8 h-8" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="2">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="3">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="4">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="5">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <input type="hidden" name="tecnAtencion" id="tecnAtencion" value="">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Tiene algún comentario sobre el técnico que dió el
                                            servicio?</p>
                                    </div>
                                    <div>
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900">Comentarios
                                            <span class="text-gray-500">(Opcional)</span></label>
                                        <textarea id="message" name="tecnComentario" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Comentarios..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="my-6">
                                    <h3 class="text-xl font-semibold">Producto</h3>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Qué tan satisfecho se encuentra con el producto?</p>
                                    </div>
                                    <div class="star-container">
                                        <div class="flex items-center">
                                            <button type="button" class="text-gray-300 star" data-value="1">
                                                <svg class="w-8 h-8" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="2">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="3">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="4">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-300 star" data-value="5">
                                                <svg class="w-8 h-8 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <input type="hidden" name="prodSatis" id="prodSatis" value="">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Cuánto tiempo lleva usando el producto? <span
                                                class="text-sm font-medium text-gray-500">(Opcional)</span></p>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="prod" type="radio" value="1" name="prodUso"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="prod" class="ms-2 text-sm font-medium text-gray-900">Recién lo
                                            adquirí</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="prod" type="radio" value="2" name="prodUso"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="prod" class="ms-2 text-sm font-medium text-gray-900">Menos de 1
                                            año</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="prod" type="radio" value="3" name="prodUso"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="prod" class="ms-2 text-sm font-medium text-gray-900">De 1 a 2
                                            años</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="prod" type="radio" value="4" name="prodUso"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="prod" class="ms-2 text-sm font-medium text-gray-900">De 2 a 4
                                            años</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="prod" type="radio" value="5" name="prodUso"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="prod" class="ms-2 text-sm font-medium text-gray-900">Más de 5
                                            años</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Con qué frecuencia utilizas el producto o servicio?
                                            <span class="text-sm font-medium text-gray-500">(Opcional)</span>
                                        </p>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="frec" type="radio" value="1" name="prodUsoFrec"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="frec" class="ms-2 text-sm font-medium text-gray-900">Recién lo
                                            utilizo</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="frec" type="radio" value="2" name="prodUsoFrec"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="frec" class="ms-2 text-sm font-medium text-gray-900">Menos de 1
                                            año</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="frec" type="radio" value="3" name="prodUsoFrec"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="frec" class="ms-2 text-sm font-medium text-gray-900">De 1 a 2
                                            años</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="frec" type="radio" value="4" name="prodUsoFrec"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="frec" class="ms-2 text-sm font-medium text-gray-900">De 2 a 4
                                            años</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="frec" type="radio" value="5" name="prodUsoFrec"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="frec" class="ms-2 text-sm font-medium text-gray-900">Más de 5
                                            años</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">Si hubiera una característica nueva que puedieras
                                            sugerir,
                                            ¿cuál sería y por qué?</p>
                                    </div>
                                    <div>
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900">Comentarios
                                            <span class="text-gray-500">(Opcional)</span></label>
                                        <textarea id="message" rows="4" name="prodCaract"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Comentarios..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="my-6">
                                    <h3 class="text-xl font-semibold">Empresa</h3>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">En tus propias palabras, describe cómo te sientes
                                            acerca de
                                            ATLÁNTIDA</p>
                                    </div>
                                    <div>
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900">Comentarios
                                            <span class="text-gray-500">(Opcional)</span></label>
                                        <textarea id="message" rows="4" name="empSent"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Comentarios..."></textarea>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Cómo podemos mejorar tu experiencia?</p>
                                    </div>
                                    <div>
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900">Comentarios
                                            <span class="text-gray-500">(Opcional)</span></label>
                                        <textarea id="message" rows="4" name="empMejExp"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Comentarios..."></textarea>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Por qué elegiste nuestro producto sobre el de la
                                            competencia?</p>
                                    </div>
                                    <div>
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900">Comentarios
                                            <span class="text-gray-500">(Opcional)</span></label>
                                        <textarea id="message" rows="4" name="empComp"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Comentarios..."></textarea>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-medium w-full mb-2">
                                        <p class="text-gray-600">¿Cuál sería una palabra que usarias para describirnos y
                                            por
                                            qué?</p>
                                    </div>
                                    <div>
                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900">Comentarios
                                            <span class="text-gray-500">(Opcional)</span></label>
                                        <textarea id="message" rows="4" name="empPalabra"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Comentarios..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col items-center m-[5px] pt-4">
                                <div class="text-medium font-medium w-full text-center">
                                    <p class="text-gray-900">Firma de confirmación de servicio</p>
                                </div>
                                <canvas id="draw-canvas" width="500" height="300"
                                    class="border border-dashed border-gray-400 rounded-md cursor-crosshair my-5">
                                    Tu navegador no soporta canvas
                                </canvas>
                            </div>
                            <div class="flex justify-center mb-4">
                                <input type="button"
                                    class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700"
                                    id="draw-submitBtn" value="Generar firma" required>
                                <div class="p-2"></div>
                                <input type="button"
                                    class="btn btn-danger px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700"
                                    id="draw-clearBtn" value="Borrar firma">
                            </div>
                            <div class="hidden">
                                <textarea id="draw-dataUrl" name="firma" class="form-control"
                                    rows="5">Token de imagen</textarea>
                            </div>
                            <div class="flex justify-center">
                                <img id="draw-image" class="hidden border border-gray-400">
                            </div>

                            <div class="my-10">
                                <div class="text-medium w-full mb-2">
                                    <p class="text-gray-600">¿Tienes algún comentario para nosotros?</p>
                                </div>
                                <div>
                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900">Comentarios
                                        <span class="text-gray-500">(Opcional)</span></label>
                                    <textarea id="message" rows="4" name="comentario"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Comentarios..."></textarea>
                                </div>
                            </div>

                            <button type="button" onclick="reload()"
                                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Limpiar
                                registro</button>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar
                                ticket</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <footer class="bg-blue-600 dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="#" class="flex items-center mb-1">
                        <img src="../../assets/img/logoATL_w.webp" class="h-10 me-3" alt="Grupo Cardinales logo" />
                    </a>
                    <p class="text-gray-200 text-sm ml-2 font-medium">
                        Miembro de <span class="">Grupo Cardinales</span>
                    </p>
                    <p class="text-gray-200 text-md flex ml-2 mt-5 font-medium">
                        <svg class="w-6 h-6 mx-2 text-gray-100 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z" />
                        </svg>
                        +52 314 33 53 786
                    </p>
                    <p class="text-gray-200 text-md ml-2 flex mt-2 font-medium">
                        <svg class="w-6 h-6 mx-2 text-gray-100 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z" />
                            <path
                                d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z" />
                        </svg>
                        contacto@atlantida.mx
                    </p>
                    <p class="text-gray-200 text-md ml-2 flex mt-2 w-4/5 font-medium">
                        <svg class="w-6 h-6 mx-2 text-gray-100 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        Calle Don Antonio Suárez Gutiérrez, Fondeport, 28219, Manzanillo,
                        Colima.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-4">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">
                            Recursos
                        </h2>
                        <ul class="text-gray-200 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="hover:underline">Servicios</a>
                            </li>
                            <li class="mb-4">
                                <a href="https://tailwindcss.com/" class="hover:underline">Plataformas</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Documentación</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">
                            Plataformas
                        </h2>
                        <ul class="text-gray-200 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline">ATL
                                    Integral</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">ATL MAX</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">
                            Ayuda
                        </h2>
                        <ul class="text-gray-200 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="politica-de-privacidad" class="hover:underline">Política de privacidad</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terminos y condiciones</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">
                            Plataformas
                        </h2>
                        <ul class="text-gray-200 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Web</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Android</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">iOS</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-50 sm:text-center dark:text-gray-400">© 2024
                    <a href="https://flowbite.com/" class="hover:underline">ATLANTIDA™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <!-- <p class="">Redes sociales</p> -->
                    <a href="#" class="text-gray-50 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-50 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Instagram page</span>
                    </a>
                    <a href="#" class="text-gray-50 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.51 8.796v1.697a3.738 3.738 0 0 1 3.288-1.684c3.455 0 4.202 2.16 4.202 4.97V19.5h-3.2v-5.072c0-1.21-.244-2.766-2.128-2.766-1.827 0-2.139 1.317-2.139 2.676V19.5h-3.19V8.796h3.168ZM7.2 6.106a1.61 1.61 0 0 1-.988 1.483 1.595 1.595 0 0 1-1.743-.348A1.607 1.607 0 0 1 5.6 4.5a1.601 1.601 0 0 1 1.6 1.606Z"
                                clip-rule="evenodd" />
                            <path d="M7.2 8.809H4V19.5h3.2V8.809Z" />
                        </svg>
                        <span class="sr-only">LinkedIn page</span>
                    </a>
                    <a href="#" class="text-gray-50 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">YouTube page</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const starContainers = document.querySelectorAll('.star-container');

            starContainers.forEach(container => {
                const stars = container.querySelectorAll('.star');
                let selectedRating = 0;

                stars.forEach(star => {
                    star.addEventListener('mouseover', function () {
                        resetStars(container);
                        highlightStars(container, this.getAttribute('data-value'));
                    });

                    star.addEventListener('mouseout', function () {
                        resetStars(container);
                        if (selectedRating > 0) {
                            highlightStars(container, selectedRating);
                        }
                    });

                    star.addEventListener('click', function () {
                        selectedRating = this.getAttribute('data-value');
                        resetStars(container);
                        highlightStars(container, selectedRating);
                        stars.forEach(star => {
                            if (star.getAttribute('data-value') <= selectedRating) {
                                star.classList.add('selected');
                            }
                        });
                        container.querySelector('input[type="hidden"]').value = selectedRating;
                    });
                });

                function resetStars(container) {
                    const stars = container.querySelectorAll('.star');
                    stars.forEach(star => {
                        star.classList.remove('hover', 'selected');
                    });
                }

                function highlightStars(container, rating) {
                    const stars = container.querySelectorAll('.star');
                    stars.forEach(star => {
                        if (star.getAttribute('data-value') <= rating) {
                            star.classList.add('hover');
                        }
                    });
                }
            });
        });
    </script>
    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/js/redir.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>