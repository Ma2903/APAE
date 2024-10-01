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
<header>
    <section class="header-container">
        <section class="logo-container">
            <img src="../../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </section>
        <section class="user-info">
            <a href="../../index.php" class="home-btn">Home</a>
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
<a href="../listarCotacoes/listarCotacoes.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Excluir Cotação</h1>
    <h3>Tem certeza que deseja excluir a seguinte cotação?</h3>
    <form method="POST" action="processaExclusao.php">
            <label for="cotacao_id"><strong>ID:</strong></label>
            <input type="text" id="cotacao_id" name="cotacao_id" readonly>
            <label for="produto_nome"><strong>Nome do Produto:</strong></label>
            <input type="text" id="produto_nome" name="produto_nome" readonly>
            <label for="preco_unitario"><strong>Preço Unitário:</strong></label>
            <input type="text" id="preco_unitario" name="preco_unitario" readonly>
            <label for="quantidade"><strong>Quantidade:</strong></label>
            <input type="text" id="quantidade" name="quantidade" readonly>
            <label for="data_cotacao"><strong>Data da Cotação:</strong></label>
            <input type="text" id="data_cotacao" name="data_cotacao" readonly>
            <label for="fornecedor_nome"><strong>Fornecedor:</strong></label>
            <input type="text" id="fornecedor_nome" name="fornecedor_nome" readonly>
            <button type="submit" name="confirmar">Confirmar Exclusão</button>
            <button type="submit" name="cancelar">Cancelar</button>
        </div>
    </form>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>