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
            fontFamily: {
                primary: ['"Source Code Pro"', 'monospace'],
                secondary: ['"JetBrains Mono"', 'monospace'],
            },
            colors: {
                primary: '#0F68E2',
                'background': '#F0F4F4',
            },
        },
    },

    plugins: [forms],
};
