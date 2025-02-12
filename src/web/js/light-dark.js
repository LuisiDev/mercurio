import Prism from 'https://cdn.skypack.dev/prismjs'

// Obtener el tema actual desde localStorage o usar 'light' por defecto
let currentTheme = localStorage.getItem('theme') || 'light';

// Aplicar el tema guardado al cargar la página
document.documentElement.className = currentTheme;

// Crear un elemento de estilo para inyectar CSS
let styleElement = document.createElement('style');
document.head.appendChild(styleElement);

let activeButton = null;

const injectCSS = (css) => {
  styleElement.textContent = css;
};

const SWITCH = (button, animation) => {
  const newTheme = currentTheme === 'light' ? 'dark' : 'light';
  button.setAttribute("aria-pressed", newTheme === 'dark');
  document.documentElement.className = newTheme;
  currentTheme = newTheme;
  localStorage.setItem('theme', newTheme); // Guardar el tema en localStorage
  injectCSS(animation.css);
};

const updateButtonStates = () => {
  document.querySelectorAll('.theme-toggle').forEach(btn => {
    if (btn === activeButton) {
      btn.disabled = false;
      btn.setAttribute("aria-pressed", currentTheme === 'dark');
    } else {
      btn.disabled = currentTheme === 'dark';
      btn.setAttribute("aria-pressed", "false");
    }
  });
};

const TOGGLE_THEME = (button, animation) => {
  if (activeButton && activeButton !== button) {
    return; // Si hay un botón activo y no es este, no hacer nada
  }

  if (!document.startViewTransition) {
    SWITCH(button, animation);
    activeButton = currentTheme === 'dark' ? button : null;
    updateButtonStates();
  } else {
    const transition = document.startViewTransition(() => {
      SWITCH(button, animation);
      activeButton = currentTheme === 'dark' ? button : null;
    });
    transition.finished.then(() => {
      updateButtonStates();
    });
  }
};

const getAnimationByName = (name) => {
  return ANIMATIONS.find(animation => animation.name === name);
};

// Usar delegación de eventos en el cuerpo del documento
document.body.addEventListener('click', (event) => {
  if (event.target.classList.contains('theme-toggle') && !event.target.disabled) {
    const animationName = event.target.dataset.animation;
    const animation = getAnimationByName(animationName);
    
    if (animation) {
      TOGGLE_THEME(event.target, animation);
    } else {
      console.warn(`Animation "${animationName}" not found for button:`, event.target);
    }
  }
});

// Contenedores de demostración
const DEMO_CONTAINER = document.getElementById("demo-container");

ANIMATIONS.forEach((animation) => {
  const button = document.createElement("button");
  button.setAttribute("aria-pressed", "false");
  button.className = "theme-toggle";
  button.dataset.animation = animation.name;
  button.textContent = animation.name;
  DEMO_CONTAINER.appendChild(button);
});

// Configuración inicial del estado del botón
updateButtonStates();

// Aplicar el tema guardado al cargar la página
document.documentElement.className = currentTheme;