<?php
    require_once __DIR__ . "/../../../controller/userController.php";
    $userController = new ControladorUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - APAE</title>
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="../global.js"></script>
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
            <form action="" method="get">
                <div class="input-container">
                    <label for="email">E-mail:</label>
                    <input name="email" type="email" id="email" placeholder="exemplo@gmail.com">
                </div>
                <!-- Campo de Senha -->
                <div class="input-container">
                    <label for="password">Senha:</label>
                    <input name="password" type="password" id="password" placeholder="******">
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <a href="#" class="forgot-password">Esqueceu a Senha?</a>

                <button type="submit">Entrar</button>
                <p>Ou continuar com</p>
                <div class="social-login">
                    <i class='bx bxl-facebook-circle'> </i>
                    <i class='bx bxl-google' ></i>
                </div>
            </form>
        </div>
    </div>
    <?php
    if(isset($_GET['email']) && isset($_GET['password'])){
        $email = $_GET['email'];
        $password = $_GET['password'];
        $userController->logarUsuarios($email,$password);

        // var_dump($_SESSION['user']);
    }
    
    ?>
</body>
</html>