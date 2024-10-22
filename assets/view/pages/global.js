//todas as funções globais do view
document.getElementById('toggle-password').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i'); // Seleciona o ícone dentro do botão

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

function validateEmail() {
    const email = document.getElementById('email').value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const iconCheck = document.querySelector('#email ~ .icon-check');
    const iconTimes = document.querySelector('#email ~ .icon-times');
    if (!emailPattern.test(email)) {
        document.getElementById('email-error').style.display = 'block';
        document.getElementById('email').classList.add('invalid');
        document.getElementById('email').classList.remove('valid');
        iconCheck.style.display = 'none';
        iconTimes.style.display = 'block';
        return false;
    } else {
        document.getElementById('email').classList.add('valid');
        document.getElementById('email').classList.remove('invalid');
        document.getElementById('email-error').style.display = 'none';
        iconCheck.style.display = 'block';
        iconTimes.style.display = 'none';
        return true;
    }
}

function validatePassword() {
    const password = document.getElementById('password').value;
    const iconCheck = document.querySelector('#password ~ .icon-check');
    const iconTimes = document.querySelector('#password ~ .icon-times');
    if (password.length < 4) {
        document.getElementById('password-error').style.display = 'block';
        document.getElementById('password').classList.add('invalid');
        document.getElementById('password').classList.remove('valid');
        iconCheck.style.display = 'none';
        iconTimes.style.display = 'block';
        return false;
    } else {
        document.getElementById('password').classList.add('valid');
        document.getElementById('password').classList.remove('invalid');
        document.getElementById('password-error').style.display = 'none';
        iconCheck.style.display = 'block';
        iconTimes.style.display = 'none';
        return true;
    }
}

document.getElementById('email').addEventListener('focus', function() {
    document.querySelector('#email ~ .icon-check').style.display = 'none';
    document.querySelector('#email ~ .icon-times').style.display = 'none';
});

document.getElementById('password').addEventListener('focus', function() {
    document.querySelector('#password ~ .icon-check').style.display = 'none';
    document.querySelector('#password ~ .icon-times').style.display = 'none';
});

document.getElementById('email').addEventListener('blur', validateEmail);
document.getElementById('password').addEventListener('blur', validatePassword);

document.getElementById('login-form').addEventListener('submit', function(event) {
    let valid = true;

    if (!validateEmail()) {
        valid = false;
    }

    if (!validatePassword()) {
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
    }
});