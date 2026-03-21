import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.php',
        './resources/js/**/*.js',
    ],

    safelist: [
        'from-blue-50',
        'via-white',
        'to-indigo-50',
        'dark:from-slate-950',
        'dark:via-slate-900',
        'dark:to-slate-950',
        'dark:text-slate-100',
        'dark:text-slate-200',
        'dark:text-slate-300',
        'dark:bg-slate-950',
        'dark:bg-slate-900',
        'dark:bg-slate-950/80',
        'dark:border-slate-800',
        'dark:hover:bg-slate-800',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
