<?php
include '../components/sidebar.php';
include '../components/modal-alta-usuario.php';
include '../components/modal-edicion-usuario.php';
include '../components/modal-baja-usuario.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Mercurio | Gestión de tickets</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <div class="sm:ml-64">
        <div class="mt-14">
            <div class="grid grid-cols-1 gap-4 mb-4">

                <div class="p-8">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
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
                                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:boder-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Buscar ticket">
                        </div>
                    </div>
                    <div class="flex space-x-2 justify-end">
                        <div>
                            <button type="button" data-modal-target="popup-user-add" data-modal-toggle="popup-user-add"
                                class="inset-y-0 right-0 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-green-500 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-800 dark:focus:ring-green-900">
                                <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 12h14m-7 7V5" />
                                </svg>
                                Nuevo usuario
                            </button>
                        </div>
                        <div>
                            <button type="button" onclick="window.location.href='usuarios-eliminados'"
                                class="inset-y-0 right-0 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-500 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-800 dark:focus:ring-red-900">
                                <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
                                </svg>

                                Usuarios eliminados
                            </button>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto sm:rounded-lg">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No. de usuario
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Usuario
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre(s)
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Apellidos
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Imagen de usuario
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Tipo de usuario
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
                                        Fecha de creación
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
                            $stmt = $conn->query('SELECT COUNT(*) FROM users WHERE userStatus = 0');
                            $row = $stmt->fetch_row();
                            $totalRegistros = $row[0];

                            $registrosPorPagina = 10;
                            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                            $paginaActual = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $offset = ($paginaActual - 1) * $registrosPorPagina;

                            $sql = "SELECT * FROM users WHERE userStatus = 0 ORDER BY fhCreacion DESC LIMIT $registrosPorPagina OFFSET $offset";
                            $resultado = $conn->query($sql);

                            while ($fila = $resultado->fetch_assoc()): ?>
                                <tr id="fila_<?php echo $fila['userId']; ?>"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo htmlspecialchars($fila['userId']) ?>
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo htmlspecialchars($fila['user']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['nombre']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['apellido']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['email']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="../../assets/imgUsers/<?php echo htmlspecialchars($fila['imagen']); ?>"
                                            target="_blank" class="text-blue-600 hover:text-blue-900">Ver imagen</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['tipo']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($fila['fhCreacion']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-1">
                                            <div>
                                                <button type="button"
                                                    onclick="window.location.href='usuario?id=<?php echo $fila['userId']; ?>'"
                                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Detalles
                                                </button>
                                            </div>
                                            <div>
                                                <button type="button" data-modal-target="popup-user-edit"
                                                    data-modal-toggle="popup-user-edit"
                                                    data-id="<?php echo $fila['userId']; ?>"
                                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Editar</button>
                                            </div>
                                            <div>
                                                <button type="button" data-modal-target="popup-user-delete"
                                                    data-modal-toggle="popup-user-delete"
                                                    data-id="<?php echo $fila['userId']; ?>"
                                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    <svg class="w-3 h-3 text-white me-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 22">
                                                        <path fill-rule="evenodd"
                                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar</button>
                                            </div>
                                        </div>
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
                                <a href="usuarios?page=<?php echo $paginaActual - 1; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Anterior</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li>
                                <a href="usuarios?page=<?php echo $i; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php if ($i == $paginaActual)
                                       echo 'bg-blue-50 text-blue-500'; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($paginaActual < $totalPaginas): ?>
                            <li>
                                <a href="usuarios?page=<?php echo $paginaActual + 1; ?>"
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
            $('[data-modal-toggle="popup-user-edit"]').click(function () {
                var userId = $(this).attr('data-id');
                $.ajax({
                    url: '../configuration/getUserData.php',
                    type: 'GET',
                    data: { userId: userId },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $('#userEdit').val(data.user);
                            $('#nombreEdit').val(data.nombre);
                            $('#apellidoEdit').val(data.apellido);
                            $('#emailEdit').val(data.email);
                            $('#tipoEdit').val(data.tipo);
                            $('#userId').val(data.userId);
                        } else {
                            console.error(data.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('[data-modal-toggle="popup-user-delete"]').click(function () {
                var userId = $(this).attr('data-id');
                console.log(userId)

                $('#dynamicUserId').text(userId);
                $('#idUserHidden').val(userId);
                $('#popup-user-delete').removeClass('hidden');
            });
        });
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