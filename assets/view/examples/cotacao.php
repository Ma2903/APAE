<?php
require_once __DIR__ . '/../../controller/cotacaoController.php';
$controlador = new ControladorCotacao();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Gerenciamento de Cotações</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="produto_id" id="produto_id" placeholder="ID do Produto">
        <input type="text" name="fornecedor_id" id="fornecedor_id" placeholder="ID do Fornecedor">
        <input type="text" name="preco_unitario" id="preco_unitario" placeholder="Preço Unitário">
        <input type="text" name="quantidade" id="quantidade" placeholder="Quantidade">
        <input type="date" name="data_cotacao" id="data_cotacao">
        <input type="submit" value="Cadastrar">
    </form>
    <?php
    // Cadastrar Cotações
    if (isset($_GET['produto_id']) && isset($_GET['fornecedor_id']) && isset($_GET['preco_unitario']) && isset($_GET['quantidade']) && isset($_GET['data_cotacao'])) {
        $produtoId = $_GET['produto_id'];
        $fornecedorId = $_GET['fornecedor_id'];
        $precoUnitario = $_GET['preco_unitario'];
        $quantidade = $_GET['quantidade'];
        $dataCotacao = $_GET['data_cotacao'];
        $controlador->cadastrarCota($produtoId, $fornecedorId, $precoUnitario, $quantidade, $dataCotacao);

        // Limpar os dados do GET
        
    }

    // Ver Cotações
    $cotas = $controlador->verCotas();
    echo "<pre>";
    var_dump($cotas);
    echo "</pre>";

    // Editar Cotações
    // $controlador->editarCota(1, 2, 3, 5.00, 100, '2024-09-15');

    // Deletar Cotações
    $controlador->deletarCota(1);
    ?>
</body>
</html>