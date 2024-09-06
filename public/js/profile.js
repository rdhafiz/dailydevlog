// profile update form actions
document.getElementById('profile-update').addEventListener('submit', (e) => {
    document.getElementById('profileUpdateBtn').classList.add('hidden');
    document.getElementById('profileUpdateLoading').classList.remove('hidden');
})

// change password form actions
document.getElementById('change-password').addEventListener('submit', (e) => {
    document.getElementById('changePasswordBtn').classList.add('hidden');
    document.getElementById('changePasswordLoader').classList.remove('hidden');
})

// update avatar form actions
const uploadProfileAvatar = document.getElementById('upload-profile-avatar');
if(uploadProfileAvatar) {
    uploadProfileAvatar.addEventListener('change', function() {
        document.getElementById('changeAvatar').classList.add('hidden');
        document.getElementById('changeAvatarLoader').classList.remove('hidden');
        const form = document.getElementById('update-avatar');
        form.submit();
    });
} else {

}
