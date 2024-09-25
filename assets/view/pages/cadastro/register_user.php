<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - APAE</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script defer src="script.js"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="../../../../src/logo0.jpg" alt="APAE Logo" class="logo">
            <h1>Cadastre-se</h1>
            <p>Se você já tem uma conta</p>
            <p>Você pode <a href="../login/login.php" class="login-link">Entrar Aqui!</a></p>
        </div>
        <div class="right-section">
            <h2>Cadastrar-se</h2>
            <form method="POST" action="../controller/UserController.php?action=register">
                <!-- Campo CPF -->
                <div class="input-container">
                <label for="email">Digite seu CPF:</label>
                    <input type="text" name="cpf" placeholder="CPF" required>
                </div>
                
                <!-- Campo Nome -->
                <div class="input-container">
                <label for="email">Digite seu Nome:</label>
                    <input type="text" name="nome" placeholder="Nome" required>
                </div>
                
                <!-- Campo Sobrenome -->
                <div class="input-container">
                <label for="email">Digite seu Sobrenome:</label>
                    <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                </div>
                
                <!-- Campo Data de Nascimento -->
                <div class="input-container">
                <label for="email">Digite sua Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" required>
                </div>
                
                <!-- Campo Endereço -->
                <div class="input-container">
                <label for="endereco">Digite seu Endereço:</label>
                    <input type="text" name="endereco" placeholder="Endereço">
                </div>
                
                <!-- Campo Telefone -->
                <div class="input-container">
                <label for="telefone">Digite seu Telefone:</label>
                    <input type="tel" name="telefone" placeholder="Telefone">
                </div>
                
                <!-- Campo E-mail -->
                <div class="input-container">
                <label for="email">Digite seu E-mail:</label>
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                
                <!-- Campo de Senha -->
                <div class="input-container">
                    <label for="password">Digite sua Senha:</label>
                    <input type="password" id="password" placeholder="******">
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <!-- Campo Confirmar Senha -->
                <div class="input-container">
                    <label for="password">Confirmar Senha:</label>
                    <input type="password" id="confirm-password" placeholder="******" required>
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <!-- Campo Tipo de Usuário -->
                <div class="input-container">
                <label for="tipo_usuario">Selecione o seu Cargo:</label>
                    <select name="tipo_usuario" required>
                        <option value="administrador">Administrador</option>
                        <option value="funcionario">Funcionário</option>
                        <option value="nutricionista">Nutricionista</option>
                    </select>
                </div>

                <!-- Campo CRN (Somente Nutricionistas) -->
                <div class="input-container">
                <label for="CRN">Digite seu CRN:</label>
                    <input type="text" name="crn" placeholder="CRN (Somente Nutricionistas)">
                </div>
                
                <!-- Botão de Registro -->
                <button type="submit" class="register-button">Cadastrar</button>
            </form>

            <p>Ou Continue Com</p>
            <div class="social-icons">
                <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
                <a href="#"><img src="apple-icon.png" alt="Apple"></a>
                <a href="#"><img src="google-icon.png" alt="Google"></a>
            </div>
        </div>
    </div>
</body>
</html>