import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            screens: {
                'xs': '475px',
                '3xl': '1600px',
            },
            fontFamily: {
                primary: ['"Source Code Pro"', 'monospace'],
                secondary: ['"JetBrains Mono"', 'monospace'],
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
            },
            colors: {
                'primary': '#0F68E2',
                'secondary': '#f59e0b',
                'background': '#F0F4F4',
            },
        },
    },

    plugins: [forms],
};
