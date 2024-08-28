/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
      ],
      theme: {
        extend: {
          fontFamily: {
            roboto: ['Roboto', 'sans-serif'],
            poppins: ['Poppins', 'sans-serif'],
          },
        },
      },
  plugins: [],
}

