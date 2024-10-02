<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';

$controladorCotacao = new ControladorCotacao();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cotação</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <section class="header-container">
        <section class="logo-container">
            <img src="../../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </section>
        <section class="user-info">
            <a href="../../principal.php" class="home-btn">Home</a>
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
    <main>
    <a href="../listarCotacoes/listarCotacoes.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Editar Cotação</h1>
    <form action="processaEdicao.php" method="post">
        <?php

        $cotacoes = $controladorCotacao->verCotas();
        foreach($cotacoes as $cotacao){
            if($cotacao->getId() == $_GET['id']){
                echo '
                    <label for="produto_id">Produto:</label>
                    <select id="produto_id" name="produto_id" required>';
                    $produtos = $controladorProduto->verProdutos();
                    foreach($produtos as $produto){
                        echo '<option value="'.$produto->getId().'"'.
                        if($produto->getId() == $cotacao->getProdutoId()) echo 'selected';
                        ''>.$produto->getNome().'</option>';
                    }
                    if($cotacao->getProdutoId() )
                    '</select>
                    <label for="fornecedor_id">Fornecedor:</label>
                    <select id="fornecedor_id" name="fornecedor_id" required>
                        <!-- Aqui você deve adicionar o código PHP para listar os fornecedores -->
                    </select>
                    <label for="preco_unitario">Preço Unitário:</label>
                    <input type="number" step="0.01" id="preco_unitario" name="preco_unitario" required>
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" step="0.01" id="quantidade" name="quantidade" required>
                    <label for="data_cotacao">Data da Cotação:</label>
                    <input type="date" id="data_cotacao" name="data_cotacao" required>
                    <button type="submit">Salvar Alterações</button> ';
            }
        }
        ?>
    </form>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>