<?php
require_once __DIR__ . "/../../../controller/userController.php";
$userController = new ControladorUsuarios();

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// $mail = new PHPMailer(true); // Cria uma nova instÃ¢ncia do PHPMailer
// $usuariosBanco = $userController->listarUsuarios();
// $email = $_POST['email'];
// foreach($usuariosBanco as $usuario){
//     $usuario->GetEmail();
// }


// try {
//     //ConfiguraÃ§Ãµes do servidor
//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com'; // Defina o servidor SMTP
//     $mail->SMTPAuth = true; // Ativar autenticaÃ§Ã£o SMTP
//     $mail->Username = 'no-reply@apae.com'; // Seu usuÃ¡rio SMTP
//     $mail->Password = ''; // Sua senha SMTP
//     $mail->SMTPSecure = 'tls'; // Ativar criptografia TLS
//     $mail->Port = 587; // Porta TCP a conectar

//     //DestinatÃ¡rios
//     $mail->setFrom('no-reply@apae.com', 'Apae');
//     $mail->addAddress('destinatario@exemplo.com', 'Nome do DestinatÃ¡rio'); // Adicione um destinatÃ¡rio

//     //ConteÃºdo
//     $mail->isHTML(true); // Defina o formato de email como HTML
//     $mail->Subject = 'Assunto do E-mail';
//     $mail->Body    = 'Corpo do e-mail em HTML';
//     $mail->AltBody = 'Corpo do e-mail em texto simples para clientes que nÃ£o suportam HTML';

//     $mail->send();
//     echo 'E-mail enviado com sucesso!';
// } catch (Exception $e) {
//     echo "E-mail nÃ£o pÃ´de ser enviado. Erro: {$mail->ErrorInfo}";
// }
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
