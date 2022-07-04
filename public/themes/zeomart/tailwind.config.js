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
        container: {
            padding: {
                DEFAULT: '14px'
            },
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1188px',
                '2xl': '1428px'
            }
        },
        fontSize: {
            '3xl': ['1.75rem', '2.5rem']
        }
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        // ...
    ],
}
