/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    colors: {
        'secondary': '#F5EB69',
        'primary': '#1B2E47',
        'primary-gray': '#191F23',
        'secondary-gray': '#F6F6F6',
    },
  },
  plugins: [],
}

