const togglePassword = document.querySelector('.eye-icon');
const password = document.querySelector('.box2');

togglePassword.addEventListener('click', function (e) {
    
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    togglePassword.classList.toggle('bxs-hide');
    togglePassword.classList.toggle('bxs-show');
});

