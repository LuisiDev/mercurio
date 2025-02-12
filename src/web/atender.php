<?php
include '../configuration/conn-session.php';

if (isset($_GET['id'])) {
    $idTicket = $_GET['id'];
    $estadoActual = isset($_GET['estado']) ? $_GET['estado'] : null;

    $query = "SELECT * FROM tbticket WHERE idTicket = '$idTicket'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if ($row['estado'] == 6) {
            echo "<script>alert('El ticket se encuentra finalizado');</script>";
            echo "<script>window.location.href = 'gestion';</script>";
            exit;
        } elseif ($row['estado'] == 0) {
            echo "<script>alert('El ticket se encuentra eliminado');</script>";
            echo "<script>window.location.href = 'gestion';</script>";
            exit;
        }
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

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./loading.css">
    <script src="./js/loading.js"></script>
    <title>Atender | Mercurio</title>
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
                                <button onclick="reload()"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Atender
                                    ticket</button>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="text-xl mb-6">
                        <strong class="semi-bold text-gray-900 md:text-xl dark:text-gray-100">Información del ticket
                            #<?php echo $row['idTicket'] ?> - <?php echo $row['asunto'] ?></strong>
                    </div>
                    <?php echo $estadoActual ?>
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
                        <?php if (!empty($row['evidencia'])) { ?>
                            <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia:
                                </span><?php echo $row['evidencia']; ?>
                            </p>
                        <?php } ?>
                    </div>
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Actividad del ticket</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Creado por:
                            </span><?php echo $row['nombre']; ?></p>
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
                                </span><?php echo traducirFecha($row['fh']); ?></p>
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
                                    <p>Contestado completamente. <a href="resultado?id=<?= htmlspecialchars($formId); ?>"
                                            class="text-blue-600 hover:text-blue-800">Ver
                                            resultados</a>.</p>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="relative">
                        <form id="formAtender" action="../procesos/atender" method="POST" enctype="multipart/form-data"
                            class="max-w-sm mx-auto">
                            <input type="hidden" name="idTicket" value="<?php echo $idTicket ?>" />
                            <input type="hidden" name="prioridad" value="<?php echo $row['prioridad']; ?>" />
                            <input type="hidden" name="asignado" value="<?php echo $row['asignado']; ?>" />
                            <?php if (isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 'admin' || $_SESSION['tipo'] == 'coordinador')): ?>
                                <?php
                                $asignadoId = $row['asignado'];
                                $asignadoQuery = "SELECT nombre, apellido FROM users WHERE userId = ?";
                                $stmt = $conn->prepare($asignadoQuery);
                                $stmt->bind_param("i", $asignadoId);
                                $stmt->execute();
                                $asignadoResult = $stmt->get_result();
                                $asignadoRow = $asignadoResult->fetch_assoc();
                                $nombreAsignado = $asignadoRow['nombre'] . ' ' . $asignadoRow['apellido'];

                                $tecnicosQuery = "SELECT userId, nombre, apellido FROM users WHERE tipo = 'tecnico' AND userStatus = 0";
                                $tecnicosResult = $conn->query($tecnicosQuery);
                                ?>
                                <input type="hidden" name="idTicket" value="<?php echo $idTicket ?>" />
                                <div class="mb-4">
                                    <label for="asignado"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reasignar</label>
                                    <select name="asignado" id="asignado"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="<?php echo $asignadoId; ?>"><?php echo $nombreAsignado; ?></option>
                                        <?php
                                        while ($tecnico = $tecnicosResult->fetch_assoc()): ?>
                                            <?php if ($tecnico['userId'] != $asignadoId): ?>
                                                <option value="<?php echo $tecnico['userId']; ?>">
                                                    <?php echo $tecnico['nombre'] . ' ' . $tecnico['apellido']; ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="prioridad"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prioridad</label>
                                    <select name="prioridad" id="prioridad"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="1" <?php if ($row['prioridad'] == 1) {
                                            echo 'selected';
                                        } ?>>Baja</option>
                                        <option value="2" <?php if ($row['prioridad'] == 2) {
                                            echo 'selected';
                                        } ?>>Media</option>
                                        <option value="3" <?php if ($row['prioridad'] == 3) {
                                            echo 'selected';
                                        } ?>>Alta</option>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="mb-4">
                                <label for="estado"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <select name="estado" id="estado"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="3" <?php if ($row['estado'] == 3) {
                                        echo 'selected'; 
                                    } ?>>Arribo a domicilio</option>
                                    <option value="4" <?php if ($row['estado'] == 4) {
                                        echo 'selected';
                                    } ?>>Inicio - Antecedentes antes de manipulación
                                    </option>
                                    <option value="5" <?php if ($row['estado'] == 5) {
                                        echo 'selected';
                                    } ?>>Realización - Antecedentes de manipulación
                                    </option>
                                    <option value="6" <?php if ($row['estado'] == 6) {
                                        echo 'selected';
                                    } ?>>Finalización - Antecedentes de cierre
                                    </option>
                                    <option value="7" <?php if ($row['estado'] == 7) {
                                        echo 'selected';
                                    } ?>>Programado
                                    </option>
                                    <option value="8" <?php if ($row['estado'] == 8) {
                                        echo 'selected';
                                    } ?>>Congelado
                                    </option>
                                    <option value="9" <?php if ($row['estado'] == 9) {
                                        echo 'selected';
                                    } ?>>Cancelado
                                    </option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="contestacion"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivo de
                                    cambio</label>
                                <textarea name="contestacion" id="contestacion" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Escribir motivos de cambio..."></textarea>
                            </div>

                            <div class="hidden" id="evidenciaArribo">
                                <label for="evidenciaArribo"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir evidencia
                                    de arribo</label>
                                <input type="file" id="evidenciaArribo" name="evidenciaArribo"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="loadFile(event)" aaccept="image/*" data-max-size="3145728"
                                    aria-describedby="evidencia-arribo">
                                <div id="evidencia-arribo" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                    Solamente se aceptan archivos JPEG, JPG y PNG de menos de 3 MB</div>
                            </div>
                            <div class="hidden" id="evidenciaInicio">
                                <label for="evidenciaInicio"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir evidencia
                                    de inicio</label>
                                <input type="file" id="evidenciaInicio" name="evidenciaInicio"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="loadFile(event)" accept="image/*" data-max-size="3145728"
                                    aria-describedby="evidencia-inicio">
                                <div id="evidencia-inicio" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                    Solamente se aceptan archivos JPEG, JPG y PNG de menos de 3 MB</div>
                            </div>
                            <div class="hidden" id="evidenciaRealizacion">
                                <label for="evidenciaRealizacion"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir evidencia
                                    de realización</label>
                                <input type="file" id="evidenciaRealizacion" name="evidenciaRealizacion"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="loadFile(event)" accept="image/*" data-max-size="3145728"
                                    aria-describedby="evidencia-realizacion">
                                <div id="evidencia-realizacion" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                    Solamente se aceptan archivos JPEG, JPG y PNG de menos de 3 MB</div>
                            </div>

                            <div class="hidden my-6" id="evidenciaGrabacion">
                                <div>
                                    <label for="evidenciaGrabacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dispositivo de grabación</label>
                                    <select name="evidenciaGrabacion" id="listaDeDispositivos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Prueba"></select>
                                    <p class="mt-3 font-medium text-medium text-gray-500 dark:text-gray-300" id="duracion"></p>
                                </div>

                                <div class="mt-5" id="grabDispositivoBtn">
                                    <button class="text-center inline-flex items-center text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                     type="button" id="btnComenzarGrabacion">
                                     <svg class="w-4 h-4 text-white me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M9 5a3 3 0 0 1 3-3h0a3 3 0 0 1 3 3v5a3 3 0 0 1-3 3h0a3 3 0 0 1-3-3z"/><path d="M5 10a7 7 0 0 0 14 0M8 21h8m-4-4v4"/></g></svg>
                                     Comenzar
                                    </button>
                                    <button class="text-center inline-flex items-center text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" 
                                    type="button" id="btnDetenerGrabacion">
                                    <svg class="w-4 h-4 text-white me-2" xmlns="http://www.w3.org/2000/svg" width="124" height="124" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 12c0-1.886 0-2.828.586-3.414S10.114 8 12 8s2.828 0 3.414.586S16 10.114 16 12s0 2.828-.586 3.414S13.886 16 12 16s-2.828 0-3.414-.586S8 13.886 8 12Z"/></g></svg>
                                    Detener
                                </button>
                                </div>
                            </div>

                            <div class="hidden" id="evidenciaFinalizacion">
                                <label for="evidenciaFinalizacion"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir evidencia
                                    de finalización</label>
                                <input type="file" id="evidenciaFinalizacion" name="evidenciaFinalizacion"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="loadFile(event)" accept="image/*" data-max-size="3145728"
                                    aria-describedby="evidencia-finalizacion">
                                <div id="evidencia-finalizacion" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                    Solamente se aceptan archivos JPEG, JPG y PNG de menos de 3 MB</div>
                            </div>

                            <div class="flex justify-center my-3">
                                <button type="button" id="btnMostrar"
                                    class="hidden me-2 mb-2 text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    onclick="showImage()" aria-hidden="true">Ver imagen</button>
                                <button type="button" id="btnEliminar"
                                    class="hidden me-2 mb-2 text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                    onclick="removeImage()" aria-hidden="true">Eliminar
                                    imagen</button>
                            </div>
                            <img id="output" class="mx-auto h-32 w-32 object-cover my-8 hidden"
                                onclick="showImageEvidenceInput(this)" alt="Visualización de evidencia">
                            <canvas id="canvas" class="mx-auto h-32 w-32 object-cover my-8 hidden"></canvas>
                            <div class="flex justify-center items-center">
                                <button type="button" id="btnEditar"
                                    class="hidden justify-center me-2 mb-2 text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    onclick="editImage()" aria-hidden="true">Editar</button>
                            </div>
                            <div class="mt-6">
                                <button type="button" onclick="returnBack()"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Regresar</button>
                                <button type="submit"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Enviar</button>
                            </div>
                        </form>

                        <div id="modalAlerta" class="modal hidden fixed inset-0 z-50 bg-gray-900 bg-opacity-50 overflow-y-auto">
                            <div class="modal-box bg-white dark:bg-gray-800 dark:text-gray-200 w-96 mx-auto mt-20 p-6 rounded-lg shadow-lg">
                                <div class="modal-header flex justify-between items-center">
                                    <h3 class="text-lg font-semibold">Alerta</h3>
                                    <button id="closeModalBtn" class="focus:outline-none">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body mt-4">
                                    <p id="modalAlertaMensaje"></p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('formAtender').addEventListener('submit', function(event) {
            const maxSize = 3145728; // 3MB en bytes
            const files = [
                document.getElementById('evidenciaArribo').files[0],
                document.getElementById('evidenciaInicio').files[0],
                document.getElementById('evidenciaRealizacion').files[0],
                document.getElementById('evidenciaFinalizacion').files[0]
            ];

            for (const file of files) {
                if (file && file.size > maxSize) {
                    event.preventDefault();
                    document.getElementById('modalAlertaMensaje').innerText = `La imagen ${file.name} es mayor a 3MB (${(file.size / 1048576).toFixed(2)} MB).`;
                    document.getElementById('modalAlerta').classList.remove('hidden');
                    return;
                }
            }
        });

        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('modalAlerta').classList.add('hidden');
        });
    </script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../../assets/js/redir.js"></script>
    <script src="../../assets/js/image.js"></script>
    <script src="js/audio.js"></script>
</body>

</html>