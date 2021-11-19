const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
  purge: [
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      backgroundImage: (theme) => ({
        'login-bg': "url('/img/back.jpg')",
      }),
      colors: {
        primary: '#F58634',
        orange: colors.orange,
      },
      fontFamily: {
        sans: ['Commissioner', ...defaultTheme.fontFamily.sans],
      },
      cursor: {
        help: 'help',
      },
    },
  },
  variants: {
    opacity: ['responsive', 'hover', 'focus', 'disabled', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'focus', 'checked'],
  },
  plugins: [],
};
