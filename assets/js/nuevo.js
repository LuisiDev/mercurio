document
  .getElementById("openRevisionButton")
  .addEventListener("click", function () {
    document.getElementById("revision-modal").classList.remove("hidden");
  });

document
  .getElementById("guardar-revision")
  .addEventListener("click", function () {
    const selectedTime = document.querySelector(
      'input[name="timetable"]:checked'
    ).value;
    const datepicker = document
      .querySelector("[inline-datepicker]")
      .querySelector("input").value;
    const datetime = `${datepicker} ${selectedTime}`;
    document.getElementById("fhRevision").value = datetime;

    document.getElementById("revision-modal").classList.add("hidden");
  });

document.getElementById("checkCorreo").addEventListener("click", function () {
  var showCorreo = document.getElementById("showCorreo");
  var correo = document.getElementById("correo");
  if (this.checked) {
    showCorreo.style.display = "block";
  } else {
    showCorreo.style.display = "none";
    correo.value = "";
  }
});

var currentInputId = ""; // Variable global para almacenar el ID del input actual
var objectURL = null; // Variable global para almacenar el objeto URL de la imagen cargada
var file = null; // Variable para almacenar el archivo cargado

var loadFile = function (event) {
  var input = event.target;
  file = input.files[0];

  if (!file) {
    return;
  }

  currentInputId = input.id; // Almacena el ID del input que cargó la imagen

  if (objectURL) {
    URL.revokeObjectURL(objectURL);
  }

  objectURL = URL.createObjectURL(file);

  var output = document.getElementById("output");
  output.src = objectURL;
  // output.classList.remove('hidden');

  output.onclick = function () {
    showImageEvidence(this);
  };

  document.getElementById("btnMostrar").classList.remove("hidden");
  document.getElementById("btnEliminar").classList.remove("hidden");
};

function showImageEvidence(element) {
  if (!objectURL || !file) {
    return;
  }

  var overlay = document.createElement("div");
  overlay.style.position = "fixed";
  overlay.style.top = "0";
  overlay.style.left = "0";
  overlay.style.width = "100%";
  overlay.style.height = "100%";
  overlay.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
  overlay.style.display = "flex";
  overlay.style.justifyContent = "center";
  overlay.style.alignItems = "center";
  overlay.style.zIndex = "9999";

  var image = document.createElement("img");
  image.src = objectURL;
  image.style.maxWidth = "90%";
  image.style.maxHeight = "90%";

  overlay.appendChild(image);
  document.body.appendChild(overlay);

  overlay.addEventListener("click", function () {
    document.body.removeChild(overlay);
  });
}

function showImage() {
  var output = document.getElementById("output");
  var btnEditar = document.getElementById("btnEditar");
  var canvas = document.getElementById("canvas");

  if (output.classList.contains("hidden")) {
    output.classList.remove("hidden");
    btnEditar.classList.remove("hidden");
    canvas.classList.add("hidden");
  } else {
    output.classList.add("hidden");
    btnEditar.classList.add("hidden");
    canvas.classList.add("hidden");
  }
}

function removeImage() {
  var output = document.getElementById("output");
  output.classList.add("hidden");
  output.src = ""; // Elimina el src de la imagen
  document.getElementById("btnMostrar").classList.add("hidden");
  document.getElementById("btnEliminar").classList.add("hidden");

  if (currentInputId) {
    document.getElementById(currentInputId).value = ""; // Resetea el input de archivo específico
  }

  if (objectURL) {
    URL.revokeObjectURL(objectURL);
    objectURL = null;
  }

  file = null;
}