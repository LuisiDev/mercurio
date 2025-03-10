<?php
include '../configuration/conn-session.php';

$userId = $_SESSION['userId'];
$tipo = $_SESSION['tipo'];
$nombre = $_SESSION['nombre'];

$tecnicosData = [];

switch ($tipo) {
    case 'tecnico':
        $stmt = $conn->prepare("SELECT u.userId, u.nombre, u.apellido, u.imagen, SUM(CASE WHEN t.estado = '0' THEN 1 ELSE 0 END) AS eliminado, SUM(CASE WHEN t.estado = '1' THEN 1 ELSE 0 END) AS creado, SUM(CASE WHEN t.estado = '2' THEN 1 ELSE 0 END) AS asignado, SUM(CASE WHEN t.estado = '3' THEN 1 ELSE 0 END) AS arribo, SUM(CASE WHEN t.estado = '4' THEN 1 ELSE 0 END) AS inicio, SUM(CASE WHEN t.estado = '5' THEN 1 ELSE 0 END) AS realizacion, SUM(CASE WHEN t.estado = '6' THEN 1 ELSE 0 END) AS finalizacion, SUM(CASE WHEN t.estado = '7' THEN 1 ELSE 0 END) AS programado, SUM(CASE WHEN t.estado = '8' THEN 1 ELSE 0 END) AS congelado, SUM(CASE WHEN t.estado = '9' THEN 1 ELSE 0 END) AS cancelado FROM users u LEFT JOIN tbticket t ON u.userId = t.asignado WHERE u.tipo = 'tecnico' AND u.userId = ? AND u.userStatus = 0 GROUP BY u.userId, u.nombre, u.apellido");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        break;
    default:
        $result = $conn->query("SELECT u.userId, u.nombre, u.apellido, u.imagen, SUM(CASE WHEN t.estado = '0' THEN 1 ELSE 0 END) AS eliminado, SUM(CASE WHEN t.estado = '1' THEN 1 ELSE 0 END) AS creado, SUM(CASE WHEN t.estado = '2' THEN 1 ELSE 0 END) AS asignado, SUM(CASE WHEN t.estado = '3' THEN 1 ELSE 0 END) AS arribo, SUM(CASE WHEN t.estado = '4' THEN 1 ELSE 0 END) AS inicio, SUM(CASE WHEN t.estado = '5' THEN 1 ELSE 0 END) AS realizacion, SUM(CASE WHEN t.estado = '6' THEN 1 ELSE 0 END) AS finalizacion, SUM(CASE WHEN t.estado = '7' THEN 1 ELSE 0 END) AS programado, SUM(CASE WHEN t.estado = '8' THEN 1 ELSE 0 END) AS congelado, SUM(CASE WHEN t.estado = '9' THEN 1 ELSE 0 END) AS cancelado FROM users u LEFT JOIN tbticket t ON u.userId = t.asignado WHERE u.tipo = 'tecnico' AND u.userStatus = 0 GROUP BY u.userId, u.nombre, u.apellido");
        break;
}

if (!$result) {
    die('Query failed!');
}

while ($row = $result->fetch_assoc()) {
    $tecnicosData[] = $row;
}

$totalTodos = $conn->query("SELECT COUNT(*) AS total FROM tbticket")->fetch_assoc()['total'];
$totalCreados = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado = '1'")->fetch_assoc()['total'];
$totalEliminados = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado = '0'")->fetch_assoc()['total'];
$totalCreadosSinAsignar = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado = '1' AND asignado IS NULL")->fetch_assoc()['total'];
$totalAsignado = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado = '2'")->fetch_assoc()['total'];
$totalCreadosUsuario = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE (estado IN ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9')) AND nombre = '$nombre'")->fetch_assoc()['total'];
$totalAtendidosUsuario = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE (estado IN ('6', '0')) AND nombre = '$nombre'")->fetch_assoc()['total'];
$totalCorreos = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE correo != ''")->fetch_assoc()['total'];
$totalCreadosCorreo = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE (estado ='0' OR estado = '1' OR estado = '2' OR estado = '3' OR estado = '4' OR estado = '5' OR estado = '6' OR estado = '7' OR estado = '8' OR estado = '9') AND correo != '' AND nombre = '$nombre'")->fetch_assoc()['total'];
$totalFinalizados = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado = '6' || estado = '0' AND token IS NULL")->fetch_assoc()['total'];

// Total de Tickets
$datosDiarios = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE DATE(fhticket) = '$fecha'");
    $datosDiarios[] = $result->fetch_assoc()['total'];
}

