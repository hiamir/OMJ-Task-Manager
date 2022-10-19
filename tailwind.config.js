const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],
    tailwindConfig: './styles/tailwind.config.js',
    darkMode: 'class',
    variants: {
        scrollbar: ['dark']
    },
    theme: {
        colors: {
          'oblue':{
              100: '#05234B',
              200: '#052044',
              300: '#041C3C',
              400: '#041935',
              500: '#03152D',
              600: '#031226',
              700: '#020E1E',
              800: '#010A16',
              900: '#01070F',
          },
            'olblue':{
                100: '#e6e9ed',
                200: '#cdd3db',
                300: '#b4bdc9',
                400: '#9ba7b7',
                500: '#8291a5',
                600: '#697b93',
                700: '#506581',
                800: '#374f6f',
                900: '#05234b',
            },
            'oyellow':{
                900: '#FFCC01',
                800: '#FFCC01',
                700: '#FFD634',
                600: '#FFDB4D',
                500: '#FFE067',
                400: '#ffe680',
                300: '#FFEB99',
                200: '#FFF0B3',
                100: '#FFF5CC',
            }
        },
        screens: {
            xs: '320px',
            sm: '480px',
            md: '768px',
            lg: '1024px',
            xl: '1200px',
            xxl: '1400px',
            xxxl: '1600px',
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('tailwind-scrollbar'),require('@tailwindcss/typography'),require('flowbite/plugin'),require('prettier-plugin-tailwindcss')],
};
