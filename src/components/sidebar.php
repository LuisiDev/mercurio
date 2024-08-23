<?php
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: ../index.php");
   exit();
}

include '../configuration/connection.php';

$tipo = $_SESSION['tipo'];
$userId = $_SESSION['userId'];

if ($tipo == 'tecnico') {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE asignado = ? AND estado <> 0";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param('i', $userId);
   $stmt->execute();
   $resultado = $stmt->get_result();
   $fila = $resultado->fetch_assoc();
   $totalTickets = $fila['total'];
} else {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE estado <> 0";
   $resultado = $conn->query($sql);
   $fila = $resultado->fetch_assoc();
   $totalTickets = $fila['total'];
}

if ($tipo == 'tecnico') {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE (estado = '0' || estado = '4') AND token != '' AND asignado = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param('i', $userId);
   $stmt->execute();
   $resultado = $stmt->get_result();
   $fila = $resultado->fetch_assoc();
   $totalEncuestas = $fila['total'];
} else {
   $sql = "SELECT COUNT(*) as total FROM tbticket WHERE (estado = '0' || estado = '4') AND token != ''";
   $resultado = $conn->query($sql);
   $fila = $resultado->fetch_assoc();
   $totalEncuestas = $fila['total'];
}

$sql = "SELECT userId, nombre, apellido, imagen, tipo FROM users";
$stmt = $conn->prepare($sql);

if (!$stmt) {
   die("Error al preparar: (" . $stmt->errno . ") " . $stmt->error);
}

if (!$stmt->execute()) {
   die("Error al ejecutar: (" . $stmt->errno . ") " . $stmt->error);
}

$userResult = $stmt->get_result();

if (!$userResult) {
   die("Error al obtener resultados (" . $stmt->errno . ") " . $stmt->error);
}

function userType($type)
{
   switch ($type) {
      case "admin":
         echo 'Administrador';
         break;
      case "coordinador":
         echo 'Coordinador';
         break;
      case "comercializacion":
         echo 'Comercialización';
         break;
      case "acomercial":
         echo 'Asistente de comercialización';
         break;
      case "tecnico":
         echo 'Técnico';
         break;
   }
}

// $notificationSql = "SELECT * FROM notificaciones WHERE userId = ? ORDER BY created_at DESC";
// $notificationStmt = $conn->prepare($notificationSql);
// $notificationStmt->bind_param('i', $userId);
// $notificationStmt->execute();
// $notificationResult = $notificationStmt->get_result();
?>

<nav class="fixed top-0 z-50 w-full bg-blue-700 dark:bg-gray-900">
   <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
         <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
               type="button"
               class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
               <span class="sr-only">Abrir sidebar</span>
               <svg class="w-6 h-6" aria-hidden="true" fill="#FFF" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path clip-rule="evenodd" fill-rule="evenodd"
                     d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                  </path>
               </svg>
            </button>
            <a href="#" class="flex ms-2 md:me-24">
               <img src="../../assets/img/logoATL_w.webp" class="h-8 me-3" alt="Mercurio Logo">
               <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"></span>
            </a>
         </div>
         <div class="flex items-center">
            <div class="flex items-center ms-3">
               <div class="mr-3">
                  <button type="button"
                     class="relative inline-flex items-center text-sm rounded-lg focus:bg-blue-800 focus:ring-4 focus:ring-blue-500 dark:focus:ring-gray-600"
                     aria-expanded="false" data-dropdown-toggle="dropdown-notifications">
                     <span class="sr-only">Abrir menú de notificaciones</span>
                     <svg class="w-8 h-8 text-white dark:text-gray-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                           d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                     </svg>
                     <div
                        class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full -top-1.5 -end-1.5 dark:border-gray-900">
                        9+</div>
                  </button>
               </div>
               <?php if ($userRow = $userResult->fetch_assoc()): ?>
                  <div>
                     <button type="button"
                        class="flex text-sm rounded-lg focus:bg-blue-800 focus:ring-4 focus:ring-blue-500 dark:focus:ring-gray-600"
                        aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Abrir menú de usuario</span>
                        <?php if ($_SESSION['imagen']): ?>
                           <img src="../../assets/imgUsers/<?php echo htmlspecialchars($_SESSION['imagen']); ?>"
                              class="w-8 h-8 rounded-lg" alt="Imagen de usuario">
                        <?php else: ?>
                           <img src="../../assets/imgUsers/default.png" class="w-8 h-8 rounded-lg" alt="Imagen de usuario">
                        <?php endif; ?>
                     </button>
                  </div>
                  <div
                     class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-800 dark:divide-gray-600"
                     id="dropdown-user">
                     <div class="px-4 py-3" role="none">
                        <p class="text-sm text-gray-900 dark:text-white" role="none">
                           <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                           <?php echo htmlspecialchars($_SESSION['apellido']); ?>
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                           <?php echo userType(htmlspecialchars($_SESSION['tipo'])); ?>
                        </p>
                     </div>
                     <ul class="py-1" role="none">
                        <li>
                           <a href="gestion"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem">Mis asignaciones</a>
                        </li>
                        <li>
                           <a href="ajustes"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem">Ajustes</a>
                        </li>
                        <li>
                           <a type="button" id="dark-mode-toggle"
                              class="block px-4 py-2 cursor-pointer text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem">Modo oscuro</a>
                        </li>
                        <li>
                           <a href="../configuration/logout"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem">Cerrar sesión</a>
                        </li>
                     </ul>
                  </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</nav>
