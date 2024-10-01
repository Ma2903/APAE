<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cardápio</title>
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
    <h1>Editar Cardápio</h1>
    <form action="processaEdicao.php" method="post">
        <div>
            <label for="cardapio_id">Selecione o Cardápio:</label>
            <select id="cardapio_id" name="cardapio_id" required>
                <!-- Aqui você deve adicionar o código PHP para listar os cardápios -->
            </select>
        </div>
        <div>
            <label for="nutricionista_id">Nutricionista:</label>
            <select id="nutricionista_id" name="nutricionista_id" required>
                <!-- Aqui você deve adicionar o código PHP para listar os nutricionistas -->
            </select>
        </div>
        <div>
            <label for="data_inicio">Data Início:</label>
            <input type="date" id="data_inicio" name="data_inicio" required>
        </div>
        <div>
            <label for="data_fim">Data Fim:</label>
            <input type="date" id="data_fim" name="data_fim" required>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
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