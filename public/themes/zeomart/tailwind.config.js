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
            'xs': ['0.75rem', '1rem'],
            'sm': ['0.875rem', '1.25rem'],
            'base': ['1rem', '1.5rem'],
            'lg': ['1.125rem', '1.75rem'],
            'xl': ['1.25rem', '1.75rem'],
            'cxl': ['1.5rem', '2rem'],
            '3xl': ['1.75rem', '2.5rem'],
            '4xl': ['2.25rem', '2.5rem'],
            '5xl': ['3rem', '1'],
            '6xl': ['3.75rem', '1'],
            '7xl': ['4.5rem', '1'],
            '8xl': ['6rem', '1'],
            '9xl': ['8rem', '1']
        }
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        // ...
    ],
}
