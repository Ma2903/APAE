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

document.getElementById('login-form').addEventListener('submit', function(event) {
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let isValid = true;

    // Validação de e-mail
    if (!email.value || !email.value.includes('@')) {
        document.getElementById('email-error').style.display = 'block';
        email.setAttribute('aria-invalid', 'true');
        isValid = false;
    } else {
        document.getElementById('email-error').style.display = 'none';
        email.setAttribute('aria-invalid', 'false');
    }

    // Validação de senha
    if (!password.value || password.value.length < 4) {
        document.getElementById('password-error').style.display = 'block';
        password.setAttribute('aria-invalid', 'true');
        isValid = false;
    } else {
        document.getElementById('password-error').style.display = 'none';
        password.setAttribute('aria-invalid', 'false');
    }

    // Impedir submissão se houver erros
    if (!isValid) {
        event.preventDefault();
    }
});

document.getElementById('email-error').classList.add('show');