<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo-container">
            <img src="../../../../../src/logo0.jpg" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </div>
        <div class="user-info">
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </div>
</header>
<main>
    <h1>Editar Produto</h1>
    <form action="processaEdicao.php" method="post">
        <div>
            <label for="produto_id">Selecione o Produto:</label>
            <select id="produto_id" name="produto_id" required onchange="fetchProductDetails(this.value)">
                <option value="">Selecione um produto</option>
               
            </select>
        </div>
        <div>
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>
        </div>
        <div>
            <label for="unidade_medida">Unidade de Medida:</label>
            <input type="text" id="unidade_medida" name="unidade_medida" required>
        </div>
        <div>
            <label for="data_criacao">Data de Criação:</label>
            <input type="date" id="data_criacao" name="data_criacao" required>
        </div>
        <div>
            <button type="submit">Salvar Alterações</button>
        </div>
    </form>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>