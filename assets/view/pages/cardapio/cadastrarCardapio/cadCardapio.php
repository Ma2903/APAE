<?php
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorProduto = new ControladorProdutos();
$controladorNutricionista = new ControladorUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cardápio</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Cadastrar Cardápio</h1>
    <form action="processaCadastro.php" method="post">
        <div>
            <label for="nutricionista_id">Nutricionista:</label>
            <select id="nutricionista_id" name="nutricionista_id" required>
                <option value="nenhum">Nenhum</option>
                <?php $controladorNutricionista->filtrarNutricionistas(); ?>
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
            <div>
                <label for="manha">Manhã</label>
                <input type="checkbox" id="manha" name="manha">
            </div>
            <div>
                <label for="tarde">Tarde</label>
                <input type="checkbox" id="tarde" name="tarde">
            </div>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
        </div>
        <div>
            <button type="submit">Cadastrar Cardápio</button>
        </div>
    </form>
</main>
<?php renderFooter(); ?>
</body>
</html>