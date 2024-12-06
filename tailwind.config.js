/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}", "./node_modules/flowbite/**/*.js"],
  darkMode: "class", // or 'media' or 'class
  theme: {
    extend: {
      animation: {
        "fade-in": "fade-in 12s ease-in",
      },
      "fade-in": {
        "0%": {
          opacity: "0",
        },
        "100%": {
          opacity: "1",
        },
      },
    },
  },
  plugins: [
    require("flowbite/plugin")({
      charts: true,
      datatables: true,
    }),
    require("tailwindcss-animated"),
  ],
};
