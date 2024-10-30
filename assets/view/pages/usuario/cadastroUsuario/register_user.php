<?php
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
require_once __DIR__ . "/../../global.php";
$controler = new ControladorUsuarios();


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarUsuario/listarUsuario.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Cadastrar Usuário</h1>
    <form action="" method="post">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
         <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>
          <label for="sobrenome">Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required>
        <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
       <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" placeholder="Endereço">
        <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" placeholder="Telefone">
        <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
         <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="******" required>
        <label for="tipo_usuario">Tipo de Usuário:</label>
            <select id="tipo_usuario" name="tipo_usuario" required>
                <option value="administrador">Administrador</option>
                <option value="contador">Contador</option>
                <option value="nutricionista">Nutricionista</option>
            </select>
        <label for="crn">CRN (Somente Nutricionistas):</label>
            <input type="text" id="crn" name="crn" placeholder="CRN">
         <button type="submit">Cadastrar Usuário</button>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $controler->cadastrarUsuarios($_POST['nome'],$_POST['cpf'],$_POST['sobrenome'],$_POST['data_nascimento'],$_POST['endereco'],$_POST['telefone'],$_POST['email'],$_POST['tipo_usuario'],$_POST['senha'],$_POST['crn']);
        }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>