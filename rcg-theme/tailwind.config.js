/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './**/*.php',
        './assets/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#CC151B',
                'background-dark': '#0A0A0A',
                'background-light': '#FFFFFF',
                'surface-dark': '#1C1C1C',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            borderRadius: {
                btn: '2px',
            },
        },
    },
    plugins: [],
};
