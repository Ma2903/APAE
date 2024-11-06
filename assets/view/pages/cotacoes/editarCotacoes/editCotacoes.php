<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cotação</title>
    <link rel="stylesheet" href="../EditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
    <main>
    <a href="../listarCotacoes/listarCotacoes.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Editar Cotação</h1>
    <form action="" method="post">
        <?php

        $cotacoes = $controladorCotacao->verCotas();
        foreach($cotacoes as $cotacao){
            if($cotacao->getId() == $_GET['id']){
            echo '
                <label for="produto_id">Produto:</label>
                <select id="produto_id" name="produto_id" required>';
                $produtos = $controladorProduto->verProdutos();
                foreach($produtos as $produto){
                echo '<option value="'.$produto->getId().'"';
                if($produto->getId() == $cotacao->getProdutoId()){
                    echo 'selected';
                }
                echo '>'.$produto->getNome().'</option>';
                }
                echo '</select>
                <label for="fornecedor_id">Fornecedor:</label>
                <select id="fornecedor_id" name="fornecedor_id" required>';
                $fornecedores = $controladorFornecedor->verFornecedor();
                foreach($fornecedores as $fornecedor){
                echo '<option value="'.$fornecedor->getId().'"';
                if($fornecedor->getId() == $cotacao->getFornecedorId()){
                    echo 'selected';
                }
                echo '>'.$fornecedor->getNome().'</option>';
                }
                    echo '</select>
                    <label for="preco_unitario">Preço Unitário:</label>
                    <input type="number" step="0.01" id="preco_unitario" name="preco_unitario" required value="'.$cotacao->getPrecoUnitario().'">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" step="0.01" id="quantidade" name="quantidade" required value="'.$cotacao->getQuantidade().'">
                    <label for="data_cotacao">Data da Cotação:</label> 
                    <input type="date" id="data_cotacao" name="data_cotacao" required value="'.$cotacao->getDataCotacao().'">
                    <button type="submit">Salvar Alterações</button> ';
            }
        }
        ?>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $controladorCotacao->editarCota($_GET['id'], $_POST['produto_id'], $_POST['fornecedor_id'], $_POST['preco_unitario'], $_POST['quantidade'], $_POST['data_cotacao']);
            header('Location: ../listarCotacoes/listarCotacoes.php');
        };
        ?>
    </form>
</main>
    <?php renderFooter(); ?>
</body>
</html>