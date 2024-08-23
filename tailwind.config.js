/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}", "./node_modules/flowbite/**/*.js"],
  darkMode: 'class', // or 'media' or 'class
  theme: {
    extend: {},
  },
  plugins: [
    require("flowbite/plugin")({
      charts: true,
    }),
    require("flowbite/plugin")({
      datatables: true,
    }),
  ],
};
