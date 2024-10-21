<?php
    require_once __DIR__ . "/../../controller/userController.php";
    $userController = new ControladorUsuarios();

    // Verificar se o cookie de "Lembrar-me" está presente
    $savedEmail = '';
    $savedPassword = '';
    if (isset($_COOKIE['remember_me_email']) && isset($_COOKIE['remember_me_password'])) {
        $savedEmail = $_COOKIE['remember_me_email'];
        $savedPassword = $_COOKIE['remember_me_password'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($_POST['password']);
            $user = $userController->logarUsuarios($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                if (isset($_POST['remember-me'])) {
                    setcookie('remember_me_email', $email, time() + (86400 * 30), "/"); // 30 dias
                    setcookie('remember_me_password', $password, time() + (86400 * 30), "/"); // 30 dias
                } else {
                    setcookie('remember_me_email', '', time() - 3600, "/"); // Expira o cookie
                    setcookie('remember_me_password', '', time() - 3600, "/"); // Expira o cookie
                }
                header("Location: principal.php");
                exit();
            } else {
                $loginError = "Usuário ou senha incorretos!";
            }
        } else {
            $loginError = "Por favor, preencha todos os campos.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - APAE</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="global.js"></script>
</head>
<body>
    <section class="container" role="main">
        <section class="left-section">
            <img src="../../../src/logo_sem_fundo.png" alt="Logo APAE" class="logo">
            <h2>Bem-vindo á SmartControl!</h2>
            <p>Acesse sua conta para continuar.</p>
        </section>
        <section class="right-section">
            <form id="login-form" action="" method="POST" novalidate>
                <h2>Entrar</h2>
                <!-- Campo de E-mail -->
                <section class="input-container">
                    <label for="email">E-mail:</label>
                    <input 
                        name="email" 
                        type="email" 
                        id="email" 
                        placeholder="exemplo@gmail.com" 
                        autocomplete="email" 
                        required
                        aria-describedby="email-error" 
                        aria-invalid="false"
                        value="<?php echo htmlspecialchars($savedEmail); ?>"
                    >
                    <section id="email-error" class="error" role="alert" aria-live="assertive" style="display:none;">
                        Por favor, insira um e-mail válido.
                    </section>
                </section>
                
                <!-- Campo de Senha -->
                <section class="input-container">
                    <label for="password">Senha:</label>
                    <input 
                        name="password" 
                        type="password" 
                        id="password" 
                        placeholder="******" 
                        autocomplete="current-password" 
                        required
                        aria-describedby="password-error" 
                        aria-invalid="false"
                        value="<?php echo htmlspecialchars($savedPassword); ?>"
                    >
                    <span id="toggle-password" class="toggle-icon" aria-label="Mostrar senha">
                        <i class="fas fa-eye" aria-hidden="true"></i>
                    </span>
                    <section id="password-error" class="error" role="alert" aria-live="assertive" style="display:none;">
                        A senha deve ter pelo menos 4 caracteres.
                    </section>
                </section>

                <a href="redefinirSenha/RedefinirSenha.php" class="forgot-password">Esqueceu a senha?</a>

                <button type="submit" aria-label="Entrar na sua conta">Entrar</button>
                
                <section class="input-container remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me" <?php if ($savedEmail && $savedPassword) echo 'checked'; ?>>
                    <label for="remember-me">Lembrar-me</label> 
                </section>
            </form>
        </section>
    </section>

    <?php if (isset($loginError)): ?>
        <section class="alert"><?php echo $loginError; ?></section>
    <?php endif; ?>
</body>
</html>