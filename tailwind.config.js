import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const colors = require('tailwindcss/colors') 

/** @type {import('tailwindcss').Config} */

    
export default {
    darkMode: 'false',
    presets: [
		require('./vendor/tallstackui/tallstackui/tailwind.config.js'),
		 require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
        './app/Livewire/Tables/*Table.php', 
        './vendor/tallstackui/tallstackui/src/**/*.php', 
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php',
        './vendor/tallstackui/tallstackui/src/**/*.php', 
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "pg-primary": colors.gray, 
            },
        },
    },

    plugins: [
		forms,
		typography,
		require("daisyui")
	],
    // daisyUI config (optional - here are the default values)
   daisyui: {
    themes: false, // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
    darkTheme: "light", // name of one of the included themes for dark mode
    base: true, // applies background color and foreground color for root element by default
    styled: true, // include daisyUI colors and design decisions for all components
    utils: true, // adds responsive and modifier utility classes
    prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
    logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
    themeRoot: ":root", // The element that receives theme color CSS variables
  },

};
