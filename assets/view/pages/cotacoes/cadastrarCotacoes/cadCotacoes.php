<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();

$cotas = $controladorCotacao->verCotas();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cotação</title>
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
    <h1>Cadastrar Cotação</h1>
    <form action="" method="post">
            <label for="produto_id">Produto:</label>
            <select id="produto_id" name="produto_id" required>
                <?php
                foreach ($controladorProduto->verProdutos() as $produto) {
                    echo "<option value='{$produto->getId()}'>{$produto->getNome()}</option>";
                }
                
                ?>
            </select>
            <label for="fornecedor_id">Fornecedor:</label>
            <select id="fornecedor_id" name="fornecedor_id" required>
                <?php
                foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                    echo "<option value='{$fornecedor->getId()}'>{$fornecedor->getNome()}</option>";
                }
                
                ?>
            </select>
            <label for="preco_unitario">Preço Unitário:</label>
            <input type="number" step="0.01" id="preco_unitario" name="preco_unitario" required>
            <label for="quantidade">Quantidade:</label>
            <input type="number" step="0.01" id="quantidade" name="quantidade" required>
            <button type="submit">Cadastrar Cotação</button>
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controladorCotacao->cadastrarCota($_POST['produto_id'], $_POST['fornecedor_id'], $_POST['preco_unitario'], $_POST['quantidade']);
    }
    
    
    ?>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>