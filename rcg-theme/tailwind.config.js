/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './*.php',
        './inc/**/*.php',
        './page-templates/**/*.php',
        './template-parts/**/*.php',
        './assets/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#CC151B',
                'background-dark': '#0A0A0A',
                'background-light': '#FFFFFF',
                'surface-dark': '#1C1C1C',
                'surface-mid': '#2A2A2A',
                'accent-green': '#88B526',
                'accent-blue': '#13549E',
                'accent-amber': '#F59E0B',
                'accent-opinion': '#9333EA',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                serif: ['Lora', 'serif'],
                display: ['Inter', 'sans-serif'],
            },
            borderRadius: {
                btn: '2px',
            },
        },
    },
    plugins: [],
};