$categorias = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('d M', strtotime("-$i days"));
    $categorias[] = $fecha;
}

$datosDiarios = implode(',', $datosDiarios);
$categorias = implode("','", $categorias);

// Total de Tickets Creados
$datosCreados = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE DATE(fhticket) = '$fecha' AND estado = '1'");
    $datosCreados[] = $result->fetch_assoc()['total'];
}

$categoriasCreados = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('d M', strtotime("-$i days"));
    $categoriasCreados[] = $fecha;
}

$datosCreados = implode(',', $datosCreados);
$categoriasCreados = implode("','", $categoriasCreados);

// Total de Tickets Eliminados
$datosEliminados = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE DATE(fhEliminacion) = '$fecha' AND estado = '0'");
    $datosEliminados[] = $result->fetch_assoc()['total'];
}

$categoriasEliminados = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('d M', strtotime("-$i days"));
    $categoriasEliminados[] = $fecha;
}

$datosEliminados = implode(',', $datosEliminados);
$categoriasEliminados = implode("','", $categoriasEliminados);

// Total de tickets creados sin asignar
$datosCreadosSinAsignar = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE DATE(fhticket) = '$fecha' AND estado = '1' AND asignado = NULL");
    $datosCreadosSinAsignar[] = $result->fetch_assoc()['total'];
}

$categoriasCreadosSinAsignar = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('d M', strtotime("-$i days"));
    $categoriasCreadosSinAsignar[] = $fecha;
}

