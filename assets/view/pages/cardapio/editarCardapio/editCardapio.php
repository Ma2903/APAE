<?php
session_start();
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorProduto = new ControladorProdutos();
$controladorNutricionista = new ControladorUsuarios();

if (isset($_GET['id'])) {
    $cardapioID = $_GET['id'];
    $cardapio = $controladorCardapio->getCardapioById($cardapioID);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $controladorCardapio->editarCardapio($_POST['id'], $_POST['nutricionista'], $_POST['dataC'], $_POST['periodo'], $_POST['descricao']);
    header('Location: ../listarCardapio/listarCardapio.php');
    exit;
}
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
    <?php if ($cardapio): ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $cardapio->getId(); ?>">
        <div>
            <label for="nutricionista">Nutricionista:</label>
                <select id="nutricionista" name="nutricionista" required>
                    <?php $controladorNutricionista->filtrarNutricionistas2(); ?>
                </select>
        </div>
        <div>
            <label for="dataC">Data:</label>
            <input type="date" id="dataC" name="dataC" value="<?php echo $cardapio->getDataC(); ?>">
        </div>
        <div>
            <label for="periodo">Período:</label>
                <select id="periodo" name="periodo" required>
                    <option value="manha" <?php echo $cardapio->getPeriodo() === 'manha' ? 'selected' : ''; ?>>Manhã</option>
                    <option value="tarde" <?php echo $cardapio->getPeriodo() === 'tarde' ? 'selected' : ''; ?>>Tarde</option>
                    <option value="manha-tarde" <?php echo $cardapio->getPeriodo() === 'manha-tarde' ? 'selected' : ''; ?>>Manhã e Tarde</option>
                </select>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="6" cols="100"><?php echo $cardapio->getDescricao(); ?></textarea>
        </div>
        <div>
            <button type="submit" name="excluir_cardapio">Editar Cardápio</button>
        </div>
    </form>
    <?php else: ?>
        <p>Cardápio não encontrado.</p>
    <?php endif; ?>
</main>
<?php renderFooter(); ?>
</body>
</html>
