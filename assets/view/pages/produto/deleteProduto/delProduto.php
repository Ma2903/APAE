<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
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
<body>
    <main>
        <h1>Deletar Produto</h1>
        <form action="processaDelecao.php" method="post">
            <div>
                <label for="produto_id">Selecione o Produto:</label>
                <select id="produto_id" name="produto_id" required>
                </select>
            </div>
            <div>
                <button type="submit">Deletar Produto</button>
            </div>
        </form>
    </main>
    <footer>
        <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
    </footer>
</body>
</html>