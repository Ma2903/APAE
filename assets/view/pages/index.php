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
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="global.js"></script>
</head>
<body>
    <section class="container" role="main">
        <img src="../../../src/logo0.jpg" alt="Logo APAE" class="logo">
        <section class="left">
            <form id="login-form" action="" method="POST">
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
                        value="<?php echo htmlspecialchars($savedEmail); ?>"
                    >
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
                        value="<?php echo htmlspecialchars($savedPassword); ?>"
                    >
                    <span id="toggle-password" class="toggle-icon" aria-label="Mostrar senha">
                        <i class="fas fa-eye" aria-hidden="true"></i>
                    </span>
                </section>
    
                <a href="redefinirSenha/RedefinirSenha.php" class="forgot-password">
                    <i class="fas fa-unlock-alt"></i> Esqueceu a senha?
                </a>
    
                <button type="submit" aria-label="Entrar na sua conta">Entrar</button>
                
                <section class="remember-me">
                    <label for="remember-me">Lembrar-me</label> 
                    <input type="checkbox" id="remember-me" name="remember-me" <?php if ($savedEmail && $savedPassword) echo 'checked'; ?>>
                </section>
            </form>
        </section>
        <section class="right">
            <h2>Bem-Vindo à 
                <br> SmartControl!</h2> <br>
            <p>Acesse sua conta
                <br> para continuar!</p>
        </section>
    </section>

    <?php if (isset($loginError)): ?>
        <section class="alert"><?php echo $loginError; ?></section>
    <?php endif; ?>
</body>
</html>