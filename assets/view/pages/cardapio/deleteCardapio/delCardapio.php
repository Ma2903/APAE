<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cardápio</title>
    <link rel="stylesheet" href="../../styles/DeleteStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
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

    <?php
    if (isset($_POST['confirmar'])) {
        $controladorCardapio->deletarCardapio($_POST['id']);
        header('Location: ../listarCardapio/listarCardapio.php');
    }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>