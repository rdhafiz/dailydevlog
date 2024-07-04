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
                light: {
                    background: '#F7F7F7',
                    primary: '#333333',
                    secondary: '#666666',
                    accent: '#007BFF',
                    border: '#DDDDDD',
                },
                dark: {
                    background: '#181818',
                    primary: '#E0E0E0',
                    secondary: '#888888',
                    accent: '#03DAC6',
                    border: '#333333',
                },

            },
        },
    },
  plugins: [],
}

