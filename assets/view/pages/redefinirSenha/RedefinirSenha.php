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
    <link rel="stylesheet" href="../login/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="../global.js"></script>
</head>
<body>
    <section class="container">
        <img src="../../../../src/logo0.jpg" alt="Logo APAE" class="logo">
        <section class="left">
            <form action="" method="POST" id="login-form">
                <h2>Redefinir Senha</h2>
                <section class="input-container">
                    <label for="email">E-mail:</label>
                    <input name="email" type="email" id="email" placeholder="Digite seu e-mail" required>
                </section>
                <button type="submit" aria-label="Enviar Código para o e-mail">Enviar Código</button>
            </form>
        </section>
        <section class="right">
            <h2>Bem-Vindo ao <br>
                Redefinir Senha <br>
                da SmartControl!</h2> <br>
            <p>Digite seu E-mail
            <br> para continuar!</p>
        </section>
    </section>
</body>
</html>
