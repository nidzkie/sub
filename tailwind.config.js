import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0f4ff',
                    100: '#e6ecff',
                    200: '#c8d9ff',
                    300: '#a5bfff',
                    400: '#7d9dff',
                    500: '#5a7bff',
                    600: '#3b52ff',
                    700: '#3263e6',
                    800: '#2850d8',
                    900: '#1f42b5',
                },
                accent: {
                    50: '#faf5ff',
                    100: '#f3e8ff',
                    200: '#e9d5ff',
                    300: '#d8b4fe',
                    400: '#c084fc',
                    500: '#a855f7',
                    600: '#9333ea',
                    700: '#7e22ce',
                    800: '#6b21a8',
                    900: '#581c87',
                },
            },
            backgroundImage: {
                'gradient-primary': 'linear-gradient(135deg, #3b52ff 0%, #7e22ce 100%)',
                'gradient-primary-light': 'linear-gradient(135deg, #3263e6 0%, #9333ea 100%)',
                'gradient-to-purple': 'linear-gradient(to right, #3263e6, #8B5CF6)',
            },
            backgroundClip: {
                text: 'text',
            },
            textFillColor: {
                transparent: 'transparent',
            },
        },
    },

    plugins: [forms, typography],
};
