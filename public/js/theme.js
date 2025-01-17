/* Function to light mode */
function lightMode() {
    const htmlElement = document.documentElement;
    if (htmlElement.classList.contains('dark')) {
        htmlElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
}

/* Function to dark mode */
function darkMode() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    if(savedTheme === 'light') {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
}

/* Set initial theme based on localStorage */
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'dark';
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
    }
});

