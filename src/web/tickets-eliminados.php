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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Mercurio | Gestión de tickets</title>
</head>

<body class="bg-gray-50 dark:bg-gray-700">
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <?php
    function getStatusHTML($status)
    {
        switch ($status) {
            case "0":
                echo '<div class="h-2.5 w-2.5 mr-1 bg-red-500 rounded-full"></div> Eliminado';
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
    <div class="sm:ml-64">
        <div class="mt-14">
            <div class="grid grid-cols-1 gap-4 mb-4">

                <div class="p-8">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
                        <div>
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
                        <button type="button" onclick="window.location.href = 'gestion'"
                            class="inset-y-0 right-0 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-800 dark:focus:ring-blue-900">
                            <svg class="w-3 h-3 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                            </svg>
                            Tickets generados
                        </button>
                    </div>
                </div>

                <div class="relative overflow-x-auto sm:rounded-lg">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
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

                            if ($tipo == 'tecnico') {
                                $stmt = $conn->prepare('SELECT COUNT(*) FROM tbticket WHERE asignado = ? AND estado = "0"');
                                $row = $stmt->bind_param('i', $userId);
                                $stmt->execute();
                                $row = $stmt->get_result()->fetch_row();
                            } else {
                                $stmt = $conn->query('SELECT COUNT(*) FROM tbticket WHERE estado = "0"');
                                $row = $stmt->fetch_row();
                            }

                            $totalRegistros = $row[0];
                            $registrosPorPagina = 10;
                            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                            $paginaActual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $offset = ($paginaActual - 1) * $registrosPorPagina;

                            if ($tipo == 'tecnico') {
                                $sql = "SELECT * FROM tbticket WHERE asignado = ? AND estado = '0' ORDER BY fhticket DESC LIMIT $registrosPorPagina OFFSET $offset";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('i', $userId);
                                $stmt->execute();
                                $resultado = $stmt->get_result();
                            } else {
                                $sql = "SELECT * FROM tbticket WHERE estado = '0' ORDER BY fhticket DESC LIMIT $registrosPorPagina OFFSET $offset";
                                $resultado = $conn->query($sql);
                            }
                            
                            $i = 0;
                            while ($fila = $resultado->fetch_assoc()): ?>
                                <?php include '../components/modal-baja-ticket.php'; ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo htmlspecialchars($fila['idTicket']); ?>
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo htmlspecialchars($fila['asunto']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['numCliente']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['fhticket']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['servicio']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php getAsignado($fila['asignado']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <?php getPrioridad($fila['prioridad']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <?php getStatusHTML($fila['estado']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if ($fila['estado'] == '0'): ?>
                                            <button type="button"
                                                onclick="window.location.href = 'detalles?id=<?php echo $fila['idTicket']; ?>'"
                                                class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2">
                                                <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Detalles
                                            </button>
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
                        <?php if ($paginaActual > 1): ?>
                            <li>
                                <a href="tickets-eliminados?page=<?php echo $paginaActual - 1; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Anterior</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li>
                                <a href="tickets-eliminados?page=<?php echo $i; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php if ($i == $paginaActual)
                                       echo 'bg-blue-50 text-blue-500'; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($paginaActual < $totalPaginas): ?>
                            <li>
                                <a href="tickets-eliminados?page=<?php echo $paginaActual + 1; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Siguiente</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

        </div>
    </div>

    <script src="../../assets/js/redir.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-modal-toggle]').click(function () {
                var ticketId = $(this).attr('data-id');
                console.log(ticketId);

                $('#dynamicTicketId').text(ticketId);
                $('#confirmButton').attr('data-id', ticketId);
            });

            $('#confirmButton').click(function () {
                var ticketId = $(this).attr('data-id');
                console.log(ticketId);

                $('#dynamicTicketIdDelete').text(ticketId);
                $('#idTicketHidden').val(ticketId);

                $('#popup-delete').removeClass('hidden');
            });
        });

        ticketsGenerated = () => {
            window.location.href = 'gestion';
        }
    </script>
    <script>
        document.getElementById('table-search-tickets').addEventListener('keyup', function (e) {
            const value = e.target.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = [...row.children].find(cell => cell.textContent.toLowerCase().includes(value)) ? '' : 'none';
            });
        });
    </script>
</body>

</html>