<aside id="logo-sidebar"
   class="flex flex-col fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
   aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="dashboard"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path
                     d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                  <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
               </svg>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <?php if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "acomercial" || $_SESSION['tipo'] == "comercializacion"): ?>
            <li>
               <a href="nuevo"
                  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
                  <svg
                     class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                     <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                        clip-rule="evenodd" />
                  </svg>
                  <span class="flex-1 ms-3 whitespace-nowrap">Crear ticket</span>
               </a>
            </li>
         <?php endif; ?>
         <li>
            <a href="tickets"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path
                     d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Ver tickets</span>
            </a>
         </li>
         <!-- <li>
            <a href="#"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                     d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                     clip-rule="evenodd" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Tracking</span>
            </a>
         </li> -->
         <li>
            <a href="gestion"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                     d="M5.024 3.783A1 1 0 0 1 6 3h12a1 1 0 0 1 .976.783L20.802 12h-4.244a1.99 1.99 0 0 0-1.824 1.205 2.978 2.978 0 0 1-5.468 0A1.991 1.991 0 0 0 7.442 12H3.198l1.826-8.217ZM3 14v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5h-4.43a4.978 4.978 0 0 1-9.14 0H3Zm5-7a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm0 2a1 1 0 0 0 0 2h8a1 1 0 1 0 0-2H8Z"
                     clip-rule="evenodd" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Gestionar tickets</span>
               <span
                  class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300"><?php echo $totalTickets; ?></span>
            </a>
         </li>
         <li>
            <a href="encuestas"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                     d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                     clip-rule="evenodd" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Encuestas pendientes</span>
               <span
                  class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300"><?php echo $totalEncuestas; ?></span>
            </a>
         </li>
         <?php if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "coordinador"): ?>
            <li>
               <a href="usuarios"
                  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
                  <svg
                     class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                     <path fill-rule="evenodd"
                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                        clip-rule="evenodd" />
                  </svg>

                  <span class="flex-1 ms-3 whitespace-nowrap">Usuarios</span>
               </a>
            </li>
         <?php endif; ?>
         <!-- <?php if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "coordinador"): ?>
            <li>
               <a href="bitacora"
                  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
                  <svg
                     class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                     <path fill-rule="evenodd"
                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                        clip-rule="evenodd" />
                  </svg>
                  <span class="flex-1 ms-3 whitespace-nowrap">Bitacora de usuarios</span>
               </a>
            </li>
         <?php endif; ?> -->
         <li>
            <a href="../configuration/logout"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Cerrar sesión</span>
            </a>
         </li>
      </ul>
   </div>
   <div class="text-center mb-3 text-xs text-gray-500 dark:text-gray-400 mt-4">Versión 2.0.1</div>
</aside>

<div id="dropdown-notifications"
   class="z-50 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
   aria-labelledby="dropdownNotificationButton">
   <div
      class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
      Notificaciones</div>
   <div class="divide-y divide-gray-100 dark:divide-gray-500">
      <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
         <div class="flex-shrink-0">
            <img class="rounded-full w-11 h-11" src="..." alt="Imagen de usuario">
            <div
               class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
               <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                  viewBox="0 0 18 18">
                  <path
                     d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                  <path
                     d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
               </svg>
            </div>
         </div>
         <div class="w-full ps-3">
            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"><span
                  class="font-semibold text-gray-900 dark:text-white">Nombre</span>: Mensaje</div>
            <div class="text-xs text-blue-600 dark:text-blue-500">Fecha y/o tiempo</div>
         </div>
      </a>
   </div>
   <a href="#"
      class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
      <div class="inline-flex items-center">
         <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
            <path
               d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
         </svg>
         Ver todas las notificaciones
      </div>
   </a>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {
      const toggleButton = document.getElementById('dark-mode-toggle');
      const htmlElement = document.documentElement;

      if (localStorage.getItem('dark-mode') === 'true') {
         htmlElement.classList.add('dark');
      }

      toggleButton.addEventListener('click', () => {
         if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            localStorage.setItem('dark-mode', 'false');
         } else {
            htmlElement.classList.add('dark');
            localStorage.setItem('dark-mode', 'true');
         }
      });
   });
</script>

<!-- Notificaction url: https://flowbite.com/docs/components/toast/#push-notification -->

<!-- <div id="toast-success"
   class="fixed flex items-center w-full max-w-xs z-50 p-4 mt-11 text-gray-500 bg-white rounded-lg shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
   role="alert">
   <div
      class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
         viewBox="0 0 20 20">
         <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
      </svg>
      <span class="sr-only">Check icon</span>
   </div>
   <div class="ms-3 text-sm font-normal">Ticket creado exitosamente.</div>
   <button type="button"
      class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
      data-dismiss-target="#toast-success" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
   </button>
</div> -->

<!-- <div id="toast-notification"
   class="fixed block w-full max-w-xs z-50 p-4 mt-11 text-gray-900 bg-white rounded-lg shadow top-5 right-5 dark:bg-gray-800 dark:text-gray-300"
   role="alert">
   <div class="flex items-center mb-3">
      <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">New notification</span>
      <button type="button"
         class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
         data-dismiss-target="#toast-notification" aria-label="Close">
         <span class="sr-only">Close</span>
         <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
         </svg>
      </button>
   </div>
   <div class="flex items-center">
      <div class="relative inline-block shrink-0">
         <img class="w-12 h-12 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Jese Leos image" />
         <span
            class="absolute bottom-0 right-0 inline-flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full">
            <svg class="w-3 h-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18"
               fill="currentColor">
               <path
                  d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z"
                  fill="currentColor" />
               <path
                  d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z"
                  fill="currentColor" />
            </svg>
            <span class="sr-only">Message icon</span>
         </span>
      </div>
      <div class="ms-3 text-sm font-normal">
         <div class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</div>
         <div class="text-sm font-normal">commented on your photo</div>
         <span class="text-xs font-medium text-blue-600 dark:text-blue-500">a few seconds ago</span>
      </div>
   </div>
</div> -->