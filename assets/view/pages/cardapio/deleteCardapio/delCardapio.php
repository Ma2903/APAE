<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cardápio</title>
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
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
    <a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Excluir Cardápio</h1>
    <p>Tem certeza que deseja excluir o seguinte cardápio?</p>
    <form method="POST" action="processaExclusao.php">
        <div>
            <label for="cardapio_id"><strong>ID:</strong></label>
            <input type="text" id="cardapio_id" name="cardapio_id" readonly>
        </div>
        <div>
            <label for="nutricionista_id"><strong>ID do Nutricionista:</strong></label>
            <input type="text" id="nutricionista_id" name="nutricionista_id" readonly>
        </div>
        <div>
            <label for="data_inicio"><strong>Data de Início:</strong></label>
            <input type="text" id="data_inicio" name="data_inicio" readonly>
        </div>
        <div>
            <label for="data_fim"><strong>Data de Fim:</strong></label>
            <input type="text" id="data_fim" name="data_fim" readonly>
        </div>
        <div>
            <label for="descricao"><strong>Descrição:</strong></label>
            <input type="text" id="descricao" name="descricao" readonly>
        </div>
        <div>
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