$datosCreadosSinAsignar = implode(',', $datosCreadosSinAsignar);
$categoriasCreadosSinAsignar = implode("','", $categoriasCreadosSinAsignar);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="./loading.css">
    <script src="./js/loading.js"></script>
    <title>Inicio | Mercurio</title>
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

    <!-- Video popup informativo -->
    <div id="video-popup" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative w-full max-w-3xl mx-auto">
                <div class="relative flex flex-col items-center w-full p-4 bg-white rounded-lg shadow-lg">
                    <button id="close-video-popup" class="absolute top-4 end-4 text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="aspect-video w-full">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="Video"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const videoPopup = document.getElementById('video-popup');
        const closeVideoPopup = document.getElementById('close-video-popup');

        // Show the popup when the page loads
        window.addEventListener('load', () => {
            videoPopup.classList.remove('hidden');
        });

        closeVideoPopup.addEventListener('click', () => {
            videoPopup.classList.add('hidden');
        });
    </script>

    <div id="informational-banner" tabindex="-1"
        class="sticky z-30 sm:ml-64 top-16 sm:top-0 start-0 flex flex-col justify-between shadow-sm w-auto p-4 border-b border-gray-200 md:flex-row bg-white dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-4 md:mb-0 md:me-4">
            <h2 class="mb-1 text-base font-semibold text-gray-900 dark:text-white">Nuevo año, nuevo Mercurio.</h2>
            <p class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">
                Hemos actulizado Mercurio con nuevas funciones y mejoras. Seguiremos trabajando para mejorar la
                experiencia del cliente y colaboradores. Puedes conocer las nuevas funciones en la documentación.
            </p>
        </div>
        <div class="flex items-center flex-shrink-0">
            <a href="#"
                class="inline-flex items-center justify-center px-3 py-2 me-3 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><svg
                    class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 18">
                    <path
                        d="M9 1.334C7.06.594 1.646-.84.293.653a1.158 1.158 0 0 0-.293.77v13.973c0 .193.046.383.134.55.088.167.214.306.366.403a.932.932 0 0 0 .5.147c.176 0 .348-.05.5-.147 1.059-.32 6.265.851 7.5 1.65V1.334ZM19.707.653C18.353-.84 12.94.593 11 1.333V18c1.234-.799 6.436-1.968 7.5-1.65a.931.931 0 0 0 .5.147.931.931 0 0 0 .5-.148c.152-.096.279-.235.366-.403.088-.167.134-.357.134-.55V1.423a1.158 1.158 0 0 0-.293-.77Z" />
                </svg> Documentación</a>
            <a href="#"
                class="inline-flex items-center justify-center px-3 py-2 me-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Ver lo nuevo <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg></a>
            <button data-dismiss-target="#informational-banner" type="button" id="dismiss-informational-banner"
                class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close banner</span>
            </button>
        </div>
    </div>

    <script>
        const dismissBanner = document.getElementById('dismiss-informational-banner');
        dismissBanner.addEventListener('click', () => {
            localStorage.setItem('informational-banner-dismissed', 'true');
        });

        const isBannerDismissed = localStorage.getItem('informational-banner-dismissed');
        if (isBannerDismissed) {
            document.getElementById('informational-banner').remove();
        }
    </script>

    <div class="p-4 mt-16 sm:mt-0 lg:mb-4 sm:ml-64">
        <div class="p-3">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-2xl font-normal text-gray-900 dark:text-white mb-4">Inicio</h2>
                </div>
                <!-- <div class="inline-flex items-center">
                    <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        Hoy es:
                        <?php echo date('d') . ' de ' . date('M') . ' del ' . date('Y'); ?>
                    </h3>
                </div> -->
            </div>

            <div class="grid justify-items-center grid-cols-1 gap-4 mb-4">
                <div
                    class="w-full sm:grid lg:flex lg:justify-between px-4 py-4 mb-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="text-center justify-center lg:flex lg:text-left lg:items-center">
                        <div class="my-5 lg:my-0 grid grid-cols-1 lg:flex justify-items-center lg:justify-between">
                            <div class="mb-2 lg:mb-0 lg:me-3">
                                <?php if ($_SESSION['imagen']): ?>
                                    <img class="w-12 rounded-full"
                                        src="../../assets/imgUsers/<?php echo $_SESSION['imagen']; ?>"
                                        alt="Imagen de usuario">
                                <?php else: ?>
                                    <img class="w-12 rounded-full" src="../../assets/imgUsers/default.png"
                                        alt="Imagen de usuario">
                                <?php endif; ?>
                            </div>
                            <div>
                                <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                    <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?>
                                </h5>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                    <?php echo userType($_SESSION['tipo']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="sm:block lg:flex sm:space-x-0 space-y-4 lg:space-y-0 lg:space-x-4">
                        <div
                            class="flex justify-between border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-lg p-4">
                            <div
                                class="w-12 h-12 rounded-lg bg-blue-700 dark:bg-gray-800 flex items-center justify-center me-3">
                                <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </div>
                            <div class="text-end lg:text-start">
                                <p class="text-base font-medium text-gray-900 dark:text-white">
                                    Total creados
                                </p>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                    <?php echo $totalCreadosUsuario; ?> tickets
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex justify-between border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-lg p-4">
                            <div
                                class="w-12 h-12 rounded-lg bg-blue-700 dark:bg-gray-800 flex items-center justify-center me-3">
                                <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </div>
                            <div class="text-end lg:text-start">
                                <p class="text-base font-medium text-gray-900 dark:text-white">
                                    Total atendidos
                                </p>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                    <?php echo $totalAtendidosUsuario; ?> tickets
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex justify-between border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-lg p-4">
                            <div
                                class="w-12 h-12 rounded-lg bg-blue-700 dark:bg-gray-800 flex items-center justify-center me-3">
                                <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                </svg>
                            </div>
                            <div class="text-end lg:text-start">
                                <p class="text-base font-medium text-gray-900 dark:text-white">
                                    Correos enviados
                                </p>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                    <?php echo $totalCreadosCorreo; ?> correos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid justify-items-center sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

                <div class="w-full flex justify-between px-4 py-4 mb-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="flex items-center">
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                <?php echo $totalTodos; ?>
                            </h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-700 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M18.5 12A2.5 2.5 0 0 1 21 9.5V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2.5a2.5 2.5 0 0 1 0 5V17a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="w-full flex justify-between px-4 py-4 mb-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="flex items-center">
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                <?php echo $totalFinalizados; ?>
                            </h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                                finalizados
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-700 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-50 dark:text-white" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 5v2m0 10v2M9 5h10a2 2 0 0 1 2 2v3a2 2 0 1 0 0 4v3m-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 1 0 0-4V7a2 2 0 0 1 2-2M3 3l18 18" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="w-full flex justify-between px-4 py-4 mb-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="flex items-center">
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                <?php echo $totalEliminados; ?>
                            </h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                                eliminados
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-700 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-50 dark:text-white" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="w-full flex justify-between px-4 py-4 mb-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="flex items-center">
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                <?php echo $totalCorreos; ?>
                            </h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de correos
                                enviados
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-700 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid justify-items-center sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

                <?php foreach ($tecnicosData as $tecnicoData): ?>
                    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex justify-center items-center">
                                <?php if ($tecnicoData['imagen']): ?>
                                    <img class="w-12 h-12 rounded-full me-2"
                                        src="../../assets/imgUsers/<?php echo $tecnicoData['imagen']; ?>"
                                        alt="Imagen de usuario">
                                <?php else: ?>
                                    <img class="w-12 h-12 rounded-full me-2" src="../../assets/imgUsers/default.png"
                                        alt="Imagen de usuario">
                                <?php endif; ?>
                                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Técn.
                                    <?php echo $tecnicoData['nombre'] . ' ' . $tecnicoData['apellido']; ?>
                                </h5>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                            <div class="grid grid-cols-3 gap-3 mb-2">
                                <dl
                                    class="bg-gray-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-500 text-gray-600 dark:text-gray-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['asignado'] ?>
                                    </dt>
                                    <dd class="text-gray-600 dark:text-gray-300 text-sm font-medium">Asignado</dd>
                                </dl>
                                <dl
                                    class="bg-orange-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-orange-200 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['arribo'] ?>
                                    </dt>
                                    <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Arribo</dd>
                                </dl>
                                <dl
                                    class="bg-blue-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-blue-200 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['inicio'] ?>
                                    </dt>
                                    <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Inicio</dd>
                                </dl>
                                <dl
                                    class="bg-cyan-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-cyan-200 dark:bg-gray-500 text-cyan-600 dark:text-cyan-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['realizacion'] ?>
                                    </dt>
                                    <dd class="text-cyan-600 dark:text-cyan-300 text-sm font-medium">Realizando</dd>
                                </dl>
                                <dl
                                    class="bg-green-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-green-200 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['finalizacion'] ?>
                                    </dt>
                                    <dd class="text-green-600 dark:text-green-300 text-sm font-medium">Finalizado</dd>
                                </dl>
                                <dl
                                    class="bg-indigo-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-indigo-200 dark:bg-gray-500 text-indigo-600 dark:text-indigo-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['programado'] ?>
                                    </dt>
                                    <dd class="text-indigo-600 dark:text-indigo-300 text-sm font-medium">Programado</dd>
                                </dl>
                                <dl
                                    class="bg-blue-200 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-blue-300 dark:bg-gray-500 text-blue-700 dark:text-blue-400 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['congelado'] ?>
                                    </dt>
                                    <dd class="text-blue-700 dark:text-blue-400 text-sm font-medium">Congelado</dd>
                                </dl>
                                <dl
                                    class="bg-red-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-red-200 dark:bg-gray-500 text-red-600 dark:text-red-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['cancelado'] ?>
                                    </dt>
                                    <dd class="text-red-600 dark:text-red-300 text-sm font-medium">Cancelado</dd>
                                </dl>
                                <dl
                                    class="bg-pink-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                    <dt
                                        class="w-8 h-8 rounded-full bg-pink-200 dark:bg-gray-500 text-pink-600 dark:text-pink-300 text-sm font-medium flex items-center justify-center mb-1">
                                        <?php echo $tecnicoData['eliminado'] ?>
                                    </dt>
                                    <dd class="text-pink-600 dark:text-pink-300 text-sm font-medium">Archivado</dd>
                                </dl>
                            </div>
                            <button data-collapse-toggle="more-details-<?php echo $tecnicoData['userId']; ?>" type="button"
                                class="hover:underline text-xs text-gray-500 dark:text-gray-400 font-medium inline-flex items-center">Mostrar
                                más detalles <svg class="w-2 h-2 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="more-details-<?php echo $tecnicoData['userId']; ?>"
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
                                        </svg>
                                        <script>
                                            var total = <?php echo $tecnicoData['asignado'] + $tecnicoData['arribo'] + $tecnicoData['inicio'] + $tecnicoData['realizacion'] + $tecnicoData['programado'] + $tecnicoData['congelado']; ?>;
                                            var completados = <?php echo $tecnicoData['finalizacion']; ?>;
                                            var porcentaje = (completados * 100) / total;
                                            document.write(porcentaje.toFixed(2) + '%');
                                        </script>
                                    </dd>
                                </dl>
                                <dl class="flex items-center justify-between">
                                    <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Calificación:</dt>
                                    <dd
                                        class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-600 dark:text-gray-30">
                                        <?php echo rand(1, 5); ?> Estrellas
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <div class="py-6" id="chart-<?php echo $tecnicoData['userId']; ?>"></div>

                        <?php if ($tipo !== 'tecnico'): ?>
                            <div
                                class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                                <div class="flex justify-between items-center pt-5">
                                    <a href="reporte-tecnico2?year=<?php echo date('Y'); ?>&week=<?php echo date('W'); ?>&id=<?php echo $tecnicoData['userId']; ?>"
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
                        <?php endif; ?>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var options = {
                                chart: {
                                    type: 'donut',
                                    height: 320,
                                    width: '100%',
                                },
                                stroke: {
                                    colors: ['transparent'],
                                    lineCap: "",
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '70%',
                                            labels: {
                                                show: true,
                                                name: {
                                                    show: true,
                                                    fontFamily: 'Inter, sans-serif',
                                                    offsetY: 20,
                                                },
                                                total: {
                                                    show: true,
                                                    showAlways: true,
                                                    label: 'Tickets totales',
                                                    fontFamily: 'Inter, sans-serif',
                                                },
                                                value: {
                                                    show: true,
                                                    fontFamily: 'Inter, sans-serif',
                                                    offsetY: -20,
                                                    formatter: function (val) {
                                                        return val + " tickets"
                                                    },
                                                },
                                            },
                                            size: "80%",
                                        },
                                    },
                                },
                                grid: {
                                    padding: {
                                        top: -2,
                                    },
                                },
                                series: [
                                    <?php echo $tecnicoData['asignado']; ?>,
                                    <?php echo $tecnicoData['arribo']; ?>,
                                    <?php echo $tecnicoData['inicio']; ?>,
                                    <?php echo $tecnicoData['realizacion']; ?>,
                                    <?php echo $tecnicoData['finalizacion']; ?>,
                                    <?php echo $tecnicoData['programado']; ?>,
                                    <?php echo $tecnicoData['congelado']; ?>,
                                    <?php echo $tecnicoData['cancelado']; ?>,
                                    <?php echo $tecnicoData['eliminado']; ?>
                                ],
                                labels: ['Asignado', 'Arribo', 'Inicio', 'Realización', 'Finalizado', 'Programado', 'Congelado', 'Cancelado', 'Archivado'],
                                colors: ['#6b7280', '#d03801', '#3174f3', '#057a55', '#057a55', '#5850ec', '#1a56db', '#e02424', '#d61f69'],
                                dataLabels: {
                                    enabled: false,
                                },
                                legend: {
                                    position: "bottom",
                                    fontFamily: 'Inter, sans-serif',
                                },
                                yaxis: {
                                    labels: {
                                        formatter: function (val) {
                                            return val + " tickets"
                                        },
                                    },
                                },
                                xaxis: {
                                    labels: {
                                        formatter: function (val) {
                                            return val + " tickets"
                                        },
                                    },
                                    axisTicks: {
                                        show: false,
                                    },
                                    axisBorder: {
                                        show: false,
                                    },
                                },
                            };

                            var chart = new ApexCharts(document.querySelector("#chart-<?php echo $tecnicoData['userId']; ?>"), options);
                            chart.render();
                        });
                    </script>
                <?php endforeach; ?>

                <?php if ($tipo == 'tecnico'): ?>
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
                                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                        <?php echo $totalAsignado; ?>
                                    </h5>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                                        asignados</p>
                                </div>
                            </div>
                            <div>
                                <button type="button" onclick="window.location.href = 'gestion'"
                                    class="inset-y-0 right-0 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                    Ir
                                </button>
                            </div>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No. de ticket
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            No. de cliente
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Servicio
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $conn->prepare("SELECT idTicket, numCliente, servicio FROM tbticket WHERE estado = '1' AND asignado = ? ORDER BY fhticket DESC LIMIT 10");
                                    $stmt->bind_param('i', $userId);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()):
                                        ?>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="px-6 py-3">
                                                <a href="atender?id=<?php echo $row['idTicket']; ?>">
                                                    <?php echo $row['idTicket']; ?>
                                                </a>
                                            </td>
                                            <td class="px-6 py-3">
                                                <?php echo $row['numCliente']; ?>
                                            </td>
                                            <td class="px-6 py-3">
                                                <?php echo $row['servicio']; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                <?php endif; ?>

                <?php if ($tipo !== 'tecnico'): ?>
                    <div class="sm:max-w-sm lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

                        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0-8 0M6 21v-2a4 4 0 0 1 4-4h3.5m5.5 7v.01M19 19a2.003 2.003 0 0 0 .914-3.782a1.98 1.98 0 0 0-2.414.483" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                        <?php echo $totalCreadosSinAsignar; ?>
                                    </h5>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets sin
                                        asignar
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" onclick="window.location.href = 'gestion'"
                                    class="inset-y-0 right-0 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                    Ver
                                </button>
                            </div>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No. de ticket
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            No. de cliente
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Servicio
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $conn->prepare("SELECT idTicket, numCliente, servicio FROM tbticket WHERE estado = '1' AND asignado IS NULL ORDER BY fhticket DESC LIMIT 10");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()):
                                        ?>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="px-6 py-3 text-blue-600">
                                                <?php if ($tipo == 'admin' || $tipo == 'coordinador'): ?>
                                                    <a href="asignar?id=<?php echo $row['idTicket']; ?>">
                                                        <?php echo $row['idTicket']; ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="detalles?id=<?php echo $row['idTicket']; ?>">
                                                        <?php echo $row['idTicket']; ?>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-3">
                                                <?php echo $row['numCliente']; ?>
                                            </td>
                                            <td class="px-6 py-3">
                                                <?php echo $row['servicio']; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <?php if ($tipo !== 'tecnico'): ?>
                <div class="grid justify-items-center gap-4 mb-4">

                    <div class="lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

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
                                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                        <?php echo $totalTodos; ?>
                                    </h5>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets</p>
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
                                    <script>
                                        var total = <?php echo $totalTodos; ?>;
                                        var completados = <?php echo $totalCreados; ?>;
                                        var porcentaje = (completados * 100) / total;
                                        document.write(porcentaje.toFixed(2) + '%');
                                    </script>
                                </span>
                            </div>
                        </div>
                        <div id="tickets-total-chart"></div>
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

                    <div class="lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

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
                                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                        <?php echo $totalCreados; ?>
                                    </h5>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                                        creados</p>
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
                                    <script>
                                        var total = <?php echo $totalTodos; ?>;
                                        var completados = <?php echo $totalCreados; ?>;
                                        var porcentaje = (completados * 100) / total;
                                        document.write(porcentaje.toFixed(2) + '%');
                                    </script>
                                </span>
                            </div>
                        </div>
                        <div id="tickets-creados-chart"></div>
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

                    <div class="lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

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
                                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                        <?php echo $totalEliminados; ?>
                                    </h5>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de tickets
                                        eliminados</p>
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
                                    <script>
                                        var total = <?php echo $totalTodos; ?>;
                                        var completados = <?php echo $totalEliminados; ?>;
                                        var porcentaje = (completados * 100) / total;
                                        document.write(porcentaje.toFixed(2) + '%');
                                    </script>
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

                    <script>
                        // Gráfica de Total Creados
                        const optionsTicketsCreados = {
                            chart: {
                                height: "100%",
                                type: "area",
                                fontFamily: "Inter, sans-serif",
                                dropShadow: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            tooltip: {
                                enabled: true,
                                x: {
                                    show: false,
                                },
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: 0.55,
                                    opacityTo: 0,
                                    shade: "#1C64F2",
                                    gradientToColors: ["#1C64F2"],
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                width: 6,
                            },
                            grid: {
                                show: false,
                                StrokeDashArray: 4,
                                padding: {
                                    left: 2,
                                    right: 2,
                                    top: 0
                                },
                            },
                            series: [
                                {
                                    name: "Tickets creados",
                                    data: [<?php echo $datosCreados; ?>],
                                    color: "#1A56DB",
                                },
                            ],
                            xaxis: {
                                categories: ['<?php echo $categoriasCreados; ?>'],
                                labels: {
                                    show: true,
                                },
                                axisBorder: {
                                    show: false,
                                },
                                axisTicks: {
                                    show: false,
                                },
                            },
                            yaxis: {
                                show: true,
                            },
                        };

                        var chartTicketsCreados = new ApexCharts(document.querySelector("#tickets-creados-chart"), optionsTicketsCreados);
                        chartTicketsCreados.render();

                        // Gráfica de total de tickets fin

                        // Gráfica de Tickets total
                        const optionsTicketsTotal = {
                            chart: {
                                height: "100%",
                                type: "area",
                                fontFamily: "Inter, sans-serif",
                                dropShadow: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            tooltip: {
                                enabled: true,
                                x: {
                                    show: false,
                                },
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: 0.55,
                                    opacityTo: 0,
                                    shade: "#1C64F2",
                                    gradientToColors: ["#1C64F2"],
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                width: 6,
                            },
                            grid: {
                                show: false,
                                StrokeDashArray: 4,
                                padding: {
                                    left: 2,
                                    right: 2,
                                    top: 0
                                },
                            },
                            series: [
                                {
                                    name: "Tickets totales",
                                    data: [<?php echo $datosDiarios; ?>],
                                    color: "#1A56DB",
                                },
                            ],
                            xaxis: {
                                categories: ['<?php echo $categorias; ?>'],
                                labels: {
                                    show: true,
                                },
                                axisBorder: {
                                    show: false,
                                },
                                axisTicks: {
                                    show: false,
                                },
                            },
                            yaxis: {
                                show: true,
                            },
                        };

                        var chartTicketsTotal = new ApexCharts(document.querySelector("#tickets-total-chart"), optionsTicketsTotal);
                        chartTicketsTotal.render();

                        // Gráfica de Todos los Tickets
                        const optionsTicketsEliminados = {
                            chart: {
                                height: "100%",
                                type: "area",
                                fontFamily: "Inter, sans-serif",
                                dropShadow: {
                                    enabled: false,
                                },
                                toolbar: {
                                    show: false,
                                },
                            },
                            tooltip: {
                                enabled: true,
                                x: {
                                    show: false,
                                },
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: 0.55,
                                    opacityTo: 0,
                                    shade: "#1C64F2",
                                    gradientToColors: ["#1C64F2"],
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                width: 6,
                            },
                            grid: {
                                show: false,
                                StrokeDashArray: 4,
                                padding: {
                                    left: 2,
                                    right: 2,
                                    top: 0
                                },
                            },
                            series: [
                                {
                                    name: "Tickets eliminados",
                                    data: [<?php echo $datosEliminados; ?>],
                                    color: "#1A56DB",
                                },
                            ],
                            xaxis: {
                                categories: ['<?php echo $categoriasEliminados; ?>'],
                                labels: {
                                    show: true,
                                },
                                axisBorder: {
                                    show: false,
                                },
                                axisTicks: {
                                    show: false,
                                },
                            },
                            yaxis: {
                                show: true,
                            },
                        };

                        var chartTicketsEliminados = new ApexCharts(document.querySelector("#tickets-eliminados-chart"), optionsTicketsEliminados);
                        chartTicketsEliminados.render();

                        //Gráfica de tickets creados sin asignar
                        // const optionsTicketsCreadosSinAsignar = {
                        //     chart: {
                        //         height: "100%",
                        //         type: "area",
                        //         fontFamily: "Inter, sans-serif",
                        //         dropShadow: {
                        //             enabled: false,
                        //         },
                        //         toolbar: {
                        //             show: false,
                        //         },
                        //     },
                        //     tooltip: {
                        //         enabled: true,
                        //         x: {
                        //             show: false,
                        //         },
                        //     },
                        //     fill: {
                        //         type: "gradient",
                        //         gradient: {
                        //             opacityFrom: 0.55,
                        //             opacityTo: 0,
                        //             shade: "#1C64F2",
                        //             gradientToColors: ["#1C64F2"],
                        //         },
                        //     },
                        //     dataLabels: {
                        //         enabled: false,
                        //     },
                        //     stroke: {
                        //         width: 6,
                        //     },
                        //     grid: {
                        //         show: false,
                        //         StrokeDashArray: 4,
                        //         padding: {
                        //             left: 2,
                        //             right: 2,
                        //             top: 0
                        //         },
                        //     },
                        //     series: [
                        //         {
                        //             name: "Tickets creados sin asignar",
                        //             data: [<?php echo $datosCreadosSinAsignar; ?>],
                        //             color: "#1A56DB",
                        //         },
                        //     ],
                        //     xaxis: {
                        //         categories: ['<?php echo $categoriasCreadosSinAsignar; ?>'],
                        //         labels: {
                        //             show: true,
                        //         },
                        //         axisBorder: {
                        //             show: false,
                        //         },
                        //         axisTicks: {
                        //             show: false,
                        //         },
                        //     },
                        //     yaxis: {
                        //         show: true,
                        //     },
                        // };

                        // var chartTicketsCreadosSinAsignar = new ApexCharts(document.querySelector("#tickets-creados-sin-asignar-chart"), optionsTicketsCreadosSinAsignar);
                        // chartTicketsCreadosSinAsignar.render();
                    </script>

                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- <script src="../../assets/js/charts.js"></script> -->
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>