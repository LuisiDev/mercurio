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
        header('Location: ../error/no-valido');
        exit();
    }

    $stmt->close();
    $mysqli->close();

} else {
    $_SESSION['error_message'] = 'Token no proporcionado';
    header('Location: ../error/no-valido');
    exit();
}

function traducirFecha($fhticket)
{
    $dia = date('d', strtotime($fhticket));
    $mes = date('m', strtotime($fhticket));
    $hora = date('h:i', strtotime($fhticket));
    $am_pm = strtoupper(date('a', strtotime($fhticket)));
    $meses = array(
        '01' => 'Ene',
        '02' => 'Feb',
        '03' => 'Mar',
        '04' => 'Abr',
        '05' => 'May',
        '06' => 'Jun',
        '07' => 'Jul',
        '08' => 'Ago',
        '09' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dic'
    );
    return $dia . ' de ' . $meses[$mes] . ' a las ' . $hora . ' ' . $am_pm . ' del ' . date('Y', strtotime($fhticket));
}

function getAsignado($asignado)
{
    global $conn;

    if ($asignado == "") {
        echo 'Sin asignar';
    } else {
        $query = "SELECT nombre, apellido FROM users WHERE userId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $asignado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['nombre'];
            // echo $row['nombre'] . ' ' . $row['apellido'];
        } else {
            echo 'Técnico no encontrado';
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Mercurio | Visualización de ticket</title>
</head>

<nav class="bg-blue-700 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse mx-auto">
            <img src="../../assets/img/logoATL_w.webp" alt="Logo ATLANTIDA">
        </a>
    </div>
</nav>

<body class="bg-gray-100">
    <div class="p-4">
        <div class="lg:pt-4">
            <div class="w-full bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                <div class="p-5 mx-auto">
                    <div class="text-medium w-full mb-6">
                        <h2 class="text-2xl font-bold mb-2">Visualización de ticket #<?php echo $idTicket; ?> -
                            <?php echo $asunto; ?>
                        </h2>
                        <p class="text-gray-600">A continuación, se verá el estado del ticket por el que pasa,
                            junto con las evidencias y comentarios. Al finalizar, por favor, contesta el formulario de
                            satisfacción para la conclusión del ticket.</p>
                    </div>
                    <div class="mb-6">
                        <ol class="items-center sm:flex">
                            <li class="relative mb-6 sm:mb-0">
                                <div class="flex items-center">
                                    <div
                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                                        </svg>
                                    </div>
                                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                </div>
                                <div class="mt-3 sm:pe-8">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Generado</h3>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo traducirFecha($fhticket); ?></time>
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ticket
                                        creado.
                                        Esperando asignación del ticket.</p>
                                </div>
                            </li>
                            <li class="relative mb-6 sm:mb-0">
                                <div class="flex items-center">
                                    <div
                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                </div>
                                <div class="mt-3 sm:pe-8">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Asignado</h3>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo traducirFecha($fh_contestacion); ?></time>
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ticket
                                        asignado.
                                        Ticket asignado a <?php getAsignado($asignado); ?>, esperando inicio de trabajo.
                                    </p>
                                </div>
                            </li>
                            <li class="relative mb-6 sm:mb-0">
                                <div class="flex items-center">
                                    <div
                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                </div>
                                <div class="mt-3 sm:pe-8">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Inicio de
                                        trabajo
                                    </h3>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo traducirFecha($fh_contestacion); ?></time>
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Trabajo en
                                        inicio.
                                        El técnico llego a la unidad y se encuentra revisando la unidad de
                                        trabajo.</p>
                                </div>
                            </li>
                            <li class="relative mb-6 sm:mb-0">
                                <div class="flex items-center">
                                    <div
                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M12.356 3.066a1 1 0 0 0-.712 0l-7 2.666A1 1 0 0 0 4 6.68a17.695 17.695 0 0 0 2.022 7.98 17.405 17.405 0 0 0 5.403 6.158 1 1 0 0 0 1.15 0 17.406 17.406 0 0 0 5.402-6.157A17.694 17.694 0 0 0 20 6.68a1 1 0 0 0-.644-.949l-7-2.666Z" />
                                        </svg>
                                    </div>
                                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                </div>
                                <div class="mt-3 sm:pe-8">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Realizando
                                        trabajo
                                    </h3>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo traducirFecha($fh_contestacion); ?></time>
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Trabajo en
                                        proceso. El técnico se encuentra realizando el trabajo.</p>
                                </div>
                            </li>
                            <li class="relative mb-6 sm:mb-0">
                                <div class="flex items-center">
                                    <div
                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M11.644 3.066a1 1 0 0 1 .712 0l7 2.666A1 1 0 0 1 20 6.68a17.694 17.694 0 0 1-2.023 7.98 17.406 17.406 0 0 1-5.402 6.158 1 1 0 0 1-1.15 0 17.405 17.405 0 0 1-5.403-6.157A17.695 17.695 0 0 1 4 6.68a1 1 0 0 1 .644-.949l7-2.666Zm4.014 7.187a1 1 0 0 0-1.316-1.506l-3.296 2.884-.839-.838a1 1 0 0 0-1.414 1.414l1.5 1.5a1 1 0 0 0 1.366.046l4-3.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                </div>
                                <div class="mt-3 sm:pe-8">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Trabajo
                                        finalizado
                                    </h3>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo traducirFecha($fh_contestacion); ?></time>
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">El trabajo
                                        a
                                        concluido, en espera del formulario de finalización.</p>
                                </div>
                            </li>
                        </ol>
                    </div>
                    <div class="text-medium w-full mb-6">
                        <h2 class="text-2xl font-bold mb-2">Evidencias</h2>
                        <p class="mb-6 text-gray-600">Aún no se han tomado evidencias.</p>
                        <div class="flex justify-center space-x-4">
                            <div class="justify-items-center">
                                <p class="font-semibold text-base mb-2">Evidencia al crear ticket</p>
                                <img src="../../assets/imgTickets/<?php echo $evidencia; ?>"
                                    alt="Evidencia al crear ticket" class="w-24 h-24 object-cover mb-4">
                            </div>
                            <div>
                                <p class="font-semibold text-base mb-2">Evidencia de inicio</p>
                                <img src="../../assets/imgTickets/<?php echo $evidenciaAbierto; ?>"
                                    alt="Evidencia de inicio" class="w-24 h-24 object-cover mb-4">
                            </div>
                            <div>
                                <p class="font-semibold text-base mb-2">Evidencia de realizando</p>
                                <img src="../../assets/imgTickets/<?php echo $evidenciaHaciendo; ?>"
                                    alt="Evidencia de realizando" class="w-24 h-24 object-cover mb-4">
                            </div>
                            <div>
                                <p class="font-semibold text-base mb-2">Evidencia de finalización</p>
                                <img src="../../assets/imgTickets/<?php echo $evidenciaHecho; ?>"
                                    alt="Evidencia de finalización" class="w-24 h-24 object-cover mb-4">
                            </div>
                        </div>
                    </div>
                    <div class="text-medium w-full mb-6">
                        <h2 class="text-2xl font-bold mb-2">Comentarios</h2>
                        <p class="mb-6 text-gray-600">Comentarios realizados al ticket</p>
                        <div>
                            <p class="text-gray-600"><?php echo $txt_contestacion; ?></p>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-2">Formulario de finalización</h2>
                        <p class="mb-6 text-gray-600">El trabajo del ticket a terminado. Por favor, contesta el
                            formulario de finalización para la finalización completa.</p>
                        <a href="formulario.php?token=<?php echo $token; ?>"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Contestar
                            formulario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-blue-600">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <span class="block text-sm text-white sm:text-center">© 2024 <a href="https://flowbite.com/"
                    class="hover:underline">ATLÁNTIDA™</a>. All Rights Reserved.</span>
        </div>
    </footer>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>