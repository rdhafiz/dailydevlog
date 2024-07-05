// Function to toggle theme
function toggleTheme(e) {
    const icon = document.getElementById('themeChangeIcon');
    const htmlElement = document.documentElement;
    if (htmlElement.classList.contains('dark')) {
        htmlElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        icon.src = `/icons/moon.svg`
    } else {
        htmlElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        icon.src = `/icons/sun.svg`
    }
}

// Set initial theme based on localStorage
document.addEventListener('DOMContentLoaded', () => {
    const icon = document.getElementById('themeChangeIcon');
    const savedTheme = localStorage.getItem('theme') || 'light';
    icon.src = `/icons/moon.svg`
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
        icon.src = `/icons/sun.svg`
    }
});
