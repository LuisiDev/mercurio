<?php
include '../components/sidebar.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <title>Mercurio | Dashboard</title>
</head>

<body class="bg-gray-50 dark:bg-gray-700">
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <?php
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
    ?>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="grid grid-cols-1 gap-4 mb-4">

                <div>
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
                        <div>
                            <!-- Nombre del técnico al que se ingreso tomando en cuenta el id del tecnico -->
                             <h2><?php echo $tecnico['nombre'] . ' ' . $tecnico['apellido']; ?></h2>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Mostrar</span>
                            <button type="button" id="dropdownShowButton" data-dropdown-toggle="dropdownShow"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dar:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                <span class="sr-only">Botón de mostrar</span>
                                10
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
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
                                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Buscar ticket">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <?php if ($_SESSION['tipo'] != 'tecnico'): ?>
                            <button type="button" onclick="window.location.href = 'nuevo'"
                                class="inset-y-0 right-0 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-3 h-3 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 12h14m-7 7V5" />
                                </svg>
                                Generar ticket
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                $userId = $_SESSION['userId'];
                $tipo = $_SESSION['tipo'];

                if ($tipo == 'tecnico') {
                    $stmt = $conn->prepare('SELECT COUNT(*) FROM tbticket WHERE asignado = ?');
                    $row = $stmt->bind_param('i', $userId);
                    $stmt->execute();
                    $row = $stmt->get_result()->fetch_row();
                } else {
                    $stmt = $conn->query('SELECT COUNT(*) FROM tbticket');
                    $row = $stmt->fetch_row();
                }

                $totalRegistros = $row[0];
                $registrosPorPagina = 10;
                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($paginaActual - 1) * $registrosPorPagina;

                if ($tipo == 'tecnico') {
                    $sql = "SELECT * FROM tbticket WHERE asignado = ? ORDER BY fhticket DESC LIMIT $registrosPorPagina OFFSET $offset";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $userId);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                } else {
                    $sql = "SELECT * FROM tbticket ORDER BY fhticket DESC LIMIT $registrosPorPagina OFFSET $offset";
                    $resultado = $conn->query($sql);
                }

                $i = 0;
                while ($fila = $resultado->fetch_assoc()): ?>
                    <div
                        class="ticket-card max-w-full p-6 bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="detalles?id=<?php echo $fila['idTicket']; ?>">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                <?php echo $fila['asunto']; ?>
                            </h5>
                        </a>
                        <span class="mb-3 font-normal text-blue-500 dark:text-blue-400">Ticket
                            #<?php echo $fila['idTicket']; ?></span>
                        <span class="mb-3 font-normal text-gray-500 dark:text-gray-400"> - Fecha de creación:
                            <?php echo traducirFecha($fila['fhticket']) ?> </span><br>
                        <span
                            class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="02 02 20 20">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Hace <?php
                            $fecha = new DateTime($fila['fhticket']);
                            $hoy = new DateTime();
                            $diferencia = $hoy->diff($fecha);
                            echo $diferencia->days . ' días';
                            ?>
                        </span>
                        <?php if ($fila['estado'] == 0): ?>
                            <span
                                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Eliminado</span>
                        <?php elseif ($fila['estado'] == 1): ?>
                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Creado</span>
                        <?php elseif ($fila['estado'] == 2): ?>
                            <span
                                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Iniciando</span>
                        <?php elseif ($fila['estado'] == 3): ?>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Realizando</span>
                        <?php elseif ($fila['estado'] == 4): ?>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Hecho</span>
                        <?php elseif ($fila['estado'] == 5): ?>
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Programado</span>
                        <?php elseif ($fila['estado'] == 6): ?>
                            <span
                                class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">Congelado</span>
                        <?php elseif ($fila['estado'] == 7): ?>
                            <span
                                class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Cancelado</span>
                        <?php endif; ?>
                        <div id="ticket-description" data-accordion="close">
                            <button href="#" class="inline-flex font-normal items-center mt-3.5"
                                data-accordion-target="description-body-<?php echo $i; ?>" aria-expanded="false"
                                aria-labelledby="description-heading-<?php echo $i; ?>">
                                <span class="text-blue-600 hover:underline">Más información</span>
                                <svg class="w-3 h-3 ms-2.5 text-blue-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                            <div data-accordion-id="description-body-<?php echo $i; ?>" class="hidden"
                                aria-labelledby="description-heading">
                                <div class="p-4">
                                    <span class="mt-6 text-sm font-medium">Descripción:</span>
                                    <p class="text-sm font-normal"><?php echo $fila['descripcion']; ?></p>
                                </div>
                                <ol class="items-center md:block lg:flex">
                                    <?php if ($fila['estado'] == 1): ?>
                                        <li class="relative mb-6 sm:mb-0">
                                            <div class="flex items-center">
                                                <div
                                                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                                                    </svg>
                                                </div>
                                                <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                            </div>
                                            <div class="mt-3 sm:pe-8">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Generado
                                                </h3>
                                                <time
                                                    class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                    <?php echo traducirFecha($fila['fhticket']); ?>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ticket
                                                        creado.
                                                        Esperando asignación.</p>
                                            </div>
                                        </li>
                                    <?php elseif ($fila['estado'] == 1 && $fila['asignado'] != null): ?>
                                        <li class="relative mb-6 sm:mb-0">
                                            <div class="flex items-center">
                                                <div
                                                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                            </div>
                                            <div class="mt-3 sm:pe-8">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Asignado
                                                </h3>
                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ticket
                                                    asignado.
                                                    Ticket asignado a <?php echo $fila['asignado']; ?>.</p>, esperando inicio de
                                                trabajo.</p>
                                            </div>
                                        </li>
                                    <?php elseif ($fila['estado'] == 2): ?>
                                        <li class="relative mb-6 sm:mb-0">
                                            <div class="flex items-center">
                                                <div
                                                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
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
                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Trabajo en
                                                    inicio.
                                                    El técnico llego a la unidad y se encuentra revisando la unidad de
                                                    trabajo.</p>
                                            </div>
                                        </li>
                                    <?php elseif ($fila['estado'] == 3): ?>
                                        <li class="relative mb-6 sm:mb-0">
                                            <div class="flex items-center">
                                                <div
                                                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
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
                                                    class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Fecha
                                                    y hora</time>
                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Trabajo en
                                                    proceso. El técnico se encuentra realizando el trabajo.</p>
                                            </div>
                                        </li>
                                    <?php elseif ($fila['estado'] == 4): ?>
                                        <li class="relative mb-6 sm:mb-0">
                                            <div class="flex items-center">
                                                <div
                                                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
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
                                                    class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo traducirFecha($fila['fh_contestacion']); ?>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">El trabajo
                                                        a
                                                        concluido, en espera del formulario de finalización.</p>
                                            </div>
                                        </li>
                                    <?php elseif ($fila['estado'] == 5): ?>
                                        <li class="relative mb-6 sm:mb-0">
                                            <?php
                                            $idTicket = $row['idTicket'];
                                            $queryForm = "SELECT id FROM formsatisfaccion WHERE idticket = ?";
                                            $stmt = $conn->prepare($queryForm);
                                            $stmt->bind_param("i", $idTicket);
                                            $stmt->execute();
                                            $resultForm = $stmt->get_result();
                                            if ($resultForm->num_rows > 0) {
                                                $formData = $resultForm->fetch_assoc();
                                                $formId = $formData['id'];
                                                ?>
                                                <div class="flex items-center">
                                                    <div
                                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                </div>
                                                <div class="mt-3 sm:pe-8">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-nowrap">
                                                        Formulario contestado
                                                    </h3>
                                                    <time
                                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Fecha
                                                        y hora</time>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">El
                                                        formulario se envío correctamente. Ticket concluido.</p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php elseif ($fila['estado'] == 0): ?>
                                        <li class="relative mb-6 sm:mb-0">
                                            <div class="flex items-center">
                                                <div
                                                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                            </div>
                                            <div class="mt-3 sm:pe-8">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Archivado
                                                </h3>
                                                <time
                                                    class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Fecha
                                                    y hora</time>
                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">El ticket
                                                    se reviso completamente y se archivo.</p>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile; ?>

                <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 p-8"
                    aria-label="Navegación">
                    <span
                        class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Mostrando
                        <span
                            class="font-semibold text-gray-900 dark:text-white"><?php echo $offset + 1; ?>-<?php echo min($offset + $registrosPorPagina, $totalRegistros); ?></span>
                        de <span
                            class="font-semibold text-gray-900 dark:text-white"><?php echo $totalRegistros; ?></span></span>
                    <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                        <?php
                        $rango = 6; // Número de páginas a mostrar
                        $inicio = max($paginaActual - floor($rango / 2), 1);
                        $fin = min($inicio + $rango - 1, $totalPaginas);

                        if ($fin - $inicio + 1 < $rango) {
                            $inicio = max($fin - $rango + 1, 1);
                        }

                        if ($paginaActual > 1): ?>
                            <li>
                                <a href="tickets?page=<?php echo $paginaActual - 1; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                            <li>
                                <a href="tickets?page=<?php echo $i; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php if ($i == $paginaActual)
                                       echo 'bg-blue-50 text-blue-500'; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($paginaActual < $totalPaginas): ?>
                            <li>
                                <a href="tickets?page=<?php echo $paginaActual + 1; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-700 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">Siguiente</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

        </div>
    </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('table-search-tickets').addEventListener('keyup', function (e) {
                const value = e.target.value.toLowerCase();
                document.querySelectorAll('.ticket-card').forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(value) ? '' : 'none';
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-accordion-target]').forEach(button => {
                button.addEventListener('click', function () {
                    const targetId = button.getAttribute('data-accordion-target');
                    const targetDiv = document.querySelector(`[data-accordion-id="${targetId}"]`);
                    targetDiv.classList.toggle('hidden');
                });
            });
        });
    </script>
</body>

</html>