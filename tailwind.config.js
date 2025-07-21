/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                title: ['Bayon', 'sans-serif'],
                text: ['"Public Sans"', 'sans-serif'],
                handwriting: ['"Crafty Girls"', 'cursive'],
            },
            colors: {
                hwblue: '#00B3FD',
                hwblack: '#0A0809',
                hwpink: '#F962C9',
                hwgreen: '#DCFBA9',
            },
        },
    },
    plugins: [],
};
