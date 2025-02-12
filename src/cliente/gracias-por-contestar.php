<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Ticket completado | Mercurio</title>
</head>

<body class="bg-gray-100 overscroll-none">

    <nav class="bg-blue-600 fixed w-full z-20 top-0 start-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse mx-auto">
                <img class="w-40" src="../../assets/img/logoATL_w.webp" alt="Logo ATLANTIDA">
            </a>
        </div>
    </nav>


    <style>
        .main-container {
            width: 100%;
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
        }

        .check-container {
            width: 10.75rem;
            height: 12.5rem;
            display: flex;
            flex-flow: column;
            align-items: center;
            justify-content: space-between;
        }

        .check-container .check-background {
            width: 100%;
            height: calc(100% - 1.25rem);
            background: linear-gradient(to bottom right, #4a4fe5, #1e8ef1);
            box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            transform: scale(0.84);
            border-radius: 50%;
            animation: animateContainer 0.75s ease-out forwards 0.75s;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
        }

        .check-container .check-background svg {
            width: 65%;
            transform: translateY(0.25rem);
            stroke-dasharray: 80;
            stroke-dashoffset: 80;
            animation: animateCheck 0.35s forwards 1.25s ease-out;
        }

        .check-container .check-shadow {
            bottom: calc(-15% - 5px);
            left: 0;
            border-radius: 50%;
            background: radial-gradient(closest-side, #496fda, transparent);
            animation: animateShadow 0.75s ease-out forwards 0.75s;
        }

        @keyframes animateContainer {
            0% {
                opacity: 0;
                transform: scale(0);
                box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }

            25% {
                opacity: 1;
                transform: scale(0.9);
                box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }

            43.75% {
                transform: scale(1.15);
                box-shadow: 0px 0px 0px 43.334px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }

            62.5% {
                transform: scale(1);
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 21.667px rgba(255, 255, 255, 0.25) inset;
            }

            81.25% {
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
            }

            100% {
                opacity: 1;
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
            }
        }

        @keyframes animateCheck {
            from {
                stroke-dashoffset: 80;
            }

            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes animateShadow {
            0% {
                opacity: 0;
                width: 100%;
                height: 15%;
            }

            25% {
                opacity: 0.25;
            }

            43.75% {
                width: 40%;
                height: 7%;
                opacity: 0.35;
            }

            100% {
                width: 85%;
                height: 15%;
                opacity: 0.25;
            }
        }
    </style>

    <div class="container mx-auto px-4 py-40 flex flex-col items-center justify-center h-screen">
        <div class="main-container pb-4">
            <div class="check-container">
                <div class="check-background">
                    <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="check-shadow"></div>
            </div>
        </div>
        <div
            class="grid justify-items-center animate-fade-up animate-once animate-duration-[2000ms] animate-delay-[1000ms] animate-ease-out">
            <h1 class="text-3xl font-bold my-4 text-center">El <span
                    class="text-transparent bg-clip-text bg-gradient-to-r to-blue-600 from-sky-400">ticket</span> ha
                sido
                completado exitosamente.
                <h3 class="text-lg text-center w-full lg:w-1/2">Gracias por llenar nuestro formulario y usar nuestros
                    servicios. Te
                    invitamos a revisar nuestros servicios y productos en la página principal de <span
                        class="text-transparent bg-clip-text bg-gradient-to-r to-blue-600 from-sky-400">ATLANTIDA</span>.
                </h3>
                <div class="mt-8">
                    <a type="button" href="https://atlantida.mx/mercurio"
                        class="mt-4 bg-gray-100 border border-gray-300 hover:bg-gray-200 text-blue-700 font-bold py-2 px-5 rounded-full">Página
                        principal</a>
                    <!-- <button onclick="location.href='../index'"
                        class="mt-4 bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-5 rounded-full">Volver a
                        mis tickets</button> -->
                </div>
        </div>
    </div>

    <?php include('../components/footer.php'); ?>

    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>