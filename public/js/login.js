
// function of is remembered me
function isRemember(event) {
    event.target.value
}

document.getElementById('login-form').addEventListener('submit', (e) => {
    document.getElementById('submitBtn').classList.add('hidden');
    document.getElementById('loader').classList.remove('hidden');
})
