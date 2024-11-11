<?php
    require_once __DIR__ . "/../../../../controller/pageController.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cardápio</title>
    <link rel="stylesheet" href="../../styles/EditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Editar Cardápio</h1>
    <form action="" method="post">
        <section>
            <label for="cardapio_id">Selecione o Cardápio:</label>
            <select id="cardapio_id" name="cardapio_id" required>
                <!-- Aqui você deve adicionar o código PHP para listar os cardápios -->
            </select>
        </section>
        <section>
            <label for="nutricionista_id">Nutricionista:</label>
            <select id="nutricionista_id" name="nutricionista_id" required>
                <!-- Aqui você deve adicionar o código PHP para listar os nutricionistas -->
            </select>
        </section>
        <section>
            <label for="data_inicio">Data Início:</label>
            <input type="date" id="data_inicio" name="data_inicio" required>
        </section>
        <section>
            <label for="data_fim">Data Fim:</label>
            <input type="date" id="data_fim" name="data_fim" required>
        </section>
        <section>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
        </section>
        <section>
            <button type="submit">Salvar Alterações</button>
        </section>
    </form>
</main>
<?php renderFooter(); ?>
</body>
</html>