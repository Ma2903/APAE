<?php
    require_once __DIR__ . "/../../../controller/userController.php";
    $userController = new ControladorUsuarios();
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
            <a href="../login/login.php" class="back-link">Voltar para o Login</a>
        </section>
        <section class="right-section">
            <h2>Redefinir Senha</h2>
            <form action="" method="POST">
                <!-- Campo de nova senha -->
                <section class="input-container">
                    <label for="new-password">Nova Senha:</label>
                    <input name="password" type="password" id="password" placeholder="******" required>
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </section>
                <!-- Campo de confirmação de nova senha -->
                <section class="input-container">
                    <label for="confirm-password">Confirmar Nova Senha:</label>
                    <input name="password" type="password" id="password" placeholder="******" required>
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </section>
                <button type="submit">Redefinir Senha</button>
            </form>
        </section>
    </section>
</body>
</html>