window.closeAlert = function closeAlert() {
    const alertWrapper = document.querySelector('#alert-wrapper');
    alertWrapper.remove();
}

window.showPassword = function showPassword() {
    const passwordInput = document.querySelector('#password-input');
    const eyeClosedBtn = document.querySelector('#eye-close-btn');
    const eyeOpenBtn = document.querySelector('#eye-open-btn');

    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    eyeClosedBtn.classList.toggle('hidden');
    eyeOpenBtn.classList.toggle('hidden');
}