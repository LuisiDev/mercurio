document.getElementById('openRevisionButton').addEventListener('click', function() {
    document.getElementById('revision-modal').classList.remove('hidden');
});

document.getElementById('guardar-revision').addEventListener('click', function() {
    const selectedTime = document.querySelector('input[name="timetable"]:checked').value;
    const datepicker = document.querySelector('[inline-datepicker]').querySelector('input').value;
    const datetime = `${datepicker} ${selectedTime}`;
    document.getElementById('fhRevision').value = datetime;

    document.getElementById('revision-modal').classList.add('hidden');
});

document.getElementById("checkCorreo").addEventListener("click", function() {
    var showCorreo = document.getElementById("showCorreo");
    var correo = document.getElementById("correo");
    if (this.checked) {
        showCorreo.style.display = "block";
    } else {
        showCorreo.style.display = "none";
        correo.value = "";
    }
});

var loadFile = function(event) {
    var input = event.target;
    var file = input.files[0];
    var type = file.type;

    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src);
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
    output.src = ''; //Elimina el src de la imagen
    document.getElementById('btnMostrar').classList.add('hidden');
    document.getElementById('btnEliminar').classList.add('hidden');
    document.getElementById('evidencia').value = '';
}