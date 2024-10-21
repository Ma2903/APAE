<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();

$cotacao = null;
if (isset($_GET['id'])) {
    $cotacaoId = $_GET['id'];
    $cotacoes = $controladorCotacao->verCotas();
    foreach ($cotacoes as $c) {
        if ($c->getId() == $cotacaoId) {
            $cotacao = $c;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cotação</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarCotacoes/listarCotacoes.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Excluir Cotação</h1>
    <h3>Tem certeza que deseja excluir a seguinte cotação?</h3>
    <form method="POST" action="">
        <?php if ($cotacao): ?>
            <label for="cotacao_id"><strong>ID:</strong></label>
            <input type="text" id="cotacao_id" name="cotacao_id" value="<?php echo $cotacao->getId() ?>" readonly>
            <label for="produto_nome"><strong>Nome do Produto:</strong></label>
            <?php
            $resultadoProduto= null;
            $produtos = $controladorProduto->verProdutos();
            foreach($produtos as $produto) {
                if ($produto->getId() == $cotacao->getProdutoId()) {
                   $resultadoProduto = $produto->getNome();
                    break;
                }
            }
            ?>
            <input type="text" id="produto_nome" name="produto_nome" value="<?php echo $resultadoProduto ?>" readonly>
            <label for="preco_unitario"><strong>Preço Unitário:</strong></label>
            <input type="text" id="preco_unitario" name="preco_unitario" value="<?php echo htmlspecialchars($cotacao->getPrecoUnitario()); ?>" readonly>
            <label for="quantidade"><strong>Quantidade:</strong></label>
            <input type="text" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($cotacao->getQuantidade()); ?>" readonly>
            <label for="data_cotacao"><strong>Data da Cotação:</strong></label>
            <input type="date" id="data_cotacao" name="data_cotacao" value="<?php echo htmlspecialchars($cotacao->getDataCotacao()); ?>" readonly>
            <?php
            $resultadoFornecedor = null;
            $fornecedores = $controladorFornecedor->verFornecedor();
            foreach ($fornecedores as $fornecedor) {
                if ($fornecedor->getId() == $cotacao->getFornecedorId()) {
                    $resultadoFornecedor = $fornecedor->getNome();
                    break;
                }
            }
            ?>
            <label for="fornecedor_nome"><strong>Fornecedor:</strong></label>
            <input type="text" id="fornecedor_nome" name="fornecedor_nome" value="<?php echo $resultadoFornecedor ?>" readonly>
            <input type="hidden" name="cotacao_id" value="<?php echo htmlspecialchars($cotacao->getId()); ?>">
            <button type="submit" name="confirmar">Confirmar Exclusão</button>
        <?php else: ?>
            <p>Cotação não encontrada.</p>
        <?php endif; ?>
    </form>
    <?php
    if (isset($_POST['confirmar'])) {
        $controladorCotacao->deletarCota($_POST['cotacao_id']);
        header('Location: ../listarCotacoes/listarCotacoes.php');
        exit();
    }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>