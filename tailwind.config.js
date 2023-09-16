/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",

        "./vendor/wireui/wireui/resources/**/*.blade.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/View/**/*.php",

        // "./app/Http/Livewire/**/*Table.php",
        // "./vendor/power-components/livewire-powergrid/resources/views/**/*.php",
        // "./vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php",

        // "node_modules/preline/dist/*.js",
    ],
    presets: [
        // require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
        require("./vendor/wireui/wireui/tailwind.config.js"),
    ],
    theme: {
        colors: {
            ...colors,
        },
        extend: {},
    },
    // plugins: [require("flowbite/plugin"), require("daisyui")],
    plugins: [
        require("flowbite/plugin"),
        // require("daisyui"),

        require("@tailwindcss/forms")({
            strategy: "class",
        }),
        require("@tailwindcss/aspect-ratio"),
        // require("@tailwindcss/typography"),
        // require("preline/plugin"),
    ],
};
