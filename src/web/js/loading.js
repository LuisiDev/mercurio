document.addEventListener("DOMContentLoaded", function () {
    // Cambiar los textos de carga cada 3 segundos
    const loadingTexts = document.querySelectorAll(".loading-texts span");
    let currentTextIndex = 0;
  
    setInterval(() => {
      loadingTexts[currentTextIndex].classList.remove("active");
      currentTextIndex = (currentTextIndex + 1) % loadingTexts.length;
      loadingTexts[currentTextIndex].classList.add("active");
    }, 3000);
  
    // Ocultar la pantalla de carga y mostrar el contenido de la página una vez que todo esté cargado
    window.addEventListener("load", function () {
      const loadingScreen = document.getElementById("loading-screen");
      const pageContent = document.getElementById("page-content");
  
      // Añadir la clase fade-out al body
      document.body.classList.add("fade-out");
  
      loadingScreen.style.opacity = "0";
      loadingScreen.style.visibility = "hidden";
      setTimeout(() => {
        loadingScreen.style.display = "none";
        pageContent.style.display = "block";
        pageContent.classList.add("fade-in"); // Añadir la clase fade-in al contenido
      }, 1000); // Tiempo para la transición de desvanecimiento
    });
  });
  