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
          white:'#f2f7fc',
          'white-2': '#ddecfd',
          'white-3': '#89b5e6',
          'light-2': '#0d6cd9',
          light: '#0a58b3',
          DEFAULT:'#01438e',
          dark: '#001f42'
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
