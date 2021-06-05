const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                cyan: colors.cyan,
                'azure-radiance': {
                    DEFAULT: '#00A8FF',
                    '50': '#E5F6FF',
                    '100': '#CCEEFF',
                    '200': '#99DCFF',
                    '300': '#66CBFF',
                    '400': '#33B9FF',
                    '500': '#00A8FF',
                    '600': '#0086CC',
                    '700': '#006599',
                    '800': '#004366',
                    '900': '#002233'
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
