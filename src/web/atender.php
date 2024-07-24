<?php
include '../components/sidebar.php';

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

function getStatus($status)
{
    switch ($status) {
        case "1":
            echo 'Creado';
            break;
        case "2":
            echo 'Iniciado';
            break;
        case "3":
            echo 'Realizando';
            break;
        case "4":
            echo 'Hecho';
            break;
        case "5":
            echo 'Programado';
            break;
        case "6":
            echo 'Congelado';
            break;
        case "7":
            echo 'Cancelado';
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Mercurio | Dashboard</title>
</head>

<body>
    <h1 class="sr-only">Sistema Mercurio | Grupo Cardinales</h1>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
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
                        <strong class="semi-bold text-gray-900 md:text-xl dark:text-gray-400">Información del ticket
                            #<?php echo $row['idTicket'] ?> - <?php echo $row['asunto'] ?></strong>
                    </div>
                    <?php echo $estadoActual ?>
                    <span class="text-lg font-bold text-gray-800">Información del cliente</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-400">
                        <p><span class="font-medium text-gray-700">Número del cliente:
                            </span><?php echo $row['numCliente']; ?></p>

                        <?php if (!empty($row['dispositivo'])) { ?>
                            <p><span class="font-medium text-gray-700">Dispositivo:
                                </span><?php echo $row['dispositivo']; ?></p>
                        <?php } ?>

                        <?php if (!empty($row['imeiCliente'])) { ?>
                            <p><span class="font-medium text-gray-700">IMEI: </span><?php echo $row['imeiCliente']; ?></p>
                        <?php } ?>

                        <?php if (!empty($row['fhRevision'])) { ?>
                            <p><span class="font-medium text-gray-700">Fecha de revisión:
                                </span><?php echo $row['fhRevision'] ?></p>
                        <?php } ?>

                        <?php if (!empty($row['nomContacto'])) { ?>
                            <p><span class="font-medium text-gray-700">Nombre del contacto:
                                </span><?php echo $row['nomContacto'] ?></p>
                        <?php } ?>

                        <?php if (!empty($row['numContacto'])) { ?>
                            <p><span class="font-medium text-gray-700">Número del contacto:
                                </span><?php echo $row['numContacto'] ?></p>
                        <?php } ?>
                    </div>
                    <?php if (!empty($row['placasContacto']) && !empty($row['marcaContacto'])) { ?>
                        <span class="text-lg font-bold text-gray-800">Información del vehiculo</span>
                        <div class="mb-4 text-base text-gray-500 dark:text-gray-400">
                            <?php if (!empty($row['placasContacto'])) { ?>
                                <p><span class="font-medium text-gray-700">Placas: </span><?php echo $row['placasContacto']; ?>
                                </p>
                            <?php } ?>
                            <?php if (!empty($row['marcaContacto'])) { ?>
                                <p><span class="font-medium text-gray-700">Marca/modelo:
                                    </span><?php echo $row['marcaContacto']; ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <span class="text-lg font-bold text-gray-800">Información del ticket</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-400">
                        <p><span class="font-medium text-gray-700">Fecha del ticket:
                            </span><?php echo $row['fhticket']; ?></p>
                        <p><span class="font-medium text-gray-700">Asunto: </span><?php echo $row['asunto']; ?></p>
                        <?php if (!empty($row['descripcion'])) { ?>
                            <p><span class="font-medium text-gray-700">Problema: </span><?php echo $row['descripcion']; ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($row['servicio'])) { ?>
                            <p><span class="font-medium text-gray-700">Servicio: </span><?php echo $row['servicio']; ?></p>
                        <?php } ?>
                        <?php if (!empty($row['estado'])) { ?>
                            <p><span class="font-medium text-gray-700">Estado: </span><?php getStatus($row['estado']); ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($row['domicilio'])) { ?>
                            <p><span class="font-medium text-gray-700">Domicilio: </span><?php echo $row['domicilio']; ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($row['ciudad']) && !empty($row['domestado'])) { ?>
                            <p><span class="font-medium text-gray-700">Ciudad y Estado:
                                </span><?php echo $row['ciudad']; ?>, <?php echo $row['domestado']; ?></p>
                        <?php } ?>
                        <?php if (!empty($row['codpostal'])) { ?>
                            <p><span class="font-medium text-gray-700">Código Postal:
                                </span><?php echo $row['codpostal']; ?></p>
                        <?php } ?>
                        <?php if (!empty($row['evidencia'])) { ?>
                            <p><span class="font-medium text-gray-700">Evidencia: </span><?php echo $row['evidencia']; ?>
                            </p>
                        <?php } ?>
                    </div>
                    <span class="text-lg font-bold text-gray-800">Actividad del ticket</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-400">
                        <p><span class="font-medium text-gray-700">Creado por: </span><?php echo $row['nombre']; ?></p>
                        <?php if (!empty($row['eliminadopor'])) { ?>
                            <p><span class="font-medium text-gray-700">Eliminado por:
                                </span><?php echo $row['eliminadopor']; ?></p>
                        <?php } ?>
                        <p><span class="font-medium text-gray-700">Fecha y hora de Creado:
                            </span><?php echo $row['fhticket']; ?></p>

                        <?php
                        switch ($row['estado']) {
                            case '2':
                                ?>
                                <p><span class="font-medium text-gray-700">Fecha y hora de Iniciando:
                                    </span><?php echo $row['fh_contestacion']; ?></p>
                                <p><span class="font-medium text-gray-700">Comentarios de Iniciando:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '3':
                                ?>
                                <p><span class="font-medium text-gray-700">Fecha y hora de Haciendo:
                                    </span><?php echo $row['fh_contestacion']; ?></p>
                                <p><span class="font-medium text-gray-700">Comentarios de Haciendo:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '4':
                                ?>
                                <p><span class="font-medium text-gray-700">Fecha y hora de Hecho:
                                    </span><?php echo $row['fh_contestacion']; ?></p>
                                <p><span class="font-medium text-gray-700">Comentarios de Hecho:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '5':
                                ?>
                                <p><span class="font-medium text-gray-700">Fecha y hora de Programado:
                                    </span><?php echo $row['fh_contestacion']; ?></p>
                                <p><span class="font-medium text-gray-700">Comentarios de Programado:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '6':
                                ?>
                                <p><span class="font-medium text-gray-700">Fecha y hora de Congelado:
                                    </span><?php echo $row['fh_contestacion']; ?></p>
                                <p><span class="font-medium text-gray-700">Comentarios de Congelado:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '7':
                                ?>
                                <p><span class="font-medium text-gray-700">Fecha y hora de Eliminado:
                                    </span><?php echo $row['fh_eliminacion']; ?></p>
                                <p><span class="font-medium text-gray-700">Motivo de eliminación:
                                    </span><?php echo $row['motivo_eliminacion']; ?></p>
                                <?php
                                break;
                        }
                        ?>
                    </div>
                    <span class="text-lg font-bold text-gray-800">Evidencias</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-400">
                        <?php if (empty($row['evidencia']) && empty($row['evidenciaAbierto']) && empty($row['evidenciaHaciendo']) && empty($row['evidenciaHecho'])): ?>
                            <p>No se han adjuntado evidencias</p>
                        <?php else: ?>
                            <div class="flex justify-start space-x-6 text-center">
                                <div>
                                    <?php if (!empty($row['evidencia'])): ?>
                                        <p><span class="font-medium text-gray-700">Evidencia inicial:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidencia']); ?>"
                                                alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaAbierto'])): ?>
                                        <p><span class="font-medium text-gray-700">Evidencia de inicio:</span></p>
                                        <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaAbierto']); ?>"
                                            alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaHaciendo'])): ?>
                                        <p><span class="font-medium text-gray-700">Evidencia de realización:</span></p>
                                        <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaHaciendo']); ?>"
                                            alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaHecho'])): ?>
                                        <p><span class="font-medium text-gray-700">Evidencia de terminado:</span></p>
                                        <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaHecho']); ?>"
                                            alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($row['estado'] == 4): ?>
                        <span class="text-lg font-bold text-gray-800">Información del formulario de finalización</span>
                        <div class="mb-6 text-base text-gray-500 dark:text-gray-400">
                            <?php if (!empty($row['token'])): ?>
                                <p>No se a contestado el formulario de finalización</p>
                            <?php else: ?>
                                <?php
                                $idTicket = $row['idTicket'];
                                $queryForm = "SELECT id FROM formsatisfaccion WHERE id = '$idTicket'";
                                $resultForm = mysqli_query($conn, $queryForm);
                                if ($resultForm && mysqli_num_rows($resultForm) > 0) {
                                    $formData = mysqli_fetch_array($resultForm);
                                    $formId = $formData['id'];
                                    ?>
                                    <p>Contestado completamente. <a href="resultado.php?id=<?= $formId; ?>"
                                            class="text-blue-600 hover:text-blue-800">Ver
                                            resultados</a>.</p>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="relative">
                        <form action="../procesos/atender" method="POST" enctype="multipart/form-data"
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

                                $tecnicosQuery = "SELECT userId, nombre, apellido FROM users WHERE tipo = 'tecnico'";
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
                                    <option value="2" <?php if ($row['estado'] == 2) {
                                        echo 'selected';
                                    } ?>>Iniciando
                                    </option>
                                    <option value="3" <?php if ($row['estado'] == 3) {
                                        echo 'selected';
                                    } ?>>Realizando</option>
                                    <option value="4" <?php if ($row['estado'] == 4) {
                                        echo 'selected';
                                    } ?>>Hecho</option>
                                    <option value="5" <?php if ($row['estado'] == 5) {
                                        echo 'selected';
                                    } ?>>Programado</option>
                                    <option value="6" <?php if ($row['estado'] == 6) {
                                        echo 'selected';
                                    } ?>>Congelado</option>
                                    <option value="7" <?php if ($row['estado'] == 7) {
                                        echo 'selected';
                                    } ?>>Cancelado</option>
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
                            <div class="hidden" id="evidenciaInicio">
                                <label for="evidenciaAbierto"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir evidencia
                                    de inicio</label>
                                <input type="file" id="evidenciaAbierto" name="evidenciaAbierto"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="loadFile(event)" accept=".jpeg, .jpg, .png, .webp"
                                    aria-describedby="evidencia-inicio">
                                <div id="evidencia-inicio" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                    Solamente se aceptan archivos JPEG, JPG y PNG de menos de 3 MB</div>
                            </div>
                            <div class="hidden" id="evidenciaRealizo">
                                <label for="evidenciaHaciendo"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir evidencia
                                    de realización</label>
                                <input type="file" id="evidenciaHaciendo" name="evidenciaHaciendo"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="loadFile(event)" accept=".jpeg, .jpg, .png, .webp"
                                    aria-describedby="evidencia-haciendo">
                                <div id="evidencia-haciendo" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                    Solamente se aceptan archivos JPEG, JPG y PNG de menos de 3 MB</div>
                            </div>
                            <div class="hidden" id="evidenciaTerminado">
                                <label for="evidenciaHecho"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir evidencia
                                    de hecho</label>
                                <input type="file" id="evidenciaHecho" name="evidenciaHecho"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursos-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="loadFile(event)" accept=".jpeg, .jpg, .png, .webp"
                                    aria-describedby="evidencia-hecho">
                                <div id="evidencia-hecho" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
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
                                alt="Visualización de evidencia">
                            <div class="mt-6">
                                <button type="button" onclick="returnBack()"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Regresar</button>
                                <button type="submit"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Enviar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/redir.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var estadoSelect = document.getElementById('estado');
            var evidenciaInicioDiv = document.getElementById('evidenciaInicio');
            var evidenciaRealizoDiv = document.getElementById('evidenciaRealizo');
            var evidenciaTerminadoDiv = document.getElementById('evidenciaTerminado');
            var inputsEvidencia = document.querySelectorAll('input[type="file"]');
            var outputImage = document.getElementById('output');

            function toggleEvidencia() {
                evidenciaInicioDiv.style.display = 'none';
                evidenciaRealizoDiv.style.display = 'none';
                evidenciaTerminadoDiv.style.display = 'none';

                resetFileInputsAndHideImage();

                if (estadoSelect.value === "2") {
                    evidenciaInicioDiv.style.display = 'block';
                } else if (estadoSelect.value === "3") {
                    evidenciaRealizoDiv.style.display = 'block';
                } else if (estadoSelect.value === "4") {
                    evidenciaTerminadoDiv.style.display = 'block';
                }
            }

            // Función para resetear los inputs de archivo, ocultar la imagen de vista previa y los botones
            function resetFileInputsAndHideImage() {
                inputsEvidencia.forEach(function (input) {
                    input.value = ''; // Resetea el input de archivo
                });
                document.getElementById('btnMostrar').classList.add('hidden'); // Oculta el botón de mostrar
                document.getElementById('btnEliminar').classList.add('hidden'); // Oculta el botón de eliminar
            }

            // Llama a toggleEvidencia al cargar la página para establecer la visibilidad inicial correctamente
            toggleEvidencia();

            // Agrega el evento change al select de estado
            estadoSelect.addEventListener('change', toggleEvidencia);
        });

        var currentInputId = ''; // Variable global para almacenar el ID del input actual

        var loadFile = function (event) {
            var input = event.target;
            var file = input.files[0];
            var type = file.type;

            currentInputId = input.id; // Almacena el ID del input que cargó la imagen

            var output = document.getElementById('output');
            output.src = URL.createObjectURL(file);
            output.onload = function () {
                URL.revokeObjectURL(output.src); // Libera el objeto URL creado
            }
            document.getElementById('btnMostrar').classList.remove('hidden');
            document.getElementById('btnEliminar').classList.remove('hidden');
        };

        function showImage() {
            var output = document.getElementById('output');
            if (output.classList.contains('hidden')) {
                output.classList.remove('hidden');
            } else {
                output.classList.add('hidden');
            }
        }

        function removeImage() {
            var output = document.getElementById('output');
            output.classList.add('hidden');
            output.src = ''; // Elimina el src de la imagen
            document.getElementById('btnMostrar').classList.add('hidden');
            document.getElementById('btnEliminar').classList.add('hidden');

            if (currentInputId) {
                document.getElementById(currentInputId).value = ''; // Resetea el input de archivo específico
            }
        }
    </script>
</body>

</html>