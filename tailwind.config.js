const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        cyan: colors.cyan,
        turquoise: {
          light: '#3ba7ff',
          DEFAULT: '#118DF0',
          dark: '#0768b8'
        },
        deep: {
          white:'#b1d5ff',
          light: '#0a58b3',
          DEFAULT:'#01438e',
          dark: '#022f62'
        }
      }
    },
  },
  variants: {
    extend: {
      backgroundColor: ['active'],
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
