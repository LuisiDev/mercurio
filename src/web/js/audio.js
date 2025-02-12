const init = () => {
    const tieneSoporteUserMedia = () =>
        !!(navigator.mediaDevices.getUserMedia)

    if (typeof MediaRecorder === "undefined" || !tieneSoporteUserMedia())
        return alert("Tu navegador web no cumple los requisitos; por favor, actualiza a un navegador decente como Firefox o Google Chrome");

    const $listaDeDispositivos = document.querySelector("#listaDeDispositivos"),
        $duracion = document.querySelector("#duracion"),
        $btnComenzarGrabacion = document.querySelector("#btnComenzarGrabacion"),
        $btnDetenerGrabacion = document.querySelector("#btnDetenerGrabacion"),
        $idTicket = document.querySelector("#idTicket"); // Asegúrate de tener un campo oculto con el ID del ticket

    const limpiarSelect = () => {
        for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--) {
            $listaDeDispositivos.options.remove(x);
        }
    }

    const segundosATiempo = numeroDeSegundos => {
        let horas = Math.floor(numeroDeSegundos / 60 / 60);
        numeroDeSegundos -= horas * 60 * 60;
        let minutos = Math.floor(numeroDeSegundos / 60);
        numeroDeSegundos -= minutos * 60;
        numeroDeSegundos = parseInt(numeroDeSegundos);
        if (horas < 10) horas = "0" + horas;
        if (minutos < 10) minutos = "0" + minutos;
        if (numeroDeSegundos < 10) numeroDeSegundos = "0" + numeroDeSegundos;

        return `${horas}:${minutos}:${numeroDeSegundos}`;
    };

    let tiempoInicio, mediaRecorder, idIntervalo;
    const refrescar = () => {
        $duracion.textContent = segundosATiempo((Date.now() - tiempoInicio) / 1000);
    }

    const llenarLista = () => {
        navigator
            .mediaDevices
            .enumerateDevices()
            .then(dispositivos => {
                limpiarSelect();
                dispositivos.forEach((dispositivo, indice) => {
                    if (dispositivo.kind === "audioinput") {
                        const $opcion = document.createElement("option");
                        $opcion.text = dispositivo.label || `Dispositivo ${indice + 1}`;
                        $opcion.value = dispositivo.deviceId;
                        $listaDeDispositivos.appendChild($opcion);
                    }
                })
            })
    };

    const comenzarAContar = () => {
        tiempoInicio = Date.now();
        idIntervalo = setInterval(refrescar, 500);
    };

    const comenzarAGrabar = () => {
        if (!$listaDeDispositivos.options.length) return alert("No hay ningún dispositivo de audio seleccionado.");
        if (mediaRecorder) return alert("Ya se está grabando el audio.");

        navigator.mediaDevices.getUserMedia({
            audio: {
                deviceId: $listaDeDispositivos.value,
            }
        })
        .then(stream => {
            mediaRecorder = new MediaRecorder(stream);
            mediaRecorder.start();
            comenzarAContar();
            const fragmentosDeAudio = [];
            mediaRecorder.addEventListener("dataavailable", evento => {
                fragmentosDeAudio.push(evento.data);
            });
            mediaRecorder.addEventListener("stop", () => {
                stream.getTracks().forEach(track => track.stop());
                detenerConteo();
                const blobAudio = new Blob(fragmentosDeAudio);
                const formData = new FormData();
                formData.append("audio", blobAudio);
                formData.append("idTicket", $idTicket.value); // Añadir el ID del ticket al FormData
                const RUTA_SERVIDOR = "../procesos/guardar-audio.php";
                $duracion.textContent = "Enviando el audio...";
                fetch(RUTA_SERVIDOR, {
                    method: "POST",
                    body: formData,
                })
                .then(respuestaRaw => respuestaRaw.text())
                .then(respuestaTexto => {
                    console.log("La respuesta del archivo es: ", respuestaTexto);
                    document.getElementById("audio_seleccionado").value = respuestaTexto;
                    $duracion.innerHTML = `<strong>Audio subido correctamente</strong>&nbsp; <a target="_blank" href="evidencias/audios/${respuestaTexto}">Abrir</a>`
                })
            });
        })
        .catch(error => {
            console.log(error)
        });
    };

    const detenerConteo = () => {
        clearInterval(idIntervalo);
        tiempoInicio = null;
        $duracion.textContent = "";
    }

    const detenerGrabacion = () => {
        if (!mediaRecorder) return alert("No se está grabando ningún dispositivo de audio.");
        mediaRecorder.stop();
        mediaRecorder = null;
    };

    $btnComenzarGrabacion.addEventListener("click", comenzarAGrabar);
    $btnDetenerGrabacion.addEventListener("click", detenerGrabacion);

    llenarLista();
}

document.addEventListener("DOMContentLoaded", init);