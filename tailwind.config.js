const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        // colors: {
        //     // blue: '#3498db',
        //     // blue2: '#3732d9',
        //     // gray: {
        //     //     800: '#1f2937',
        //     //     900: '#111827'
        //     // },
        //     // yellow: {
        //     //     400: '#fbbf24',
        //     //     500: '#f59e0b'
        //     // },
        //     // black: 'black',
        //     // white: 'white',
        //     // bgPrimary: '#111827',
        //     // bgSecondary: '#1f2937',
        //     // buttonPrimary: '#3498db',
        //     // buttonSecondary: '#3732d9',
        //     // chatBg: '#3498db',
        //     // border: '#3498db',
        //     // text: 'white',
        // },
        screens: {
            'smxx': '320px',
            'smx': '425px',
            'sm2': '540px',
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1536px',
        }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
