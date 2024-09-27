<?php
require_once __DIR__ . '/../../controller/produtoController.php';
$controlador = new ControladorProdutos();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Bom dia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="nome" id="nome">
        <input type="text" name="categoria" id="categoria">
        <input type="text" name="unidade_medida" id="unidade_medida">
        <input type="date" name="dt_criacao" id="dt_criacao">
        <input type="submit" value="Cadastrar">
    </form>
    <?php
    // Cadastrar Produtos

    // if (isset($_GET['nome']) && isset($_GET['categoria']) && isset($_GET['unidade_medida']) && isset($_GET['dt_criacao'])) {
    //     $nome = $_GET['nome'];
    //     $categoria = $_GET['categoria'];
    //     $un = $_GET['unidade_medida'];
    //     $dt_criacao = $_GET['dt_criacao'];

    //     $controlador->cadastrarProdutos($nome, $categoria, $un, $dt_criacao);
    // }
    ?>
</body>
</html>