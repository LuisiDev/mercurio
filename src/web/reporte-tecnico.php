<?php
include '../configuration/conn-session.php';

$tecnicoId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$tecnicoData = [];

if ($tecnicoId > 0) {
    $stmt = $conn->prepare("SELECT nombre, apellido FROM users WHERE userId = ? AND tipo = 'tecnico' AND userStatus = 0");
    $stmt->bind_param('i', $tecnicoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tecnico = $result->fetch_assoc();
    } else {
        echo "<h2>Técnico no encontrado.</h2>";
        exit;
    }
} else {
    echo "<h2>ID inválido.</h2>";
    exit;
}

if ($tipo == 'tecnico') {
    $stmt = $conn->prepare("SELECT u.userId, u.nombre, u.apellido, SUM(CASE WHEN t.estado = '0' THEN 1 ELSE 0 END) AS eliminado, SUM(CASE WHEN t.estado = '1' THEN 1 ELSE 0 END) AS creado, SUM(CASE WHEN t.estado = '2' THEN 1 ELSE 0 END) AS asignado, SUM(CASE WHEN t.estado = '3' THEN 1 ELSE 0 END) AS arribo, SUM(CASE WHEN t.estado = '4' THEN 1 ELSE 0 END) AS inicio, SUM(CASE WHEN t.estado = '5' THEN 1 ELSE 0 END) AS realizacion, SUM(CASE WHEN t.estado = '6' THEN 1 ELSE 0 END) AS finalizacion, SUM(CASE WHEN t.estado = '7' THEN 1 ELSE 0 END) AS programado, SUM(CASE WHEN t.estado = '8' THEN 1 ELSE 0 END) AS congelado, SUM(CASE WHEN t.estado = '9' THEN 1 ELSE 0 END) AS cancelado FROM users u LEFT JOIN tbticket t ON u.userId = t.asignado WHERE u.tipo = 'tecnico' AND u.userId = ? AND u.userStatus = 0 GROUP BY u.userId, u.nombre, u.apellido");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT u.userId, u.nombre, u.apellido, SUM(CASE WHEN t.estado = '0' THEN 1 ELSE 0 END) AS eliminado, SUM(CASE WHEN t.estado = '1' THEN 1 ELSE 0 END) AS creado, SUM(CASE WHEN t.estado = '2' THEN 1 ELSE 0 END) AS asignado, SUM(CASE WHEN t.estado = '3' THEN 1 ELSE 0 END) AS arribo, SUM(CASE WHEN t.estado = '4' THEN 1 ELSE 0 END) AS inicio, SUM(CASE WHEN t.estado = '5' THEN 1 ELSE 0 END) AS realizacion, SUM(CASE WHEN t.estado = '6' THEN 1 ELSE 0 END) AS finalizacion, SUM(CASE WHEN t.estado = '7' THEN 1 ELSE 0 END) AS programado, SUM(CASE WHEN t.estado = '8' THEN 1 ELSE 0 END) AS congelado, SUM(CASE WHEN t.estado = '9' THEN 1 ELSE 0 END) AS cancelado FROM users u LEFT JOIN tbticket t ON u.userId = t.asignado WHERE u.tipo = 'tecnico' AND u.userStatus = 0 GROUP BY u.userId, u.nombre, u.apellido");
}

if (!$result) {
    die('Query failed!');
}

while ($row = $result->fetch_assoc()) {
    $tecnicosData[] = $row;
}

$totalTodos = $conn->query("SELECT COUNT(*) AS total FROM tbticket")->fetch_assoc()['total'];
$totalCreados = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado = '1'")->fetch_assoc()['total'];
$totalAsignado = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado IN ('1', '2', '3', '4', '5', '6', '7', '8') AND asignado = $tecnicoId")->fetch_assoc()['total'];
$totalAtendido = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE estado IN ('2', '3', '4', '5', '6',  '7', '8') AND asignado = $tecnicoId")->fetch_assoc()['total'];

// Total de Tickets Eliminados
$datosAsignado = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbticket WHERE DATE(fhticket) = '$fecha' AND estado IN ('2', '3', '4', '5', '6', '7', '8') AND asignado = $tecnicoId");
    $datosAsignado[] = $result->fetch_assoc()['total'];
}

$categoriasAsignado = [];
for ($i = 6; $i >= 0; $i--) {
    $fecha = date('d M', strtotime("-$i days"));
    $categoriasAsignado[] = $fecha;
}

