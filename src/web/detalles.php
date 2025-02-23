<?php
include '../configuration/conn-session.php';

if (isset($_GET['id'])) {
    $idTicket = $_GET['id'];
    $estadoActual = isset($_GET['estado']) ? $_GET['estado'] : null;

    $query = "SELECT * FROM tbticket WHERE idTicket = '$idTicket'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "<script>alert('No se encontró el ticket');</script>";
        echo "<script>window.location.href = 'gestion.php';</script>";
    }
} else {
    echo "<script>alert('No se encontró el ticket');</script>";
    echo "<script>window.location.href = 'gestion.php';</script>";
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
        case "0":
            echo 'Eliminado';
            break;
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
            echo 'Programado';
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
        $query = "SELECT nombre, apellido FROM users WHERE userId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $asignado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['nombre'] . ' ' . $row['apellido'];
        } else {
            echo 'Técnico no encontrado';
        }

        $stmt->close();
    }
}
?>
<?php include '../components/modal-baja-ticket-detalles.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./loading.css">
    <script src="./js/loading.js"></script>
    <title>Detalles | Mercurio</title>
</head>

<body class="bg-gray-50 dark:bg-gray-700">

    <div id="loading-screen">
        <div class="pulse">
            <svg width="80" height="100" viewBox="0 0 280 306" fill="none" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="280" height="306" fill="url(#pattern0_1586_11)" />
                <defs>
                    <pattern id="pattern0_1586_11" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_1586_11" transform="scale(0.00357143 0.00326797)" />
                    </pattern>
                    <image id="image0_1586_11" width="280" height="306"
                        xlink:href="data:image/png;base64,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" />
                </defs>
            </svg>
        </div>
        <div class="loading-texts mt-96">
            <span class="text-sm font-medium active">ATLANTIDA®, Mucho más que solo rastreo</span>
            <span class="text-sm font-medium">Estamos cargando todo para ti, por favor espera</span>
            <span class="text-sm font-medium">Bienvenido a ATLANTIDA</span>
        </div>
    </div>

    <?php include '../components/sidebar.php'; ?>

    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <div class="p-4 mt-16 sm:mt-0 lg:mb-4 sm:ml-64">
        <div class="p-4">
            <div class="grid grid-cols-1 gap-4 mb-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="gestion"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Gestionar tickets
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <button onclick="returnBack()"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Detalles</button>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <button onclick="reload()"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Ticket
                                    #<?php echo $row['idTicket'] ?></button>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

                    <div class="text-xl mb-6">
                        <strong class="semi-bold text-gray-900 md:text-xl dark:text-gray-100">Información del ticket
                            #<?php echo $row['idTicket'] ?> - <?php echo $row['asunto'] ?></strong>
                    </div>
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del cliente</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Número del cliente:
                            </span><?php echo $row['numCliente']; ?></p>

                        <?php if (!empty($row['dispositivo'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Dispositivo:
                                </span><?php echo $row['dispositivo']; ?></p>
                        <?php } ?>

                        <?php if (!empty($row['imeiCliente'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">IMEI:
                                </span><?php echo $row['imeiCliente']; ?></p>
                        <?php } ?>

                        <?php if (!empty($row['fhRevision'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha de revisión:
                                </span><?php echo traducirFecha($row['fhRevision']); ?></p>
                        <?php } ?>

                        <?php if (!empty($row['nomContacto'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Nombre del contacto:
                                </span><?php echo $row['nomContacto'] ?></p>
                        <?php } ?>

                        <?php if (!empty($row['numContacto'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Número del contacto:
                                </span>
                                <a href="tel:<?php echo $row['numContacto'] ?>"
                                    class="text-blue-500 hover:underline hover:text-blue-600"><?php echo $row['numContacto'] ?></a>
                            </p>
                        <?php } ?>
                    </div>
                    <?php if (!empty($row['placasContacto']) || !empty($row['marcaContacto'])) { ?>
                        <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del vehiculo</span>
                    <?php } ?>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                        <?php if (!empty($row['placasContacto'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Placas:
                                </span><?php echo $row['placasContacto']; ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($row['marcaContacto'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Marca/modelo:
                                </span><?php echo $row['marcaContacto']; ?></p>
                        <?php } ?>
                    </div>
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del ticket</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha del ticket:
                            </span><?php echo traducirFecha($row['fhticket']); ?></p>
                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Asunto:
                            </span><?php echo $row['asunto']; ?></p>
                        <?php if (!empty($row['descripcion'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Problema:
                                </span><?php echo $row['descripcion']; ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($row['servicio'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Servicio:
                                </span><?php echo $row['servicio']; ?></p>
                        <?php } ?>
                        <?php if (!empty($row['estado'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Estado:
                                </span><?php getStatus($row['estado']); ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($row['domicilio'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Domicilio:
                                </span><?php echo (strpos($row['domicilio'], 'http') === 0) ? '<a class="text-blue-500 hover:underline hover:text-blue-600 break-all" href="' . $row['domicilio'] . '" target="_blank">' . $row['domicilio'] . '</a>' : $row['domicilio']; ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($row['ciudad']) && !empty($row['domestado'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Ciudad y Estado:
                                </span><?php echo $row['ciudad']; ?>, <?php echo $row['domestado']; ?></p>
                        <?php } ?>
                        <?php if (!empty($row['codpostal'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Código Postal:
                                </span><?php echo $row['codpostal']; ?></p>
                        <?php } ?>
                    </div>
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Actividad del ticket</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Creado por:
                            </span><?php echo $row['nombre']; ?></p>
                        <?php // Si fue editado, mostrar el nombre del editor
                        if (!empty($row['editado'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Editado por:
                                </span><?php echo $row['editado']; ?></p>
                        <?php } ?>
                        <?php if (!empty($row['asignado'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Atendido por:
                                </span><?php getAsignado($row['asignado']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['eliminadopor'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Eliminado por:
                                </span><?php echo $row['eliminadopor']; ?></p>
                        <?php } ?>
                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Creado:
                            </span><?php echo traducirFecha($row['fhticket']); ?></p>
                        <?php if (!empty($row['fhAsignado'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Asignación:
                                </span><?php echo traducirFecha($row['fhAsignado']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['fhAsignado'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Arribo:
                                </span><?php echo traducirFecha($row['fhArribo']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['fhInicio'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Inicio:
                                </span><?php echo traducirFecha($row['fhInicio']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['fhRealizacion'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Realización:
                                </span><?php echo traducirFecha($row['fhRealizacion']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['fhFinalizacion'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Finalización:
                                </span><?php echo traducirFecha($row['fhFinalizacion']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['fhProgramada'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Programado:
                                </span><?php echo traducirFecha($row['fhProgramada']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['fhCongelado'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Congelado:
                                </span><?php echo traducirFecha($row['fhCongelado']); ?></p>
                        <?php } ?>
                        <?php if (!empty($row['fhEliminacion'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Eliminado:
                                </span><?php echo traducirFecha($row['fhEliminacion']); ?></p>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Motivo de Eliminación:
                                </span><?php echo $row['motivo_eliminacion']; ?></p>
                        <?php } ?>
                    </div>
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Evidencias</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                        <?php if (empty($row['evidencia']) && empty($row['evidenciaArribo']) && empty($row['evidenciaInicio']) && empty($row['evidenciaRealizacion']) && empty($row['evidenciaFinalizacion'])): ?>
                            <p>No se han adjuntado evidencias</p>
                        <?php else: ?>
                            <div class="flex justify-start space-x-6 text-center">
                                <div>
                                    <?php if (!empty($row['evidencia'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia inicial:</span>
                                        </p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidencia']); ?>"
                                                alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaArribo'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia de
                                                arribo:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaArribo']); ?>"
                                                alt="Evidencia arribo" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaInicio'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia de
                                                inicio:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaInicio']); ?>"
                                                alt="Evidencia inicio" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaRealizacion'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia de
                                                realización:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaRealizacion']); ?>"
                                                alt="Evidencia realización" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaFinalizacion'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia de
                                                finalización:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaFinalizacion']); ?>"
                                                alt="Evidencia finalización" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (in_array($row['estado'], [1, 2, 3, 4, 5, 7, 8, 9])): ?>
                        <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Trazado del ticket</span>
                        <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                            <a href="../cliente/visualizacion?token=<?php echo $row['token']; ?>" target="_blank"
                                class="text-blue-600 hover:text-blue-800">Ver trazado del ticket</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($row['estado'] == 0 || $row['estado'] == 6): ?>
                        <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del formulario de
                            finalización</span>
                        <div class="mb-6 text-base text-gray-500 dark:text-gray-300">
                            <?php if (!empty($row['token'])): ?>
                                <p>No se a contestado el formulario de finalización, por favor, contestar el formulario.
                                    Link:</p>
                                <a href="../cliente/visualizacion?token=<?= htmlspecialchars($row['token']); ?>"
                                    class="text-blue-600 hover:text-blue-800">Contestar formulario</a>
                            <?php else: ?>
                                <?php
                                $idTicket = $row['idTicket'];
                                $queryForm = "SELECT idForm FROM formsatisfaccion WHERE idTicket = ?";
                                $stmt = $conn->prepare($queryForm);
                                $stmt->bind_param("i", $idTicket);
                                $stmt->execute();
                                $resultForm = $stmt->get_result();
                                if ($resultForm && $resultForm->num_rows > 0) {
                                    $formData = $resultForm->fetch_assoc();
                                    $formId = $formData['idForm'];
                                    ?>
                                    <p>Contestado completamente. <a
                                            href="resultado-de-encuesta?id=<?= htmlspecialchars($formId); ?>"
                                            class="text-blue-600 hover:text-blue-800">Ver
                                            resultados</a>.</p>
                                <?php } ?>
                            <?php endif; ?>
                        <?php endif; ?>


                        <div class="block md:flex">
                            <?php
                            // Si es usuario administrador y coordinador, con estado del ticket 1, 2, 3, 4, 5, 7, 8 y asignado este vacio, mostrar el botón de asignar
                            if ($tipo == 'admin' || $tipo == 'coordinador') {
                                if (in_array($row['estado'], [1, 2, 3, 4, 5, 7, 8]) && empty($row['asignado'])) {
                                    ?>
                                    <div class="relative">
                                        <div class="mt-1 md:mt-6 mx-1">
                                            <button type="button" onclick="assignTicket(<?php echo $row['idTicket']; ?>)"
                                                class="px-3 py-2 mb-2 text-sm font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                                                    <path fill-rule="evenodd"
                                                        d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Asignar
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            if (($tipo == 'admin' || $tipo == 'coordinador') && in_array($row['estado'], [1, 2, 3, 4, 5, 7, 8, 9]) && !empty($row['asignado'])) {
                                ?>
                                <div class="relative">
                                    <div class="mt-1 md:mt-6 mx-1">
                                        <button type="button" onclick="attendTicket(<?php echo $row['idTicket']; ?>)"
                                            class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2">
                                            <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Atender</button>
                                    </div>
                                </div>
                                <?php
                            } elseif ($tipo == 'tecnico' && in_array($row['estado'], [1, 2, 3, 4, 5, 7, 8]) && !empty($row['asignado']) && $row['asignado'] == $userId) {
                                ?>
                                <div class="relative">
                                    <div class="mt-1 md:mt-6 mx-1">
                                        <button type="button" onclick="attendTicket(<?php echo $row['idTicket']; ?>)"
                                            class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-green-500 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mb-2">
                                            <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Atender</button>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            // Si es usuario administrador, con estado del ticket 1, 2, 3, 4, 5, 7, 8 mostrar el botón de editar
                            if ($tipo == 'admin') {
                                if (in_array($row['estado'], [1, 2, 3, 4, 5, 7, 8])) {
                                    ?>
                                    <div class="relative">
                                        <div class="mt-1 md:mt-6 mx-1">
                                            <button type="button" onclick="editTicket(<?php echo $row['idTicket']; ?>)"
                                                class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600 mb-2">
                                                <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                                                    <path fill-rule="evenodd"
                                                        d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Editar</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            // Si es usuario administrador y coordinador, con estado del ticket 1, 2, 3, 4, 5, 6, 7, 8, 9 mostrar el botón de eliminar
                            if ($tipo == 'admin' || $tipo == 'coordinador') {
                                if (in_array($row['estado'], [1, 2, 3, 4, 5, 6, 7, 8, 9])) {
                                    ?>
                                    <div class="relative">
                                        <div class="mt-1 md:mt-6 mx-1">
                                            <button type="button" data-modal-target="popup-confirmation"
                                                data-modal-toggle="popup-confirmation" data-id="<?php echo $row['idTicket']; ?>"
                                                class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mb-2">
                                                <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                                                    <path fill-rule="evenodd"
                                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Eliminar</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else
                                // Si es usuario técnico, con estado del ticket 6, 9, mostrar el botón de eliminar
                                if ($tipo == 'tecnico') {
                                    if (in_array($row['estado'], [6, 9])) {
                                        ?>
                                        <div class="relative">
                                            <div class="mt-1 md:mt-6 mx-1">
                                                <button type="button" data-modal-target="popup-confirmation"
                                                    data-modal-toggle="popup-confirmation" data-id="<?php echo $row['idTicket']; ?>"
                                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mb-2">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar</button>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                            <div class="mt-1 md:mt-6 mx-1">
                                <button type="button" onclick="returnBack()"
                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center border border-gray-300 dark:border-none text-blue-700 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:text-white dark:bg-gray-700 dark:hover:bg-blue-500 dark:focus:ring-blue-600 mb-2">
                                    <svg class="w-3 h-3 text-blue-500 dark:text-white me-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14.5 8.046H11V6.119c0-.921-.9-1.446-1.524-.894l-5.108 4.49a1.2 1.2 0 0 0 0 1.739l5.108 4.49c.624.556 1.524.027 1.524-.893v-1.928h2a3.023 3.023 0 0 1 3 3.046V19a5.593 5.593 0 0 0-1.5-10.954Z" />
                                    </svg>
                                    Regresar</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="../../assets/js/redir.js"></script>
        <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
        <script>
            $(document).ready(function () {
                $('[data-modal-toggle]').click(function () {
                    var tickfetId = $(this).attr('data-id');

                    $('#dynamicTicketId').text(ticketId);
                    $('#confirmButton').attr('data-id', ticketId);
                });

                $('#confirmButton').click(function () {
                    var ticketId = $(this).attr('data-id');

                    $('#dynamicTicketIdDelete').text(ticketId);
                    $('#idTicketHidden').val(ticketId);

                    $('#popup-delete').removeClass('hidden');
                });
            });

            deletedTickets = () => {
                window.location.href = 'tickets-eliminados';
            }

            function assignTicket(idTicket) {
                window.location.href = 'asignar?id=' + idTicket;
            }

            function attendTicket(idTicket) {
                window.location.href = 'atender?id=' + idTicket;
            }

            function editTicket(idTicket) {
                window.location.href = 'editar?id=' + idTicket;
            }

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