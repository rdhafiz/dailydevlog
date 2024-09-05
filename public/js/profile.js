document.getElementById('profile-update').addEventListener('submit', (e) => {
    document.getElementById('profileUpdateBtn').classList.add('hidden');
    document.getElementById('profileUpdateLoading').classList.remove('hidden');
})

document.getElementById('change-password').addEventListener('submit', (e) => {
    document.getElementById('changePasswordBtn').classList.add('hidden');
    document.getElementById('changePasswordLoader').classList.remove('hidden');
})


// Function of two word
function nameControl(userName) {
    let words = userName.split(' ');
    return ` ${words[0][0].toUpperCase()}${words[words.length - 1][0].toUpperCase()}`;
}

document.addEventListener('DOMContentLoaded', function() {
    return document.getElementById('user-data').getAttribute('data-username');
});

document.getElementById('change-password').addEventListener('submit', (e) => {
    document.getElementById('changePasswordBtn').classList.add('hidden');
    document.getElementById('changePasswordLoader').classList.remove('hidden');
})
