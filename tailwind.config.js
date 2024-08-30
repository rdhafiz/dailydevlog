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
                second: '#AED725',
                primary: '#0C75ED',
                first: '#FFC108',
                dark3: '#333333',
                red: '#C8093F',
                secondary: '#556080',
                light2: '#ECEBF7',
            },
            animation: {
                'animate-spin': 'spin 3s linear infinite',
            }
        },
    },
  plugins: [],
}

