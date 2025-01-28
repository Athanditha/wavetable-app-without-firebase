/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#000000',      // Black
        secondary: '#ffffff',    // White
        accent: '#b3b3b3',       // Light gray
        background: '#1a1a1a',   // Very dark gray
        card: '#e0e0e0',         // Light gray
        text: '#ffffff',         // Off-white
        'text-secondary': '#a6a6a6', // Medium gray
        'hover-link': '#cccccc', // Light gray
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'], 
        heading: ['Poppins', 'sans-serif'],
      },
      borderRadius: {
        'lg': '1rem', 
        'xl': '1.5rem',
      },
      boxShadow: {
        'soft': '0 4px 6px rgba(0, 0, 0, 0.05)',  // Soft shadow
        'hard': '0 10px 15px rgba(0, 0, 0, 0.1)', // Slightly stronger shadow
      },
    },
  },
  plugins: [
      
  ],
}
