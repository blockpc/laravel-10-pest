const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './Blockpc/resources/views/*.blade.php',
        './Packages/**/resources/views/*.blade.php'
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
            }),
            padding: {
                '1/3': '33.33333%',
                '2/3': '66.66666%'
            },
            colors: {
                'primary': '#FD3D57',
                'secondary': '#0f172a'
            },
            flex: {
                'center-2': '0 0 calc(50% - 20px)',
                'center-4': '0 0 calc(25% - 20px)',
            }
        },
    },
    
    variants: {
        scrollbar: ['dark']
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwind-scrollbar'),
        require('@tailwindcss/aspect-ratio')
    ],
};
