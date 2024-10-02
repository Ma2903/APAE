<?php
require_once __DIR__ . "/../../../controller/userController.php";
$userController = new ControladorUsuarios();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Etapa 1: Envio do código
//     if (isset($_POST['email'])) {
//         $email = $_POST['email'];
//         // Aqui, você pode implementar a lógica para enviar um código para o e-mail, se necessário.

//         // Para este exemplo, vamos supor que o código é enviado corretamente.
//         echo "<script>document.getElementById('email-form').style.display = 'none'; document.getElementById('reset-form').style.display = 'block';</script>";
//     }

//     // Etapa 2: Verificação da resposta da pergunta de segurança e alteração da senha
//     if (isset($_POST['resposta-seguranca']) && isset($_POST['password'])) {
//         $respostaSeguranca = $_POST['resposta-seguranca'];
//         $novaSenha = $_POST['password'];
//         $email = $_POST['email']; // Capturando o e-mail do formulário

//         // Verificando a pergunta de segurança
//         if (verificarSeguranca($email, $respostaSeguranca)) {
//             // Se a resposta estiver correta, alterar a senha
//             if (alterarSenha($email, $novaSenha)) {
//                 echo "<p>Senha alterada com sucesso!</p>";
//             } else {
//                 echo "<p>Erro ao alterar a senha. Tente novamente.</p>";
//             }
//         } else {
//             echo "<p>Resposta de segurança incorreta. Tente novamente.</p>";
//         }
//     }
// }

// Função para verificar a resposta da pergunta de segurança
function verificarSeguranca($email, $respostaSeguranca) {
    global $userController; // Acesso ao controlador

    // Consultar no banco de dados a pergunta e resposta de segurança do usuário
    $usuario = $userController->getUsuarioPorEmail();
    
    if ($usuario) {
        return $usuario['pergunta_seguranca'] === $respostaSeguranca; // Comparar com a resposta cadastrada
    }

    return false; // Usuário não encontrado
}

// Função para alterar a senha
function alterarSenha($email, $novaSenha) {
    global $userController;

    // Aqui você pode chamar a função do controlador que altera a senha
    return $userController->alterarSenha($email, password_hash($novaSenha, PASSWORD_DEFAULT)); // Hash da nova senha antes de armazenar
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - APAE</title>
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="../global.js"></script>
</head>
<body>
    <section class="container">
        <section class="left-section">
            <img src="../../../../src/logo0.jpg" alt="Logo" class="logo">
            <h2>Redefinir Senha</h2>
            <p>Digite sua nova senha abaixo para redefini-la.</p>
            <a href="../index.php" class="back-link">Voltar para o Login</a>
        </section>
        <section class="right-section">
            <h2>Redefinir Senha</h2>
            
            <!-- Etapa 1: Solicitação do e-mail para envio do código -->
            <form action="" method="POST" id="email-form">
                <section class="input-container">
                    <label for="email">E-mail:</label>
                    <input name="email" type="email" id="email" placeholder="Digite seu e-mail" required>
                </section>
                <button type="submit">Enviar Código</button>
            </form>
            
            <!-- Etapa 2: Formulário para redefinir senha com o código e resposta de segurança -->
            <form action="" method="POST" id="reset-form" style="display:none;">
                <input type="hidden" name="email" value="" id="hidden-email">
                <section class="input-container">
                    <label for="resposta-seguranca">Pergunta de segurança:</label>
                    <input name="resposta-seguranca" type="text" id="resposta-seguranca" placeholder="Digite sua resposta de segurança" required>
                </section>
                
                <section class="input-container">
                    <label for="new-password">Nova Senha:</label>
                    <input name="password" type="password" id="password" placeholder="******" required>
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </section>
                
                <section class="input-container">
                    <label for="confirm-password">Confirmar Nova Senha:</label>
                    <input name="password" type="password" id="confirm-password" placeholder="******" required>
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </section>
                <button type="submit">Redefinir Senha</button>
            </form>
        </section>
    </section>

    <script>
        // Simulação de controle para mostrar o segundo formulário após o envio do código
        document.getElementById('email-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Lógica para capturar o e-mail e simular envio de código
            const email = document.getElementById('email').value;
            document.getElementById('hidden-email').value = email;

            // Exibe o formulário de redefinição de senha
            document.getElementById('email-form').style.display = 'none';
            document.getElementById('reset-form').style.display = 'block';
        });
    </script>
</body>
</html>
