<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();

$cotacao = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cotacaoId = $_GET['id'];
    $cotacoes = $controladorCotacao->verCotas();
    $cotacaoEncontrada = false;

    foreach ($cotacoes as $c) {
        if ($c->getId() == $cotacaoId) {
            $cotacaoEncontrada = true;
            break;
        }
    }

    if ($cotacaoEncontrada) {
        $controladorCotacao->deletarCota($cotacaoId);
        if (isset($_GET['redirect']) && $_GET['redirect'] === 'true') {
            header('Location: ../listarCotacoes/listarCotacoes.php?deleted=true');
        } else {
            header('Location: ../listarCotacoes/listarCotacoes.php');
        }
        exit();
    } else {
        echo "Cotação não encontrada.";
    }
} else {
    echo "ID inválido.";
}
?>