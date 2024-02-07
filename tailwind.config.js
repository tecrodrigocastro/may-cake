/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            backgroundImage: {
                'prefooter': "url('/public/images/prefooter.png')",

            }
        },
        fontFamily: {
            'sans': ['Nunito', 'sans-serif'],
            'nunito': ['Nunito', 'sans-serif'],
          },

    },
    plugins: [],
}

