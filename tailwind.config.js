const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/preline/dist/*.js',
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
        './app/Http/Livewire/**/*.php',
    ],

    tailwindConfig: './styles/tailwind.config.js',
    darkMode: 'class',
    variants: {
        scrollbar: ['dark']
    },
    theme: {

        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            slate: colors.slate,
            neutral: colors.neutral,
            stone: colors.stone,
            red: colors.red,
            orange: colors.orange,
            amber: colors.amber,
            lime: colors.lime,
            green: colors.green,
            emerald: colors.emerald,
            teal: colors.teal,
            cyan: colors.cyan,
            sky: colors.sky,
            blue: colors.blue,
            indigo: colors.indigo,
            violet: colors.violet,
            purple: colors.purple,
            fuchsia: colors.fuchsia,
            pink: colors.pink,
            rose: colors.rose,
            zinc: colors.zinc,
            yellow: colors.yellow,
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

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwind-scrollbar'),
        require('@tailwindcss/typography'),
        require('prettier-plugin-tailwindcss'),
        require('preline/plugin'),
    ],
};