$datosAsignado = implode(',', $datosAsignado);
$categoriasAsignado = implode("','", $categoriasAsignado);

function getStatusHTML($status)
{
    switch ($status) {
        case "1":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-gray-400 rounded-full"></div> Creado';
            break;
        case "2":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-orange-400 rounded-full"></div> Asignado';
            break;
        case "3":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-blue-400 rounded-full"></div> Arribo';
            break;
        case "4":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-blue-400 rounded-full"></div> Inicio';
            break;
        case "5":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-green-400 rounded-full"></div> Realización';
            break;
        case "6":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-yellow-400 rounded-full"></div> Finalización';
            break;
        case "7":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-indigo-400 rounded-full"></div> Programado';
            break;
        case "8":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-red-600 rounded-full"></div> Congelado';
            break;
        case "9":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-red-600 rounded-full"></div> Cancelado';
            break;
    }
}

function getPrioridad($prioridad)
{
    switch ($prioridad) {
        case "Pendiente":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-gray-400 rounded-full"></div> Pendiente';
            break;
        case "1":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-blue-500 rounded-full"></div> Baja';
            break;
        case "2":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-yellow-500 rounded-full"></div> Media';
            break;
        case "3":
            echo '<div class="h-2.5 w-2.5 mr-1 bg-red-500 rounded-full"></div> Alta';
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./loading.css">
    <script src="./js/loading.js"></script>
    <title>Reporte técnico | Mercurio</title>
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

                <!-- Nombre del técnico al que se ingreso tomando en cuenta el id del tecnico -->
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">
                    Reporte de <?php echo $tecnico['nombre'] . ' ' . $tecnico['apellido']; ?>
                </h2>

                <div class="grid md:grid-cols-2 grid-cols-1 md:space-x-6 space-x-0">
                    <div
                        class="sm:max-w-sm lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 mb-8 md:p-6">

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
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de
                                        tickets
                                        asignados</p>
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
                        <div id="total-asignado"></div>
                        <div
                            class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                            <div class="flex justify-between items-center pt-5">
                                <button type="button"
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                                    id="dropdownDaysButton" data-dropdown-toggle="lastDaysdropdown"
                                    data-dropdown-placement="bottom">
                                    El día de hoy
                                    <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
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

                    <div
                        class="sm:max-w-sm lg:max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mb-8">

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
                                        <?php echo $totalAtendido; ?>
                                    </h5>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Tickets
                                        atendidos recientemente</p>
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
                                    $stmt = $conn->prepare("SELECT idTicket, numCliente, servicio FROM tbticket WHERE estado IN ('2', '3', '4', '5', '6') AND asignado = ? ORDER BY fhticket DESC LIMIT 10");
                                    $stmt->bind_param('i', $tecnicoId);
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
                </div>

                <div class="flex justify-center rounded-md mb-4" role="group">
                    <button type="button" onclick="showAsignados()"
                        class="px-4 py-2 text-sm font-medium bg-white text-gray-900 bg-transparent border border-gray-200 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                        Asignados
                    </button>
                    <button type="button" onclick="showSemanales()"
                        class="px-4 py-2 text-sm font-medium bg-white text-gray-900 bg-transparent border border-gray-200 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                        Semanales
                    </button>
                </div>

                <script>
                    function showAsignados() {
                        document.getElementById('asignados').style.display = 'block';
                        document.getElementById('semanales').style.display = 'none';
                    }

                    function showSemanales() {
                        document.getElementById('asignados').style.display = 'none';
                        document.getElementById('semanales').style.display = 'block';
                    }
                </script>

                <div id="asignados">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 md:mt-0 mt-4">
                        Tickets asignados
                    </h2>

                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Mostrar</span>
                            <button type="button" id="dropdownShowButton" data-dropdown-toggle="dropdownShow"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dar:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                <span class="sr-only">Botón de mostrar</span>
                                Todos
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
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Todos</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Creado</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Iniciado</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Realizando</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hecho</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Programado</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Congelado</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cancelado</a>
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

                    <!-- Tabla de tickets asignados -->
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No. de ticket
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Asunto
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        No. de cliente
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Fecha
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
                                            Servicio
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
                                            Asignado
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
                                            Prioridad
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
                                            Estado
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
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userId = $_SESSION['userId'];
                                $tipo = $_SESSION['tipo'];
                                $tecnicoId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

                                if ($tecnicoId > 0) {
                                    $stmt = $conn->prepare('SELECT COUNT(*) FROM tbticket WHERE asignado = ? AND estado <> 0');
                                    $row = $stmt->bind_param('i', $tecnicoId);
                                    $stmt->execute();
                                    $row = $stmt->get_result()->fetch_row();
                                } else {
                                    $stmt = $conn->query('SELECT COUNT(*) FROM tbticket WHERE estado <> 0');
                                    $row = $stmt->fetch_row();
                                }

                                if ($tecnicoId > 0) {
                                    $stmt = $conn->prepare('SELECT COUNT(*) FROM tbticket WHERE asignado = ? AND (estado = 6 OR (estado = 0 AND token IS NULL)) AND WEEK(fhticket) = WEEK(CURDATE())');
                                    $stmt->bind_param('i', $tecnicoId);
                                } else {
                                    $stmt = $conn->prepare('SELECT COUNT(*) FROM tbticket WHERE (estado = 6 OR (estado = 0 AND token IS NULL)) AND WEEK(fhticket) = WEEK(CURDATE())');
                                }
                                $stmt->execute();
                                $stmt->bind_result($totalRegistros);
                                $stmt->fetch();
                                $stmt->close();

                                $registrosPorPagina = 10;
                                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                                $paginaActual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                                $offset = ($paginaActual - 1) * $registrosPorPagina;

                                // '<>' es lo mismo que '!='
                                if ($tecnicoId > 0) {
                                    $sql = "SELECT * FROM tbticket WHERE asignado = ? AND estado <> 0 ORDER BY fhticket DESC LIMIT $registrosPorPagina OFFSET $offset";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param('i', $tecnicoId);
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();
                                } else {
                                    $sql = "SELECT * FROM tbticket WHERE estado <> 0 ORDER BY fhticket DESC LIMIT $registrosPorPagina OFFSET $offset";
                                    $resultado = $conn->query($sql);
                                }

                                $i = 0;
                                while ($fila = $resultado->fetch_assoc()): ?>
                                    <?php include '../components/modal-baja-ticket.php'; ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center">
                                                <?php echo htmlspecialchars($fila['idTicket']); ?>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center">
                                                <?php echo htmlspecialchars($fila['asunto'] ?? 'No proporcionado'); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <?php echo htmlspecialchars($fila['numCliente'] ?? 'No proporcionado'); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <?php echo htmlspecialchars($fila['fhticket'] ?? 'No proporcionado'); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <?php echo htmlspecialchars($fila['servicio'] ?? 'No proporcionado'); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <?php getAsignado($fila['asignado']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <?php getPrioridad($fila['prioridad'] ?? 'No proporcionado'); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <?php getStatusHTML($fila['estado']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if ($fila['estado'] == '4' || $fila['estado'] == '7' || $tipo == 'comercializacion'): ?>
                                                <button type="button"
                                                    onclick="window.location.href = 'detalles?id=<?php echo $fila['idTicket']; ?>'"
                                                    class="px-3 py-2 mb-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Detalles
                                                </button>
                                            <?php endif; ?>
                                            <?php if ($fila['estado'] == '1' && $fila['asignado'] == null && $tipo != 'comercializacion'): ?>
                                                <button type="button"
                                                    onclick="window.location.href = 'asignar?id=<?php echo $fila['idTicket']; ?>'"
                                                    class="px-3 py-2 mb-2 text-sm font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Asignar
                                                </button>
                                            <?php endif; ?>
                                            <?php if (($fila['estado'] == '1' || $fila['estado'] == '2' || $fila['estado'] == '3' || $fila['estado'] == '5' || $fila['estado'] == '6') && isset($fila['asignado']) && !empty($fila['asignado']) && $tipo != 'comercializacion'): ?>
                                                <button type="button"
                                                    onclick="window.location.href = 'atender?id=<?php echo $fila['idTicket']; ?>'"
                                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Atender</button>
                                            <?php endif; ?>
                                            <?php if ($fila['estado'] == '1' && $fila['asignado'] == null && $tipo != 'coordinador'): ?>
                                                <button type="button"
                                                    onclick="window.location.href = 'editar?id=<?php echo $fila['idTicket']; ?>'"
                                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600 mb-2">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Editar</button>
                                            <?php endif; ?>
                                            <?php if (
                                                ($fila['estado'] == '1' || $fila['estado'] == '2' || $fila['estado'] == '3' || $fila['estado'] == '4' || $fila['estado'] == '5' || $fila['estado'] == '6' || $fila['estado'] == '7') &&
                                                $tipo != 'comercializacion' &&
                                                ($tipo != 'tecnico' || ($tipo == 'tecnico' && $fila['estado'] == '4'))
                                            ): ?>
                                                <button type="button" data-modal-target="popup-confirmation"
                                                    data-modal-toggle="popup-confirmation"
                                                    data-id="<?php echo $fila['idTicket']; ?>"
                                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mb-2">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

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
                                    <a href="reporte-tecnico?page=<?php echo $paginaActual - 1; ?>&id=<?php echo $tecnicoId; ?>"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">Anterior</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                                <li>
                                    <a href="reporte-tecnico?page=<?php echo $i; ?>&id=<?php echo $tecnicoId; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php if ($i == $paginaActual)
                                              echo 'bg-blue-50 text-blue-500'; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($paginaActual < $totalPaginas): ?>
                                <li>
                                    <a href="reporte-tecnico?page=<?php echo $paginaActual + 1; ?>&id=<?php echo $tecnicoId; ?>"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-700 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">Siguiente</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>

                <div class="hidden" id="semanales">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3 md:mt-0 mt-4">
                        Tickets realizados en la semana <?php echo date('W'); ?>
                    </h2>
                    <h3 class="text-lg font-semibold text-gray-700 mb-8 md:mt-0">De la fecha
                        <?php echo date('d/m/Y', strtotime('monday this week')); ?> al
                        <?php echo date('d/m/Y', strtotime('saturday this week')); ?>
                    </h3>

                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
                        <div class="flex justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Mostrar</span>
                                <button type="button" id="dropdownShowButton" data-dropdown-toggle="dropdownShow"
                                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dar:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    <span class="sr-only">Botón de mostrar</span>
                                    Todos
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
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Todos</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Creado</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Iniciado</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Realizando</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hecho</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Programado</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Congelado</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cancelado</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <!-- Boton para seleccionar semanas, en este caso, al dar click en el boton abra un modal con un calendario para seleccionar la semana sin un dropdown -->
                                <button type="button" id="dropdownWeekButton" data-modal-toggle="modal-week"
                                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dar:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                    <span class="sr-only">Botón de mostrar</span>
                                    Semana
                                    <?php echo date('W'); ?>
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-between">
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

                            <!-- Boton para exportar tabla en PDF -->
                            <button type="button"
                                class="button px-4 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-5 h-5 text-white me-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Exportar
                            </button>

                        </div>

                        <?php
                        // Obtener la semana seleccionada o la semana actual
                        $week = isset($_GET['week']) ? (int) $_GET['week'] : date('W');
                        $year = date('Y');

                        // Consulta optimizada para filtrar por semana
                        $sqlTickets = "
                            SELECT idTicket, asunto, numCliente, fhticket, servicio, asignado, prioridad, estado
                            FROM tbticket
                            WHERE WEEK(fhticket, 1) = ? AND YEAR(fhticket) = ?
                        ";
                        $stmtTickets = $conn->prepare($sqlTickets);
                        $stmtTickets->bind_param('ii', $week, $year);
                        $stmtTickets->execute();
                        $resultTickets = $stmtTickets->get_result();
                        ?>

                        <div id="modal-week" class="modal fixed inset-0 z-50 hidden bg-gray-900 overflow-y-auto"
                            style="margin-top: 0;">
                            <div class="modal-box bg-white dark:bg-gray-800 dark:text-gray-200 w-96 mx-auto mt-20">
                                <div class="modal-header flex justify-between px-8 py-5">
                                    <div>
                                        <h3 class="text-lg font-semibold">Seleccionar semana</h3>
                                    </div>
                                    <div>
                                        <button onclick="document.getElementById('modal-week').classList.add('hidden')"
                                            type="button" data-modal-toggle="modal-week" class="focus:outline-none">
                                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-body p-4 space-y-4 text-sm text-gray-700 dark:text-gray-200 w-96">
                                    <div class="contents">
                                        <!-- Todas las semanas del año -->
                                        <?php
                                        $semana = date('W');
                                        for ($i = 1; $i <= $semana; $i++): ?>
                                            <button type="button"
                                                class="button px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-week="<?php echo $i; ?>">Semana
                                                <?php echo $i; ?></button>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            const modalWeek = document.getElementById('modal-week');
                            const dropdownWeekButton = document.getElementById('dropdownWeekButton');

                            dropdownWeekButton.addEventListener('click', () => {
                                modalWeek.classList.toggle('hidden');
                            });

                            document.querySelectorAll('[data-week]').forEach(button => {
                                button.addEventListener('click', function () {
                                    const week = this.getAttribute('data-week');
                                    fetchTicketsByWeek(week);
                                });
                            });

                            function fetchTicketsByWeek(week) {
                                fetch(`reporte-tecnico.php?week=${week}`)
                                    .then(response => {
                                        if (!response.ok) throw new Error('Error en la respuesta del servidor');
                                        return response.text();
                                    })
                                    .then(data => {
                                        document.querySelector('.relative.overflow-x-auto').innerHTML = data;
                                        modalWeek.classList.add('hidden');
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        </script>

                        <!-- Tabla de tickets de la semana -->
                        <div class="relative overflow-x-auto sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No. de ticket
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Asunto
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            No. de cliente
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center">
                                                Fecha
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
                                                Servicio
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
                                                Asignado
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
                                                Prioridad
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
                                                Estado
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
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $userId = $_SESSION['userId'];
                                    $tipo = $_SESSION['tipo'];

                                    // Parámetros de la URL
                                    $tecnicoId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
                                    $week = isset($_GET['week']) ? (int) $_GET['week'] : date('W'); // Semana seleccionada o actual
                                    $year = date('Y'); // Año actual
                                    
                                    // Paginación
                                    $registrosPorPagina = 10;
                                    $paginaActual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                                    $offset = ($paginaActual - 1) * $registrosPorPagina;

                                    // Consulta base para los tickets
                                    $sql = "SELECT SQL_CALC_FOUND_ROWS * 
                                            FROM tbticket 
                                            WHERE (estado = 6 OR (estado = 0 AND token IS NULL)) 
                                            AND WEEK(fhticket, 1) = ? 
                                            AND YEAR(fhticket) = ? ";

                                    // Filtrar por técnico si se seleccionó uno
                                    if ($tecnicoId > 0) {
                                        $sql .= "AND asignado = ? ";
                                    }

                                    // Orden y límite
                                    $sql .= "ORDER BY fhticket DESC LIMIT ?, ?";
                                    $stmt = $conn->prepare($sql);

                                    // Vinculación de parámetros
                                    if ($tecnicoId > 0) {
                                        $stmt->bind_param('iiiii', $week, $year, $tecnicoId, $offset, $registrosPorPagina);
                                    } else {
                                        $stmt->bind_param('iiii', $week, $year, $offset, $registrosPorPagina);
                                    }

                                    // Ejecutar consulta
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();

                                    // Obtener total de registros para la paginación
                                    $totalRegistrosQuery = $conn->query("SELECT FOUND_ROWS() AS total");
                                    $totalRegistros = $totalRegistrosQuery->fetch_assoc()['total'];
                                    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

                                    // Mostrar los resultados en la tabla
                                    while ($fila = $resultado->fetch_assoc()): ?>
                                        <?php include '../components/modal-baja-ticket.php'; ?>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="flex items-center">
                                                    <?php echo htmlspecialchars($fila['idTicket']); ?>
                                                </div>
                                            </th>
                                            <td
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="flex items-center">
                                                    <?php echo htmlspecialchars($fila['asunto'] ?? 'No proporcionado'); ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <?php echo htmlspecialchars($fila['numCliente'] ?? 'No proporcionado'); ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <?php echo htmlspecialchars($fila['fhticket'] ?? 'No proporcionado'); ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <?php echo htmlspecialchars($fila['servicio'] ?? 'No proporcionado'); ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <?php getAsignado($fila['asignado']); ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <?php getPrioridad($fila['prioridad'] ?? 'No proporcionado'); ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <?php getStatusHTML($fila['estado']); ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php if ($fila['estado'] == '4' || $fila['estado'] == '7' || $tipo == 'comercializacion'): ?>
                                                    <button type="button" onclick="window.location.href = 'detalles?id=
                                <?php echo $fila['idTicket']; ?>'" class="px-3 py-2 mb-2 text-sm font-medium text-center inline-flex items-center
                                text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none
                                focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 22 22">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Detalles
                                                    </button>
                                                <?php endif; ?>
                                                <?php if ($fila['estado'] == '1' && $fila['asignado'] == null && $tipo != 'comercializacion'): ?>
                                                    <button type="button" onclick="window.location.href = 'asignar?id=
                                <?php echo $fila['idTicket']; ?>'" class="px-3 py-2 mb-2 text-sm font-medium text-center inline-flex items-center
                                text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none
                                focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700
                                dark:focus:ring-green-800">
                                                        <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 22 22">
                                                            <path fill-rule="evenodd"
                                                                d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Asignar
                                                    </button>
                                                <?php endif; ?>
                                                <?php if (($fila['estado'] == '1' || $fila['estado'] == '2' || $fila['estado'] == '3' || $fila['estado'] == '5' || $fila['estado'] == '6') && isset($fila['asignado']) && !empty($fila['asignado']) && $tipo != 'comercializacion'): ?>
                                                    <button type="button" onclick="window.location.href = 'atender?id=
                                <?php echo $fila['idTicket']; ?>'" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white
                                bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none
                                focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
                                mb-2">
                                                        <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 22 22">
                                                            <path fill-rule="evenodd"
                                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Atender</button>
                                                <?php endif; ?>
                                                <?php if ($fila['estado'] == '1' && $fila['asignado'] == null && $tipo != 'coordinador'): ?>
                                                    <button type="button" onclick="window.location.href = 'editar?id=
                                <?php echo $fila['idTicket']; ?>'" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white
                                bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none
                                focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500
                                dark:focus:ring-yellow-600 mb-2">
                                                        <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 22 22">
                                                            <path fill-rule="evenodd"
                                                                d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Editar</button>
                                                <?php endif; ?>
                                                <?php if (
                                                    ($fila['estado'] == '1' || $fila['estado'] == '2' || $fila['estado'] == '3' || $fila['estado'] == '4' || $fila['estado'] == '5' || $fila['estado'] == '6' || $fila['estado'] == '7') &&
                                                    $tipo != 'comercializacion' &&
                                                    ($tipo != 'tecnico' || ($tipo == 'tecnico' && $fila['estado'] == '4'))
                                                ): ?>
                                                    <button type="button" data-modal-target="popup-confirmation"
                                                        data-modal-toggle="popup-confirmation"
                                                        data-id="<?php echo $fila['idTicket']; ?>" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white
                                    bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none
                                    focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800
                                    mb-2">
                                                        <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 22 22">
                                                            <path fill-rule="evenodd"
                                                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Eliminar</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 p-8"
                            aria-label="Navegación">
                            <span
                                class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Mostrando
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    <?php echo $offset + 1; ?>-
                                    <?php echo min($offset + $registrosPorPagina, $totalRegistros); ?>
                                </span>
                                de <span class="font-semibold text-gray-900 dark:text-white">
                                    <?php echo $totalRegistros; ?></span></span>
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
                                        <a href=" reporte-tecnico?page=<?php echo $paginaActual - 1; ?>&id=
                                <?php echo $tecnicoId; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white
                                border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700
                                dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-600
                                dark:hover:text-white">Anterior</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                                    <li>
                                        <a href="reporte-tecnico?page=<?php echo $i; ?>&id=<?php echo $tecnicoId; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php if ($i == $paginaActual)
                                                  echo 'bg-blue-50 text-blue-500'; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($paginaActual < $totalPaginas): ?>
                                    <li>
                                        <a href="reporte-tecnico?page=<?php echo $paginaActual + 1; ?>&id=<?php echo $tecnicoId; ?>"
                                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-700 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">Siguiente</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>

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
        <script>
            $(document).ready(function () {
                $('[data-modal-toggle]').click(function () {
                    var ticketId = $(this).attr('data-id');

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
        </script>
        <script>
            // Gráfica de Todos los Tickets
            const optionsTicketsAsignado = {
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
                        name: "Tickets asignados",
                        data: [<?php echo $datosAsignado; ?>],
                        color: "#1A56DB",
                    },
                ],
                xaxis: {
                    categories: ['<?php echo $categoriasAsignado; ?>'],
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

            var chartTicketsAsignado = new ApexCharts(document.querySelector("#total-asignado"), optionsTicketsAsignado);
            chartTicketsAsignado.render();
        </script>
</body>

</html>