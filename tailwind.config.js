/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'custom-coral': '#F7957B',
        'custom-yellow': '#FFD07E',
        'custom-teal': '#88E7D1'
      },
    },
  },
  plugins: [],
}

