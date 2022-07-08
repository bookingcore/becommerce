/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "../../../themes/Zeomart/**/*.blade.php",
        "../../../modules/Product/Views/admin/product/**/*.blade.php",
        "../Base/js/tailwind/**/*.js",
        "./js/**/*.vue",
    ],
    theme: {
        extend: {
            borderRadius: {
                '16':'16px'
            },
            container: {
                center: true,
                padding: '1rem',
                screens: {
                    '2xl': '1432px'
                }
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        // ...
    ],
}
