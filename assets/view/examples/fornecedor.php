<?php
require_once __DIR__ . '/../../controller/fornecedorController.php';
$controlador = new ControladorFornecedor();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Boa tarde</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <!-- Cadastro Fornecedor -->
    <form action="" method="get">
        <input type="text" name="nome" id="nome" placeholder="nome">
        <input type="text" name="endereco" id="endereco" placeholder="endereco">
        <input type="tel" name="telefone" id="telefone" placeholder="telefone">
        <input type="tel" name="whatsapp" id="whatsapp" placeholder="whatsapp">
        <input type="email" name="email" id="email" placeholder="email">
        <input type="tel" name="ramo_atuacao" id="ramo_atuacao" placeholder="ramo de atuacao">
        <input type="tel" name="data_criacao" id="data_criacao" placeholder="data de criacao">
        <input type="submit" value="Cadastrar">
    </form>
    <br>
    <hr>
    <br>
    <!-- Editar Fornecedor -->
    <form action="" methdo="get">
        <input type="text" name="id" id="id" placeholder="pesquise o ID"> <input type="submit" value="Pesquisar">
    </form>
    <form action="" method="get">
        <input type="text" name="nome" id="nome" placeholder="nome">
        <input type="text" name="endereco" id="endereco" placeholder="endereco">
        <input type="tel" name="telefone" id="telefone" placeholder="telefone">
        <input type="tel" name="whatsapp" id="whatsapp" placeholder="whatsapp">
        <input type="email" name="email" id="email" placeholder="email">
        <input type="tel" name="ramo_atuacao" id="ramo_atuacao" placeholder="ramo de atuacao">
        <input type="tel" name="data_criacao" id="data_criacao" placeholder="data de criacao">
        <input type="submit" value="Editar">
    </form>
    <?php
    // Cadastrar Fornecedor

    if (isset($_GET['nome']) && isset($_GET['endereco']) && isset($_GET['telefone']) && isset($_GET['whatsapp']) && isset($_GET['email']) && isset($_GET['ramo_atuacao']) && isset($_GET['data_criacao'])) {
        $nome = $_GET['nome'];
        $endereco = $_GET['endereco'];
        $telefone = $_GET['telefone'];
        $whatsapp = $_GET['whatsapp'];
        $email = $_GET['email'];
        $ramo_atuacao = $_GET['ramo_atuacao'];
        $data_criacao = $_GET['data_criacao'];

        $controlador->cadastrarFornecedor($nome, $endereco, $telefone, $whatsapp, $email, $ramo_atuacao, $data_criacao);
    }

    // Ver Fornecedor

    $fornecedor = $controlador->verFornecedor();

    echo "<pre>";
    var_dump( $fornecedor );
    echo "</pre>";

    // Editar Fornecedor


    $controlador->editarFornecedor(1, "Nome fornecedor editado", "Endereço editado", "Telefone editado", "whatsapp editado", "E-mail editado", "Ramo de atuação editado");
    ?>
</body>
</html>