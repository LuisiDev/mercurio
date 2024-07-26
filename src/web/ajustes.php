<?php
include '../components/sidebar.php';

if (isset($_SESSION['userId'])) {
    $id = $_SESSION['userId'];
    $sql = "SELECT * FROM users WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

function userStatus($status)
{
    if ($status == 0) {
        return 'Activo';
    } else {
        return 'Inactivo';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <title>Mercurio | Dashboard</title>
</head>

<body>
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="grid grid-cols-1 gap-4 mb-4">

                <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-y-6 gap-x-6">

                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">
                                Información del perfil</h3>
                        </div>
                        <div class="grid grid-rows-3 grid-flow-col gap-4">
                            <div class="row-span-3">
                                <?php if ($row['imagen']): ?>
                                    <img src="../../assets/imgUsers/<?php echo $row['imagen']; ?>" alt="Foto de perfil"
                                        class="w-24 h-24 rounded-lg">
                                <?php else: ?>
                                    <img src="../../assets/imgUsers/default.png" alt="Foto de perfil"
                                        class="md:w-44 md:h-44 sm:w-24 sm:h-24 rounded-lg">
                                <?php endif; ?>
                            </div>
                            <div class="col-span-3">
                                <p class="text-base font-medium text-gray-900">Usuario: <span
                                        class="font-normal"><?php echo $row['user']; ?></span></p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-base font-medium text-gray-900">Nombre: <span
                                        class="font-normal"><?php echo $row['nombre'] . ' ' . $row['apellido']; ?></span>
                                </p>
                            </div>
                            <div class="col-span-1">
                                <p class="text-base font-medium text-gray-900">Tipo: <span
                                        class="font-normal"><?php echo userType($row['tipo']); ?></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">
                                Información de
                                documentos</h3>
                        </div>
                        <div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">INE</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="numCliente"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Número de cliente" required>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dopping</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="numCliente"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Número de cliente" required>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IMSS</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="numCliente"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Número de cliente" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">
                                Autenticación
                                de dos pasos</h3>
                        </div>
                    </div>

                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">
                                Información
                                general</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-x-16">
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre(s)</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="<?php echo $row['nombre']; ?>" disabled readonly required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="<?php echo $row['apellido']; ?>" disabled readonly required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="<?php echo userStatus($row['userStatus']); ?>" disabled readonly
                                    required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="No especificado" disabled readonly required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domicilio</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="No especificado" disabled readonly required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Organización</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="No especificado" disabled readonly required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="No especificado" disabled readonly required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="<?php echo userType($row['tipo']); ?>" disabled readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">
                                Información de
                                contraseña</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-x-16">
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Número de cliente" required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva
                                    contraseña</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Número de cliente" required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar
                                    contraseña</label>
                                <input type="text" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Número de cliente" required>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">
                                Personalizar color de sidebar</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-x-16">
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color
                                    primario</label>
                                <input type="color" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                            <div class="mb-5">
                                <label for="numCliente"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color
                                    secundario</label>
                                <input type="color" id="numCliente"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                        </div>
                        <script>
                        const color = document.querySelector('input[type="color"]');
                        color.addEventListener('input', function() {
                            document.documentElement.style.setProperty('--color-primary', color.value);
                        });
                        </script>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>