import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', 'Georgia', 'Times New Roman', 'serif'],
                display: ['"Playfair Display"', 'Georgia', 'Times New Roman', 'serif'],
            },
            colors: {
                primary: {
                    50: '#edf5f0',
                    100: '#d7e9df',
                    200: '#b0d4c3',
                    300: '#82b9a0',
                    400: '#559b7d',
                    500: '#387e61',
                    600: '#2a654c',
                    700: '#23513e',
                    800: '#1e4133',
                    900: '#19362b',
                    950: '#0c1f18',
                },
                accent: {
                    50: '#fbf8ec',
                    100: '#f6efd0',
                    200: '#eddfa0',
                    300: '#e1c86b',
                    400: '#d0ab40',
                    500: '#b58e29',
                    600: '#926f21',
                    700: '#75571e',
                    800: '#5f471d',
                    900: '#523c1b',
                    950: '#2f210d',
                },
                cta: {
                    50: '#faf6ef',
                    100: '#f4ebd6',
                    200: '#e8d4aa',
                    300: '#d9b877',
                    400: '#c99a4d',
                    500: '#b98032',
                    600: '#9d6529',
                    700: '#7d4c26',
                    800: '#663e24',
                    900: '#573421',
                    950: '#301b12',
                },
                cream: {
                    50: '#fbfaf6',
                    100: '#f5f1e8',
                    200: '#ece4d3',
                    300: '#dfd2ba',
                },
                success: {
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    500: '#10b981',
                    600: '#059669',
                    700: '#047857',
                },
                warning: {
                    50: '#fff9eb',
                    100: '#fdeec7',
                    500: '#e8a13a',
                    600: '#c9811c',
                    700: '#a66317',
                },
                danger: {
                    50: '#fdf1f0',
                    100: '#fbdfdd',
                    500: '#e05d52',
                    600: '#c94337',
                    700: '#a2332a',
                },
            },
            boxShadow: {
                'glow': '0 0 18px -4px rgba(208, 171, 64, 0.45)',
                'glow-accent': '0 0 18px -4px rgba(185, 128, 50, 0.45)',
                'card': '0 1px 2px rgba(25, 54, 43, 0.04), 0 8px 24px -12px rgba(25, 54, 43, 0.12)',
                'card-hover': '0 2px 4px rgba(25, 54, 43, 0.05), 0 20px 40px -16px rgba(25, 54, 43, 0.22)',
            },
            animation: {
                'fade-in': 'fadeIn 0.3s ease-out',
                'fade-in-up': 'fadeInUp 0.5s ease-out both',
                'slide-in': 'slideIn 0.3s ease-out',
                'slide-in-right': 'slideInRight 0.3s ease-out',
                'float': 'float 6s ease-in-out infinite',
                'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'spin-slow': 'spin 14s linear infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideIn: {
                    '0%': { transform: 'translateY(-10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                slideInRight: {
                    '0%': { transform: 'translateX(10px)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
            },
        },
    },

    plugins: [forms],
};
