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
    <title>Mercurio | Detalles</title>
</head>

<body class="bg-gray-50 dark:bg-gray-700">
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
                    <?php if (!empty($row['placasContacto']) && !empty($row['marcaContacto'])) { ?>
                        <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del vehiculo</span>
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
                    <?php } ?>
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
                                </span><?php echo (strpos($row['domicilio'], 'http') === 0) ? '<a class="text-blue-500 hover:underline hover:text-blue-600" href="' . $row['domicilio'] . '" target="_blank">' . $row['domicilio'] . '</a>' : $row['domicilio']; ?>
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

                        <?php
                        switch ($row['estado']) {
                            case '0':
                                ?>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Eliminado:
                                    </span><?php echo traducirFecha($row['fh_eliminacion']); ?></p>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Motivo de eliminación:
                                    </span><?php echo $row['motivo_eliminacion']; ?></p>
                                <?php
                                break;
                            case '2':
                                ?>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Iniciando:
                                    </span><?php echo traducirFecha($row['fh_contestacion']); ?></p>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Comentarios de Iniciando:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '3':
                                ?>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Haciendo:
                                    </span><?php echo traducirFecha($row['fh_contestacion']); ?></p>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Comentarios de Haciendo:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '4':
                                ?>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Hecho:
                                    </span><?php echo traducirFecha($row['fh_contestacion']); ?></p>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Comentarios de Hecho:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '5':
                                ?>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Programado:
                                    </span><?php echo traducirFecha($row['fh_contestacion']); ?></p>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Comentarios de Programado:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                            case '6':
                                ?>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Fecha y hora de Congelado:
                                    </span><?php echo traducirFecha($row['fh_contestacion']); ?></p>
                                <p><span class="font-medium text-gray-700 dark:text-gray-200">Comentarios de Congelado:
                                    </span><?php echo $row['txt_contestacion']; ?></p>
                                <?php
                                break;
                        }
                        ?>
                    </div>
                    <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Evidencias</span>
                    <div class="mb-4 text-base text-gray-500 dark:text-gray-300">
                        <?php if (empty($row['evidencia']) && empty($row['evidenciaAbierto']) && empty($row['evidenciaHaciendo']) && empty($row['evidenciaHecho'])): ?>
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
                                    <?php if (!empty($row['evidenciaAbierto'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia de
                                                inicio:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaAbierto']); ?>"
                                                alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaHaciendo'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia de
                                                realización:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaHaciendo']); ?>"
                                                alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (!empty($row['evidenciaHecho'])): ?>
                                        <p><span class="font-medium text-gray-700 dark:text-gray-200">Evidencia de
                                                terminado:</span></p>
                                        <div class="flex justify-center">
                                            <img src="../../assets/imgTickets/<?php echo htmlspecialchars($row['evidenciaHecho']); ?>"
                                                alt="Evidencia inicial" class="w-24 h-24 object-cover rounded-lg"
                                                onclick="showImageEvidence(this)">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($row['estado'] == 0 || $row['estado'] == 4): ?>
                        <span class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del formulario de
                            finalización</span>
                        <div class="mb-6 text-base text-gray-500 dark:text-gray-300">
                            <?php if (!empty($row['token'])): ?>
                                <p>No se a contestado el formulario de finalización, por favor, contestar el formulario.
                                    Link:</p>
                                <a href="../cliente/visualizacion.php?token=<?= htmlspecialchars($row['token']); ?>"
                                    class="text-blue-600 hover:text-blue-800">Contestar formulario</a>
                            <?php else: ?>
                                <?php
                                $idTicket = $row['idTicket'];
                                $queryForm = "SELECT id FROM formsatisfaccion WHERE idticket = ?";
                                $stmt = $conn->prepare($queryForm);
                                $stmt->bind_param("i", $idTicket);
                                $stmt->execute();
                                $resultForm = $stmt->get_result();
                                if ($resultForm && $resultForm->num_rows > 0) {
                                    $formData = $resultForm->fetch_assoc();
                                    $formId = $formData['id'];
                                    ?>
                                    <p>Contestado completamente. <a href="resultado.php?id=<?= htmlspecialchars($formId); ?>"
                                            class="text-blue-600 hover:text-blue-800">Ver
                                            resultados</a>.</p>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="relative">
                        <div class="mt-6">
                            <button type="button" onclick="returnBack()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Regresar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/redir.js"></script>
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