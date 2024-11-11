<?php
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorProduto = new ControladorProdutos();
$controladorNutricionista = new ControladorUsuarios();


// Supondo que você tenha uma função para obter a lista de nutricionistas
// $nutricionistas = [
//     $controladorNutricionista->listarUsuarios($usuario['tipo_usuario'] == "nutricionista")
// ];
?>

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
            <label for="id">Id do Cardapio:</label>
            <select id="id" name="id" required>
                <option value="nenhum">Nenhum</option>
                <?php $controladorCardapio->filtrarCardapio(); ?>
            </select>
        </section>
        <section>
            <label for="nutricionista_id">Nutricionista:</label>
            <select id="nutricionista" name="nutricionista" required>
                <option value="nenhum">Nenhum</option>
                <?php $controladorNutricionista->filtrarNutricionistas(); ?>
            </select>
</section>
        <section>
            <label for="dataC">Data:</label>
            <input type="date" id="dataC" name="dataC" required>
        </section>
        <section>
            <label for="periodo">Período:</label>
            <select id="periodo" name="periodo" required>
            <option value="manha">Manhã</option>
            <option value="tarde">Tarde</option>
            <option value="manha-tarde">Manhã e Tarde</option>
            </select>
        </section>
        <section>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
        </section>
        <section>
            <button type="submit">Salvar Alterações</button>
        </section>
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controladorCardapio->criarcardapio($_POST['id'],$_POST['nutricionista'], $_POST['dataC'], $_POST['periodo'], $_POST['descricao']);
    }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>