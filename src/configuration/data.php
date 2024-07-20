<?php

// 2. Consulta a la base de datos
//Mario
$sql_creado = "SELECT COUNT(*) AS creado FROM tbticket WHERE estado = 7 AND asignado = 1";
$result_creado = $conn->query($sql_creado);
$row_creado = $result_creado->fetch_assoc();
$creado_m = $row_creado['creado'];

$sql_generados = "SELECT COUNT(*) AS generados FROM tbticket WHERE estado = 'Iniciando' OR estado = 1 AND asignado = 1";
$result_generados = $conn->query($sql_generados);
$row_generados = $result_generados->fetch_assoc();
$abiertos_m = $row_generados['generados'];

$sql_cerrados = "SELECT COUNT(*) AS hecho FROM tbticket WHERE estado = 5 AND asignado = 1";
$result_cerrados = $conn->query($sql_cerrados);
$row_hecho = $result_cerrados->fetch_assoc();
$cerrados_m = $row_hecho['hecho'];

$sql_congelados = "SELECT COUNT(*) AS congelados FROM tbticket WHERE estado = 3 AND asignado = 1";
$result_congelados = $conn->query($sql_congelados);
$row_congelados = $result_congelados->fetch_assoc();
$congelados_m = $row_congelados['congelados'];

$sql_programado = "SELECT COUNT(*) AS programado FROM tbticket WHERE estado = 4 AND asignado = 1";
$result_programado = $conn->query($sql_programado);
$row_programado = $result_programado->fetch_assoc();
$programado_m = $row_programado['programado'];

$sql_haciendo = "SELECT COUNT(*) AS haciendo FROM tbticket WHERE estado = 2 AND asignado = 1";
$result_haciendo = $conn->query($sql_haciendo);
$row_haciendo = $result_haciendo->fetch_assoc();
$haciendo_m = $row_haciendo['haciendo'];

$sql_cancelado = "SELECT COUNT(*) AS cancelados FROM tbticket WHERE estado = 6 AND asignado = 1";
$result_cancelado = $conn->query($sql_cancelado);
$row_cancelado = $result_cancelado->fetch_assoc();
$cancelado_m = $row_cancelado['cancelados'];

//Gio
$sql_creado = "SELECT COUNT(*) AS creado FROM tbticket WHERE estado = 7 AND asignado = 2";
$result_creado = $conn->query($sql_creado);
$row_creado = $result_creado->fetch_assoc();
$creado_G = $row_creado['creado'];

$sql_generados = "SELECT COUNT(*) AS generados FROM tbticket WHERE estado = 'Iniciando' OR estado = 1 AND asignado = 2";
$result_generados = $conn->query($sql_generados);
$row_generados = $result_generados->fetch_assoc();
$abiertos_G = $row_generados['generados'];

$sql_cerrados = "SELECT COUNT(*) AS hecho FROM tbticket WHERE estado = 5 AND asignado = 2";
$result_cerrados = $conn->query($sql_cerrados);
$row_hecho = $result_cerrados->fetch_assoc();
$cerrados_G = $row_hecho['hecho'];

$sql_congelados = "SELECT COUNT(*) AS congelados FROM tbticket WHERE estado = 3 AND asignado = 2";
$result_congelados = $conn->query($sql_congelados);
$row_congelados = $result_congelados->fetch_assoc();
$congelados_G = $row_congelados['congelados'];

$sql_programado = "SELECT COUNT(*) AS programado FROM tbticket WHERE estado = 4 AND asignado = 2";
$result_programado = $conn->query($sql_programado);
$row_programado = $result_programado->fetch_assoc();
$programado_G = $row_programado['programado'];

$sql_haciendo = "SELECT COUNT(*) AS haciendo FROM tbticket WHERE estado = 2 AND asignado = 2";
$result_haciendo = $conn->query($sql_haciendo);
$row_haciendo = $result_haciendo->fetch_assoc();
$haciendo_G = $row_haciendo['haciendo'];

$sql_cancelado = "SELECT COUNT(*) AS cancelados FROM tbticket WHERE estado = 6 AND asignado = 2";
$result_cancelado = $conn->query($sql_cancelado);
$row_cancelado = $result_cancelado->fetch_assoc();
$cancelado_G = $row_cancelado['cancelados'];

//Aldo
$sql_creado = "SELECT COUNT(*) AS creado FROM tbticket WHERE estado = 7 AND asignado = 3";
$result_creado = $conn->query($sql_creado);
$row_creado = $result_creado->fetch_assoc();
$creado_A = $row_creado['creado'];

