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

    $stmt = $mysqli->prepare("SELECT idTicket, fhticket, nombre, numCliente, dispositivo, imeiCliente, numContacto, nomContacto, placasContacto, marcaContacto, asunto, descripcion, estado, domicilio, ciudad, domestado, codpostal, domdescripcion, servicio, asignado, evidencia, evidenciaArribo, evidenciaInicio, evidenciaRealizacion, evidenciaFinalizacion, txt_contestacion, fhContestacion, fhAsignado, fhArribo, fhInicio, fhRealizacion, fhFinalizacion, fhCongelado, fhCancelado, fhProgramada FROM tbticket WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idTicket, $fhticket, $nombre, $numCliente, $dispositivo, $imeiCliente, $numContacto, $nomContacto, $placasContacto, $marcaContacto, $asunto, $descripcion, $estado, $domicilio, $ciudad, $domestado, $codpostal, $domdescripcion, $servicio, $asignado, $evidencia, $evidenciaArribo, $evidenciaInicio, $evidenciaRealizacion, $evidenciaFinalizacion, $txt_contestacion, $fhContestacion, $fhAsignado, $fhArribo, $fhInicio, $fhRealizacion, $fhFinalizacion, $fhCongelado, $fhCancelado, $fhProgramada);
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

$current_status = $estado;

$statuses = [
    1 => 'bg-blue-700', // Creado
    2 => 'bg-blue-700', // Asignado
    3 => 'bg-blue-700', // Arribo
    4 => 'bg-blue-700', // Inicio
    5 => 'bg-blue-700', // Realización
    6 => 'bg-blue-700', // Finalización
    // 7 => 'bg-blue-700', // Programado
    // 8 => 'bg-blue-700', // Congelado
    // 9 => 'bg-blue-700' // Cancelado
];

// Función para determinar la clase del estado
function getStatusClass($status, $current_status, $asignado)
{
    global $statuses;
    if ($status == 1 && $asignado != "") {
        return 'bg-blue-700'; // Asignado
    }
    return $status <= $current_status ? $statuses[$status] : 'bg-gray-200';
}

// Función para obtener la descripción del estado
function getStatusDescription($status, $asignado)
{
    switch ($status) {
        case 1: // Creado
            return "Ticket creado. Esperando asignación del ticket.";
        case 2: // Asignado
            if ($asignado == "") {
                return "No se ha asignado un técnico para atender el problema. Esperado asignación.";
            }
            return getAsignado($asignado) . " fue asignado para atender el problema. Esperando arribo del técnico.";
        case 3: // Arribo
            return "El técnico ha llegado al lugar. Esperando inicio del trabajo.";
        case 4: // Inicio
            return "El trabajo ha comenzado. Esperando evidencia de antecedentes antes de manipulación.";
        case 5: // Realización
            return "El trabajo está en proceso. Esperando evidencia de antecedestes de manipulación.";
        case 6: // Finalización
            return "El trabajo ha concluido, en espera del formulario de finalización.";
        case 7: // Programado
            return "El trabajo se ha programado para una fecha posterior.";
        case 8: // Congelado
            return "El trabajo ha sido congelado. Esperando reanudación.";
        case 9: // Cancelado
            return "El trabajo ha sido cancelado.";
    }
}

function traducirFecha($fecha)
{
    if ($fecha === null) {
        return 'Actividad pendiente de realizar';
    }

    $dia = date('d', strtotime($fecha));
    $mes = date('m', strtotime($fecha));
    $hora = date('h:i', strtotime($fecha));
    $am_pm = strtoupper(date('a', strtotime($fecha)));
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
    return $dia . ' de ' . $meses[$mes] . ' a las ' . $hora . ' ' . $am_pm . ' del ' . date('Y', strtotime($fecha));
}

function getStatus($status)
{
    switch ($status) {
        case "1":
            echo 'Creado';
            break;
        case "2":
            echo 'Asignado';
            break;
        case "3":
            echo 'Arribo';
            break;
        case "4":
            echo 'Inicio';
            break;
        case "5":
            echo 'Realización';
            break;
        case "6":
            echo 'Finalización';
            break;
        case "7":
            echo 'Programado';
            break;
        case "8":
            echo 'Congelado';
            break;
        case "9":
            echo 'Cancelado';
            break;
    }
}

function getAsignado($asignado)
{
    global $conn;

    if ($asignado == "") {
        echo 'Sin asignar';
    } else {
        $query = "SELECT nombre, apellido, credencial FROM users WHERE userId = ?";
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
                <div class="p-5 mx-auto">
                    <div class="text-medium w-full mb-6">
                        <h2 class="text-2xl font-bold mb-4 text-center md:text-left">Visualización de ticket
                            #<?php echo $idTicket; ?> -
                            <?php echo $asunto; ?>
                        </h2>
                        <p class="text-gray-600">A continuación, se verá el estado del ticket por el que pasa,
                            junto con las evidencias y comentarios. Al finalizar, por favor, confirme el servicio con
                            una firma de
                            satisfacción para la conclusión del ticket.</p>
                    </div>
                    <div class="mb-6">
                        <ol class="items-baseline sm:flex">
                            <?php foreach ($statuses as $status => $colorClass): ?>
                                <li class="relative mb-6 sm:mb-0" id="status<?= $status ?>">
                                    <div class="flex items-center">
                                        <div
                                            class="z-10 flex items-center justify-center w-6 h-6 <?= getStatusClass($status, $current_status, $asignado) ?> rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 text-white self-center" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                                            </svg>
                                        </div>
                                        <div
                                            class="hidden sm:flex w-full <?= getStatusClass($status, $current_status, $asignado) ?> h-0.5 dark:bg-gray-700">
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:pr-8">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            <?php
                                            if ($status == 1) {
                                                echo 'Creado';
                                            } else if ($status == 2) {
                                                echo 'Asignado';
                                            } else if ($status == 3) {
                                                echo 'Arribo de técnico';
                                            } else if ($status == 4) {
                                                echo 'Inicio de trabajo';
                                            } else if ($status == 5) {
                                                echo 'Realización de trabajo';
                                            } else if ($status == 6) {
                                                echo 'Finalización de trabajo';
                                            } else if ($status == 7) {
                                                echo 'Programado';
                                            } else if ($status == 8) {
                                                echo 'Congelado';
                                            } else if ($status == 9) {
                                                echo 'Cancelado';
                                            } else {
                                                echo array_search($status, array_keys($statuses));
                                            }
                                            ?>
                                        </h3>
                                        <?php if ($status == 1): ?>
                                            <time
                                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= traducirFecha($fhticket) ?></time>
                                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                <?= getStatusDescription($status, $asignado) ?>
                                            </p>
                                        <?php elseif ($status == 2): ?>
                                            <time
                                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= traducirFecha($fhAsignado) ?></time>
                                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                <?= getStatusDescription($status, $asignado) ?>
                                            </p>
                                        <?php elseif ($status == 3): ?>
                                            <time
                                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= traducirFecha($fhArribo) ?></time>
                                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                <?= getStatusDescription($status, $asignado) ?>
                                            </p>
                                        <?php elseif ($status == 4): ?>
                                            <time
                                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= traducirFecha($fhInicio) ?></time>
                                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                <?= getStatusDescription($status, $asignado) ?>
                                            </p>
                                        <?php elseif ($status == 5): ?>
                                            <time
                                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= traducirFecha($fhRealizacion) ?></time>
                                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                <?= getStatusDescription($status, $asignado) ?>
                                            </p>
                                        <?php elseif ($status == 6): ?>
                                            <time
                                                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= traducirFecha($fhFinalizacion) ?></time>
                                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                <?= getStatusDescription($status, $asignado) ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>

                    <!-- Si el ticket está asignado mostrar lo siguiente -->
                    <?php if ($asignado != ""): ?>
                        <div class="grid justify-items-center text-medium w-full mb-6 ">
                            <h2 class="text-2xl font-bold mb-2">
                                Técnico asignado
                            </h2>
                            <!-- Mostar imagen dependiendo del técnico asignado -->
                            <?php if ($asignado != NULL) { ?>
                                <img src="../../assets/imgTecnicos/<?php echo getAsignado($asignado); ?>.jpeg"
                                    alt="Imagen del técnico asignado <?php echo getAsignado($asignado); ?>"
                                    class="w-60 auto object-cover mt-4 rounded-lg" onclick="showImageEvidence(this)">
                            <?php } ?>
                        </div>
                    <?php endif; ?>

                    <div class="text-medium w-full mb-6">
                        <h2 class="text-2xl font-bold mb-2">Evidencias</h2>
                        <?php if ($evidencia == "" && $evidenciaArribo == "" && $evidenciaInicio == "" && $evidenciaRealizacion == "" && $evidenciaFinalizacion): ?>
                            <p class="mb-6 text-gray-600">Aún no se han tomado evidencias.</p>
                        <?php endif; ?>
                        <div class="grid grid-cols-2 lg:grid-cols-5 justify-center justify-items-center">
                            <div class="grid mr-3">
                                <?php if ($evidencia == ""): ?>
                                    <p class="font-medium text-base text-gray-500">Evidencia del ticket</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/no-image.png" alt="Evidencia de inicio"
                                            class="w-24 auto object-cover mt-4">
                                    </div>
                                    <p class="text-gray-600 text-xs text-center">Sin evidencia</p>
                                <?php else: ?>
                                    <p class="text-blue-600 font-semibold text-base">Evidencia del problema</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/<?php echo $evidencia; ?>"
                                            alt="Evidencia al crear ticket" class="w-24 h-24 object-cover mt-4"
                                            onclick="showImageEvidence(this)">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="grid mr-3">
                                <?php if ($evidenciaArribo == ""): ?>
                                    <p class="font-medium text-base text-gray-500">Evidencia de arribo de técnico</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/no-image.png" alt="Evidencia de inicio"
                                            class="w-24 auto object-cover mt-4">
                                    </div>
                                    <p class="text-gray-600 text-xs text-center">Esperando evidencia</p>
                                <?php else: ?>
                                    <p class="text-blue-600 font-semibold text-base mb-2">Evidencia de arribo de técnico</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/<?php echo $evidenciaArribo; ?>"
                                            alt="Evidencia de inicio" class="w-24 h-24 object-cover mt-4"
                                            onclick="showImageEvidence(this)">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="grid mr-3">
                                <?php if ($evidenciaInicio == ""): ?>
                                    <p class="font-medium text-base text-gray-500">Evidencia de inicio</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/no-image.png" alt="Evidencia de inicio"
                                            class="w-24 auto object-cover mt-4">
                                    </div>
                                    <p class="text-gray-600 text-xs text-center">Esperando evidencia</p>
                                <?php else: ?>
                                    <p class="text-blue-600 font-medium text-base">Evidencia de inicio</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/<?php echo $evidenciaInicio; ?>"
                                            alt="Evidencia de inicio" class="w-24 h-24 object-cover mt-4"
                                            onclick="showImageEvidence(this)">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="grid mr-3">
                                <?php if ($evidenciaRealizacion == ""): ?>
                                    <p class="font-medium text-base text-gray-500">Evidencia de realización</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/no-image.png" alt="Evidencia de inicio"
                                            class="w-24 auto object-cover mt-4">
                                    </div>
                                    <p class="text-gray-600 text-xs text-center">Esperando evidencia</p>
                                <?php else: ?>
                                    <p class="text-blue-600 font-medium text-base">Evidencia de realización</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/<?php echo $evidenciaRealizacion; ?>"
                                            alt="Evidencia de inicio" class="w-24 h-24 object-cover mt-4"
                                            onclick="showImageEvidence(this)">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="grid">
                                <?php if ($evidenciaFinalizacion == ""): ?>
                                    <p class="font-medium text-base text-gray-500">Evidencia de finalización</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/no-image.png" alt="Evidencia de inicio"
                                            class="w-24 auto object-cover mt-4">
                                    </div>
                                    <p class="text-gray-600 text-xs text-center">Esperando evidencia</p>
                                <?php else: ?>
                                    <p class="text-blue-600 font-medium text-base">Evidencia de finalización</p>
                                    <div class="flex justify-center items-center">
                                        <img src="../../assets/imgTickets/<?php echo $evidenciaFinalizacion; ?>"
                                            alt="Evidencia de inicio" class="w-24 h-24 object-cover mt-4"
                                            onclick="showImageEvidence(this)">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm text-center mt-8">Haz clic en la imagen para visualizar la
                            evidencia en tamaño completo.</p>
                    </div>
                    <div class="text-medium w-full mb-6">
                        <h2 class="text-2xl font-bold mb-2">Comentarios</h2>
                        <?php if ($txt_contestacion == ""): ?>
                            <p class="mb-6 text-gray-600">Aún no se han realizado comentarios.</p>
                        <?php else: ?>
                            <p class="mb-4 text-gray-900 font-medium mt-4">Comentarios del Técnico
                                <?php echo getAsignado($asignado); ?>:
                            </p>
                            <div>
                                <p class="text-blue-600"><?php echo $txt_contestacion; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="w-full mb-6">
                        <h2 class="text-2xl font-bold mb-4">Información general</h2>
                        <p class="mb-2 text-gray-900 font-medium">Servicio: <span
                                class="font-normal text-blue-600"><?php echo $servicio; ?></span></p>
                        <p class="mb-2 text-gray-900 font-medium">Servicio atendido por:
                            <?php if ($asignado == ""): ?><span class="font-normal text-blue-600">Técnico sin
                                    asignar</span><?php else: ?><span
                                    class="font-normal text-blue-600"><?php getAsignado($asignado); ?></span><?php endif; ?>
                        </p>
                        <p class="mb-2 text-gray-900 font-medium">Asunto: <span
                                class="font-normal text-blue-600"><?php echo $asunto; ?></span></p>
                        <p class="mb-2 text-gray-900 font-medium">Estado del servicio: <span
                                class="font-normal text-blue-600"><?php getStatus($current_status); ?></span></p>
                        <p class="mb-2 text-gray-900 font-medium">Dispositivo: <?php if ($dispositivo == ""): ?><span
                                    class="font-normal text-blue-600">Sin dispositivo</span><?php else: ?><span
                                    class="font-normal text-blue-600"><?php echo $dispositivo; ?></span><?php endif; ?></p>
                        <p class="mb-2 text-gray-900 font-medium">Nombre del cliente: <span
                                class="font-normal text-blue-600"><?php echo $nomContacto; ?></span></p>
                        <p class="mb-2 text-gray-900 font-medium">Número del cliente: <span
                                class="font-normal text-blue-600"><?php echo $numCliente; ?></span></p>
                        <p class="mb-2 text-gray-900 font-medium">Placas de la unidad:
                            <?php if ($placasContacto == ""): ?><span class="font-normal text-blue-600">Sin
                                    información</span><?php else: ?><span
                                    class="font-normal text-blue-600"><?php echo $placasContacto; ?></span><?php endif; ?>
                        </p>
                        <p class="mb-2 text-gray-900 font-medium">Marca de la unidad:
                            <?php if ($marcaContacto == ""): ?><span class="font-normal text-blue-600">Sin
                                    información</span><?php else: ?><span
                                    class="font-normal text-blue-600"><?php echo $marcaContacto; ?></span><?php endif; ?>
                        </p>
                        <p class="mb-2 text-gray-900 font-medium">Fecha de creación: <span
                                class="font-normal text-blue-600"><?= traducirFecha($fhticket); ?></span></p>
                        <?php if ($fhAsignado != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha de asignación: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhAsignado); ?></span></p>
                        <?php endif; ?>
                        <?php if ($fhArribo != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha de arribo: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhArribo); ?></span></p>
                        <?php endif; ?>
                        <?php if ($fhInicio != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha de inicio: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhInicio); ?></span></p>
                        <?php endif; ?>
                        <?php if ($fhRealizacion != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha de realización: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhRealizacion); ?></span></p>
                        <?php endif; ?>
                        <?php if ($fhFinalizacion != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha de finalización: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhFinalizacion); ?></span></p>
                        <?php endif; ?>
                        <?php if ($fhProgramada != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha programada: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhProgramada); ?></span></p>
                        <?php endif; ?>
                        <?php if ($fhCongelado != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha de congelación: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhCongelado); ?></span></p>
                        <?php endif; ?>
                        <?php if ($fhCancelado != NULL): ?>
                            <p class="mb-2 text-gray-900 font-medium">Fecha de cancelación: <span
                                    class="font-normal text-blue-600"><?= traducirFecha($fhCancelado); ?></span></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($current_status == "6"): ?>
                        <div class="text-center">
                            <h2 class="text-2xl font-bold mt-8">Firma de finalización</h2>
                            <p class="mt-4 text-gray-600">El trabajo del ticket a terminado. Por favor, confirme las
                                evidencias y disponga una firma para la finalización completa del ticket.</p>
                            <p class="mt-3 mb-6 text-gray-600">
                                Al solicitar nuestros servicio, usted aceptar los términos y condiciones del servicio
                                técnico, Descarga y visualice los términos en le siguiente enlace: <a target="_blank"
                                    href="../../assets/docs/terminos-y-condiciones.pdf"
                                    class="text-blue-600 hover:underline">Términos y condiciones</a>
                            </p>
                            <a href="formulario?token=<?php echo $token; ?>"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Finalizar
                                ticket</a>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include('../components/footer.php'); ?>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>
        function showImageEvidence(element) {
            var imageUrl = element.src;
            var overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
            overlay.style.display = 'flex';
            overlay.style.justifyContent = 'center';
            overlay.style.alignItems = 'center';
            overlay.style.zIndex = '9999';

            var image = document.createElement('img');
            image.src = imageUrl;
            image.style.maxWidth = '90%';
            image.style.maxHeight = '90%';

            overlay.appendChild(image);
            document.body.appendChild(overlay);

            overlay.addEventListener('click', function () {
                document.body.removeChild(overlay);
            });
        }
    </script>
</body>

</html>