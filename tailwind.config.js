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
                    50: '#eef4fa',
                    100: '#dae7f2',
                    200: '#b7cfe5',
                    300: '#8db1d3',
                    400: '#648cbd',
                    500: '#4670a6',
                    600: '#35588a',
                    700: '#2b476e',
                    800: '#1c2f4b',
                    900: '#14213a',
                    950: '#0b1426',
                },
                accent: {
                    50: '#fbf7e9',
                    100: '#f6ecc9',
                    200: '#ecd894',
                    300: '#e2c25f',
                    400: '#d5ab3b',
                    500: '#c2942c',
                    600: '#a47624',
                    700: '#835b21',
                    800: '#6c4a20',
                    900: '#5c3e20',
                    950: '#36220f',
                },
                cta: {
                    50: '#fdf3ee',
                    100: '#fae4d7',
                    200: '#f4c6ab',
                    300: '#ec9f7a',
                    400: '#e4734b',
                    500: '#d9552e',
                    600: '#c5421f',
                    700: '#a4341c',
                    800: '#852b1e',
                    900: '#6d261d',
                    950: '#3b110c',
                },
                cream: {
                    50: '#fbfaf7',
                    100: '#f5f2ea',
                    200: '#ece6d8',
                    300: '#dfd5be',
                },
                success: {
                    50: '#eefaf3',
                    100: '#d8f3e3',
                    500: '#22a45f',
                    600: '#16864a',
                    700: '#12673b',
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
                'glow': '0 0 18px -4px rgba(198, 147, 44, 0.45)',
                'glow-accent': '0 0 18px -4px rgba(217, 85, 46, 0.45)',
                'card': '0 1px 2px rgba(20, 33, 58, 0.04), 0 8px 24px -12px rgba(20, 33, 58, 0.12)',
                'card-hover': '0 2px 4px rgba(20, 33, 58, 0.05), 0 20px 40px -16px rgba(20, 33, 58, 0.22)',
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
