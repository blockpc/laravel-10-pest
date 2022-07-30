const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-blue-500',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            height: theme => ({
                "sidebar": "calc(100vh - 64px)",
            })
        },
    },
    
    variants: {
        scrollbar: ['dark']
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwind-scrollbar')
    ],
};
