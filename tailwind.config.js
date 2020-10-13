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
            borderRadius: {
                xl: '1.5rem'
            },
            colors: {
                'primary': '#ff4e00',
                'secondary': '#ec9f05',
                'logo': '#F58634'
            },
            fontFamily: {
                sans: ['Commissioner', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
