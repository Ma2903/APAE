<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - APAE</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script defer src="script.js"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="../../../../src/logo0.jpg" alt="Logo" class="logo">
            <h2>Bem Vindo!</h2>
            <p>Se você não tem uma conta registre-se!</p>
            <a href="../cadastro/register_user.php" class="register-link">Registrar Aqui!</a>
        </div>
        <div class="right-section">
            <h2>Entrar</h2>
            <form>
                <div class="input-container">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" placeholder="exemplo@gmail.com">
                </div>
                <!-- Campo de Senha -->
                <div class="input-container">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" placeholder="******">
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <a href="#" class="forgot-password">Esqueceu a Senha?</a>

                <button type="submit">Entrar</button>
            </form>

            <p>Ou continuar com</p>
            <div class="social-login">
                <!-- <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-google"></i></a> -->
                facebook
                apple
                google
            </div>
        </div>
    </div>
</body>
</html>