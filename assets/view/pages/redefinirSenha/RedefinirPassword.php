<?php
require_once __DIR__ . "/../../../controller/userController.php";
$userController = new ControladorUsuarios();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if($_SESSION['codigo'] == $_POST['codigo']){
        if($_POST['password'] != $_POST['Verifpassword']){
            echo "<script>alert('Senhas Diferentes!')</script>";
        }else{
            $userController->RedefinirSenha($_SESSION['emailRecuperar'],$_POST['password']);
            echo "<script>alert('Senha Trocada!')</script>";
        }
    } else {
        echo "<script>alert('Código Incorreto!')</script>";
    }
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
                    <label for="codigo">Codigo:</label>
                    <input name="codigo" type="codigo" id="codigo" required>
                </section>
                <section class="input-container">
                <label for="new-password">Nova Senha:</label>
                <input name="password" type="password" id="password0" placeholder="******" required>
                <span id="toggle-password" class="toggle-icon">
                    <i class="fas fa-eye"></i>
                </span>
                </section>
                <section class="input-container">
                <label for="confirm-password">Confirmar Nova Senha:</label>
                <input name="Verifpassword" type="password" id="password1" placeholder="******" required>
                <span id="toggle-password" class="toggle-icon">
                    <i class="fas fa-eye"></i>
                </span>
                </section>
            <button type="submit">Redefinir Senha</button>
        </form>
        </section>
        <section class="right">
            <h2>Bem-Vindo ao <br>
                Redefinir Senha <br>
                da SmartControl!</h2> <br>
            <p>Digite o Código Enviado em <br> 
                seu E-mail e a Nova Senha <br>
                para continuar!</p>
        </section>
    </section>
</body>
</html>