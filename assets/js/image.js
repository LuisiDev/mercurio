document.addEventListener("DOMContentLoaded", function () {
  var estadoSelect = document.getElementById("estado");
  var evidenciaInicioDiv = document.getElementById("evidenciaInicio");
  var evidenciaRealizoDiv = document.getElementById("evidenciaRealizo");
  var evidenciaTerminadoDiv = document.getElementById("evidenciaTerminado");
  var inputsEvidencia = document.querySelectorAll('input[type="file"]');
  var outputImage = document.getElementById("output");

  function toggleEvidencia() {
    evidenciaInicioDiv.style.display = "none";
    evidenciaRealizoDiv.style.display = "none";
    evidenciaTerminadoDiv.style.display = "none";

    resetFileInputsAndHideImage();

    if (estadoSelect.value === "2") {
      evidenciaInicioDiv.style.display = "block";
    } else if (estadoSelect.value === "3") {
      evidenciaRealizoDiv.style.display = "block";
    } else if (estadoSelect.value === "4") {
      evidenciaTerminadoDiv.style.display = "block";
    }
  }

  // Función para resetear los inputs de archivo, ocultar la imagen de vista previa y los botones
  function resetFileInputsAndHideImage() {
    inputsEvidencia.forEach(function (input) {
      input.value = ""; // Resetea el input de archivo
    });
    document.getElementById("btnMostrar").classList.add("hidden"); // Oculta el botón de mostrar
    document.getElementById("btnEliminar").classList.add("hidden"); // Oculta el botón de eliminar
    document.getElementById("btnEditar").classList.add("hidden"); // Oculta el botón de editar
  }

  // Llama a toggleEvidencia al cargar la página para establecer la visibilidad inicial correctamente
  toggleEvidencia();

  // Agrega el evento change al select de estado
  estadoSelect.addEventListener("change", toggleEvidencia);
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
    showImageEvidenceForm(this);
  };

  document.getElementById("btnMostrar").classList.remove("hidden");
  document.getElementById("btnEliminar").classList.remove("hidden");
};

function showImageEvidenceForm(element) {
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

function showImageEvidence(element) {
  var imageUrl = element.src;
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
  image.src = imageUrl;
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
  document.getElementById("btnEditar").classList.add("hidden");

  if (currentInputId) {
    document.getElementById(currentInputId).value = ""; // Resetea el input de archivo específico
  }

  if (objectURL) {
    URL.revokeObjectURL(objectURL);
    objectURL = null;
  }

  file = null;
}

let isEditing = false; // Indica si estamos en modo edición

function editImage() {
  // Obtener la imagen a editar
  var image = document.getElementById("output");
  if (!image) return;

  // Crear una superposición para mostrar la imagen en grande
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

  // Crear un canvas para editar la imagen
  var canvas = document.createElement("canvas");
  canvas.style.maxWidth = "90%";
  canvas.style.maxHeight = "90%";
  var ctx = canvas.getContext("2d");

  // Crear un elemento de imagen para cargar la imagen original
  var img = new Image();
  img.src = image.src;

  img.onload = function () {
    // Configurar el canvas con el tamaño de la imagen
    canvas.width = img.width;
    canvas.height = img.height;
    ctx.drawImage(img, 0, 0);

    // Añadir el canvas a la superposición
    overlay.appendChild(canvas);

    //Crear el botón de cancelar
    var cancelButton = document.createElement("button");
    cancelButton.textContent = "Cancelar";
    cancelButton.style.position = "absolute";
    cancelButton.style.bottom = "20px";
    cancelButton.style.left = "20px";
    cancelButton.style.padding = "10px 20px";
    cancelButton.style.fontSize = "16px";
    cancelButton.style.backgroundColor = "#f44336";
    cancelButton.style.color = "white";
    cancelButton.style.border = "none";
    cancelButton.style.borderRadius = "5px";
    cancelButton.style.cursor = "pointer";
    overlay.appendChild(cancelButton);

    // Crear el botón de guardar
    var saveButton = document.createElement("button");
    saveButton.textContent = "Guardar";
    saveButton.style.position = "absolute";
    saveButton.style.bottom = "20px";
    saveButton.style.right = "20px";
    saveButton.style.padding = "10px 20px";
    saveButton.style.fontSize = "16px";
    saveButton.style.backgroundColor = "#4CAF50";
    saveButton.style.color = "white";
    saveButton.style.border = "none";
    saveButton.style.borderRadius = "5px";
    saveButton.style.cursor = "pointer";
    overlay.appendChild(saveButton);

    // Añadir el overlay al body
    document.body.appendChild(overlay);

    // Configurar el evento de dibujo
    var drawing = false;
    canvas.addEventListener("mousedown", function (e) {
      drawing = true;
      ctx.beginPath();
      ctx.moveTo(e.offsetX, e.offsetY);
    });

    canvas.addEventListener("mousemove", function (e) {
      if (drawing) {
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
      }
    });

    canvas.addEventListener("mouseup", function () {
      drawing = false;
    });

    // Cambiar el color del pincel a rojo
    ctx.strokeStyle = "red"; // Color del pincel

    // Cancelar la edición al hacer clic en el botón
    cancelButton.addEventListener("click", function () {
      document.body.removeChild(overlay); // Quitar la superposición
    });

    // Guardar los cambios al hacer clic en el botón
    saveButton.addEventListener("click", function () {
      saveImage(); // Llama a la función para guardar la imagen
      document.body.removeChild(overlay); // Quitar la superposición
    });

    // Permitir cerrar el overlay al hacer clic en la superposición
    overlay.addEventListener("click", function (e) {
      if (e.target === overlay) {
        document.body.removeChild(overlay);
      }
    });
  };
}

function saveImage() {
  const canvas = document.getElementById("canvas");

  // Obtener el ID del ticket
  const idTicketElement = document.querySelector('input[name="idTicket"]');
  if (!idTicketElement) {
    console.error("El elemento idTicket no se encuentra en el DOM.");
    return;
  }
  const idTicket = idTicketElement.value;

  // Determinar qué tipo de evidencia está activa
  let tipoEvidencia;
  if (document.getElementById("evidenciaAbierto").files.length > 0) {
    tipoEvidencia = "evidenciaAbierto";
  } else if (document.getElementById("evidenciaHaciendo").files.length > 0) {
    tipoEvidencia = "evidenciaHaciendo";
  } else if (document.getElementById("evidenciaHecho").files.length > 0) {
    tipoEvidencia = "evidenciaHecho";
  } else {
    console.error("No se encontró evidencia activa.");
    return;
  }

  // Convertir la imagen a base64
  const dataURL = canvas.toDataURL("image/png");

  // Enviar la imagen al servidor
  fetch("../../src/procesos/guardar-imagen.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `image=${encodeURIComponent(dataURL)}&idTicket=${encodeURIComponent(
      idTicket
    )}&tipoEvidencia=${encodeURIComponent(tipoEvidencia)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
      // Actualizar la visualización de la imagen editada
      const imgElement = document.getElementById(`output-${tipoEvidencia}`);
      imgElement.src = dataURL;
    })
    .catch((error) => console.error("Error:", error));
}
