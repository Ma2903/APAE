<?php
    require_once __DIR__ . "/../../controller/userController.php";
    $userController = new ControladorUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - APAE</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="global.js"></script>
</head>
<body>
    <section class="container">
        <section class="left-section">
            <img src="../../../src/logo_sem_fundo.png" alt="Logo" class="logo">
            <h2>Bem Vindo!</h2>
        </section>
        <section class="right-section">
            <form action="" method="POST">
                <h2>Entrar</h2>
                <section class="input-container">
                    <label for="email">E-mail:</label>
                    <input name="email" type="email" id="email" placeholder="exemplo@gmail.com" autocomplete="email" required>
                </section>
                <section class="input-container">
                    <label for="password">Senha:</label>
                    <input name="password" type="password" id="password" placeholder="******" autocomplete="current-password" required>
                    <span id="toggle-password" class="toggle-icon" aria-label="Mostrar senha">
                        <i class="fas fa-eye"></i>
                    </span>
                </section>

                <a href="redefinirSenha/RedefinirSenha.php" class="forgot-password">Esqueceu a Senha?</a>

                <button type="submit">Entrar</button>
                <p>Ou continuar com</p>
                <section class="social-login">
                    <i class='bx bxl-facebook-circle' aria-label="Login com Facebook"></i>
                    <i class='bx bxl-google' aria-label="Login com Google"></i>
                </section>
            </form>
        </section>
    </section>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['email'] !== "" && $_POST['password'] !== ""){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userController->logarUsuarios($email,$password);
        }else{
            echo "<script>alert('Usuário ou senha incorretos!')</script>";
        }
    }
    ?>
</body>
</html>