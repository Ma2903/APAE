//todas as funções globais do view
document.querySelectorAll('#toggle-password').forEach((botton,index) => {
    botton.addEventListener('click', function () {
        const passwordInput = document.getElementById(`password${index}`);
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
}) 