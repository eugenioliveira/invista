const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            backgroundImage: theme => ({
                'login-bg': "url('/img/back.jpg')",
            }),
            colors: {
                'primary': '#F58634'
            },
            fontFamily: {
                sans: ['Commissioner', ...defaultTheme.fontFamily.sans],
            },
            cursor: {
                help: 'help'
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        backgroundColor: ['responsive', 'hover', 'focus', 'checked'],
    },

    plugins: [require('@tailwindcss/ui')],
};
