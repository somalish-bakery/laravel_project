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
            colors: {
                // Changed from khmerOrange to 'khmer-orange' to match your Blade file
                'khmer-orange': '#E67E00',
                'khmer-cream': '#FDFBF7',
            },
        },
    },

    plugins: [forms],
};