import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'Rosewater': '#f2d5cf',
                'Flamingo': '#eebebe',
                'Pink': '#f4b8e4',
                'Mauve': '#ca9ee6',
                'Red': '#e78284',
                'Maroon': '#ea999c',
                'Peach': '#ef9f76',
                'Yellow': '#e5c890',
                'Green': '#a6d189',
                'Teal': '#81c8be',
                'Sky': '#99d1db',
                'Sapphire': '#85c1dc',
                'Blue': '#8caaee',
                'Lavender': '#babbf1',
                'Text': '#c6d0f5',
                'Subtext_1': '#b5bfe2',
                'Subtext_0': '#a5adce',
                'Overlay_2': '#949cbb',
                'Overlay_1': '#838ba7',
                'Overlay_0': '#737994',
                'Surface_2': '#626880',
                'Surface_1': '#51576d',
                'Surface_0': '#414559',
                'Base': '#303446',
                'Mantle': '#292c3c',
                'Crust': '#232634'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
