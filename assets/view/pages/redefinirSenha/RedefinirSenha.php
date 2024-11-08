<?php
require_once __DIR__ . "/../../../controller/userController.php";
$userController = new ControladorUsuarios();

// Cria uma nova instÃ¢ncia do PHPMailer
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->enviarCodigoRedefinicao($_POST['email']);
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - APAE</title>
    <link rel="stylesheet" href="../login/style2.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="../global.js"></script>
</head>
<body>
    <section class="container">
        <img src="../../../../src/logo0.jpg" alt="Logo" class="logo">
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
        </section>
    </section>
</body>
</html>
