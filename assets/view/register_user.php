<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastrar Usuário</h2>
    <form method="POST" action="../controller/UserController.php?action=register">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" required><br><br>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br><br>
        <label for="sobrenome">Sobrenome:</label>
        <input type="text" name="sobrenome" required><br><br>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required><br><br>
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco"><br><br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone"><br><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br><br>
        <label for="tipo_usuario">Tipo de Usuário:</label>
        <select name="tipo_usuario" required>
            <option value="administrador">Administrador</option>
            <option value="funcionario">Funcionário</option>
            <option value="nutricionista">Nutricionista</option>
        </select><br><br>
        <label for="crn">CRN (Somente Nutricionistas):</label>
        <input type="text" name="crn"><br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>