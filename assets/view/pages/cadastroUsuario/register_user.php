<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - APAE</title>
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="../global.js"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="../../../../src/logo0.jpg" alt="APAE Logo" class="logo">
            <h1>Cadastrar</h1>
            <p>Se você já tem uma conta</p>
            <p>Você pode <a href="../login/login.php" class="login-link">Entrar Aqui!</a></p>
        </div>
        <div class="right-section">
            <h2>Cadastrar</h2>
            <form method="POST" action="../controller/UserController.php?action=register">
                <!-- Campo CPF -->
                <div class="input-container">
                <label for="email">Digite o CPF:</label>
                    <input type="text" name="cpf" placeholder="CPF" required>
                </div>
                
                <!-- Campo Nome -->
                <div class="input-container">
                <label for="email">Digite o Nome:</label>
                    <input type="text" name="nome" placeholder="Nome" required>
                </div>
                
                <!-- Campo Sobrenome -->
                <div class="input-container">
                <label for="email">Digite o Sobrenome:</label>
                    <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                </div>
                
                <!-- Campo Data de Nascimento -->
                <div class="input-container">
                <label for="email">Digite a Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" required>
                </div>
                
                <!-- Campo Endereço -->
                <div class="input-container">
                <label for="endereco">Digite o Endereço:</label>
                    <input type="text" name="endereco" placeholder="Endereço">
                </div>
                
                <!-- Campo Telefone -->
                <div class="input-container">
                <label for="telefone">Digite o Telefone:</label>
                    <input type="tel" name="telefone" placeholder="Telefone">
                </div>
                
                <!-- Campo E-mail -->
                <div class="input-container">
                <label for="email">Digite o E-mail:</label>
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                
                <!-- Campo de Senha -->
                <div class="input-container">
                    <label for="password">Digite a Senha:</label>
                    <input type="password" id="password" placeholder="******">
                    <span id="toggle-password" class="toggle-icon">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <!-- Campo Tipo de Usuário -->
                <div class="input-container">
                <label for="tipo_usuario">Selecione o Cargo:</label>
                    <select name="tipo_usuario" required>
                        <option value="administrador">Administrador</option>
                        <option value="funcionario">Funcionário</option>
                        <option value="nutricionista">Nutricionista</option>
                    </select>
                </div>

                <!-- Campo CRN (Somente Nutricionistas) -->
                <div class="input-container">
                <label for="CRN">Digite o CRN:</label>
                    <input type="text" name="crn" placeholder="CRN (Somente Nutricionistas)">
                </div>
                
                <!-- Botão de Registro -->
                <button type="submit" class="register-button">Cadastrar</button>
            </form>

            <p>Ou Continue Com</p>
            <div class="social-icons">
                 <i class='bx bxl-facebook-circle'> </i>
                 <i class='bx bxl-google' ></i>
            </div>
        </div>
    </div>
</body>
</html>