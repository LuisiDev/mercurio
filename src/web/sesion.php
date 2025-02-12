<?php
include '../configuration/conn-session.php';

$user = $_SESSION['user'];
$imagen = $_SESSION['imagen'];
$tipo = $_SESSION['tipo'];

if ($user == null || $user == '') {
    header('location: ../index.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <title>Mercurio | Sesión activa</title>

    <style>
        #content {
            background-image: url(../../assets/img/bg-sesion.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body id="content">
    <div>
        <img src="../../assets/img/mercurio-be.png" class="w-32 mx-auto mt-6 object-bottom" alt="Logo de Mercurio">
        <div class="grid place-items-center text-center">
            <h2 class="text-gray-700 my-20 font-medium text-lg">
                Se ha encontrado una sesión activa.
            </h2>
            <div>
                <?php
                if ($imagen == null || $imagen == '') {
                    echo "<img src='../../assets/imgUsers/default.png' class='w-28 h-28' alt='Imagen de perfil'>";
                } else {
                    echo "<img src='../../assets/img/$imagen' class='w-28 h-28' alt='Imagen de perfil'>";
                }
                ?>
            </div>
            <div class="my-4">
                <h2 class="text-gray-900 font-semibold text-2xl">
                    <?php echo $user; ?>
                </h2>
                <h3 class="text-gray-700 font-medium text-lg">
                    <?php echo $tipo; ?>
                </h3>
            </div>
            <div class="my-2">
                <a href="dashboard.php" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Si, es mi sesión
                </a>
            </div>
            <div class="my-8">
                <a href="logout.php" class="text-red-700 underline underline-offset-4 text-sm">
                    No, cerrar sesión
                </a>
            </div>
        </div>
</body>

</html>