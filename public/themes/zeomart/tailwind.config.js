/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "../../../themes/Zeomart/**/*.blade.php",
        "./js/**/*.vue",
    ],
    theme: {
        extend: {
            borderRadius: {
                '16':'16px'
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        // ...
    ],
}
