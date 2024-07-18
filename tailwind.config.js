/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
  ],
    darkMode: 'class', // Enable class-based dark mode
    theme: {
        extend: {
            colors: {
                // Custom color schemes for light and dark mode
                light: {
                    background: '#ffffff',
                    text: '#000000',
                },
                dark: {
                    background: '#1a202c',
                    text: '#ffffff',
                },
            },
            animation: {
                'animate-spin': 'spin 3s linear infinite',
            }
        },
    },
  plugins: [],
}