$sql_abiertos = "SELECT COUNT(*) AS abiertos FROM tbticket WHERE estado = 1 AND asignado = 3";
$result_abiertos = $conn->query($sql_abiertos);
$row_abiertos = $result_abiertos->fetch_assoc();
$abiertos_A = $row_abiertos['abiertos'];

$sql_cerrados = "SELECT COUNT(*) AS hecho FROM tbticket WHERE estado = 5 AND asignado = 3";
$result_cerrados = $conn->query($sql_cerrados);
$row_hecho = $result_cerrados->fetch_assoc();
$cerrados_A = $row_hecho['hecho'];

$sql_congelados = "SELECT COUNT(*) AS congelados FROM tbticket WHERE estado = 3 AND asignado = 3";
$result_congelados = $conn->query($sql_congelados);
$row_congelados = $result_congelados->fetch_assoc();
$congelados_A = $row_congelados['congelados'];

$sql_programado = "SELECT COUNT(*) AS programado FROM tbticket WHERE estado = 4 AND asignado = 3";
$result_programado = $conn->query($sql_programado);
$row_programado = $result_programado->fetch_assoc();
$programado_A = $row_programado['programado'];

$sql_haciendo = "SELECT COUNT(*) AS haciendo FROM tbticket WHERE estado = 2 AND asignado = 3";
$result_haciendo = $conn->query($sql_haciendo);
$row_haciendo = $result_haciendo->fetch_assoc();
$haciendo_A = $row_haciendo['haciendo'];

$sql_cancelado = "SELECT COUNT(*) AS cancelados FROM tbticket WHERE estado = 6 AND asignado = 3";
$result_cancelado = $conn->query($sql_cancelado);
$row_cancelado = $result_cancelado->fetch_assoc();
$cancelado_A = $row_cancelado['cancelados'];

//Ricardo
$sql_creado = "SELECT COUNT(*) AS creado FROM tbticket WHERE estado = 7 AND asignado = 4";
$result_creado = $conn->query($sql_creado);
$row_creado = $result_creado->fetch_assoc();
$creado_R = $row_creado['creado'];

$sql_generados = "SELECT COUNT(*) AS generados FROM tbticket WHERE estado = 'Iniciando' OR estado = 1 AND asignado = 4";
$result_generados = $conn->query($sql_generados);
$row_generados = $result_generados->fetch_assoc();
$abiertos_R = $row_generados['generados'];

$sql_cerrados = "SELECT COUNT(*) AS hecho FROM tbticket WHERE estado = 5 AND asignado = 4";
$result_cerrados = $conn->query($sql_cerrados);
$row_hecho = $result_cerrados->fetch_assoc();
$cerrados_R = $row_hecho['hecho'];

$sql_congelados = "SELECT COUNT(*) AS congelados FROM tbticket WHERE estado = 3 AND asignado = 4";
$result_congelados = $conn->query($sql_congelados);
$row_congelados = $result_congelados->fetch_assoc();
$congelados_R = $row_congelados['congelados'];

$sql_programado = "SELECT COUNT(*) AS programado FROM tbticket WHERE estado = 4 AND asignado = 4";
$result_programado = $conn->query($sql_programado);
$row_programado = $result_programado->fetch_assoc();
$programado_R = $row_programado['programado'];

$sql_haciendo = "SELECT COUNT(*) AS haciendo FROM tbticket WHERE estado = 2 AND asignado = 4";
$result_haciendo = $conn->query($sql_haciendo);
$row_haciendo = $result_haciendo->fetch_assoc();
$haciendo_R= $row_haciendo['haciendo'];

$sql_cancelado = "SELECT COUNT(*) AS cancelados FROM tbticket WHERE estado = 6 AND asignado = 4";
$result_cancelado = $conn->query($sql_cancelado);
$row_cancelado = $result_cancelado->fetch_assoc();
$cancelado_R = $row_cancelado['cancelados'];

//creados
$sql_creados = "SELECT COUNT(*) AS creados FROM tbticket WHERE estado = 7 AND asignado = 0";
$result_creados = $con->query($sql_creados);
$row_creados = $result_creados->fetch_assoc();
$creados = $row_creados['creados'];

//pendientes
$sql_pendientes = "SELECT COUNT(*) AS pendientes FROM tbticket WHERE estado = 1 AND asignado = 'Pendiente'";
$result_pendiente = $con->query($sql_pendientes);
$row_pendiente = $result_pendiente->fetch_assoc();
$pendiete = $row_pendiente['pendientes'];

//papelera
$sql_papelera = "SELECT COUNT(*) AS papelera FROM tbticket WHERE st_estado = 1 AND estado = 8";
$result_papelera = $con->query($sql_papelera);
$row_papelera = $result_papelera->fetch_assoc();
$papelera_a = $row_papelera['papelera'];

// Cerrar la conexión a la base de datos
$conn->close();