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
<?php renderHeader(); ?>
<main>
    <a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Excluir Cardápio</h1>
    <p>Tem certeza que deseja excluir o seguinte cardápio?</p>
    <form method="POST" action="">
        <?php
        require_once __DIR__ . '/../../../controller/cardapioController.php';
        $controladorCardapio = new cardapioController();
        $cardapios = $controladorCardapio->listarcardapios();
        foreach ($cardapios as $cardapio) {
            if ($cardapio->getId() == $_GET['id']) {
                echo '
                <div>
                    <label for="nutricionista_id"><strong>Nutricionista:</strong></label>
                    <input type="text" id="nutricionista_id" name="nutricionista_id" value="' . htmlspecialchars($controladorNutricionista->filtrarNutricionistas($cardapio->getNutricionistaId())) . '" readonly>
                </div>
                <div>
                    <label for="dataC"><strong>Data:</strong></label>
                    <input type="text" id="dataC" name="dataC" value="' . htmlspecialchars($cardapio->getDataC()) . '" readonly>
                </div>
                <div>
                    <label for="periodo"><strong>Período:</strong></label>
                    <input type="text" id="periodo" name="periodo" value="' . htmlspecialchars($cardapio->getPeriodo()) . '" readonly>
                </div>
                <div>
                    <label for="descricao"><strong>Descrição:</strong></label>
                    <input type="text" id="descricao" name="descricao" value="' . htmlspecialchars($cardapio->getDescricao()) . '" readonly>
                </div>';
            }
        }
        ?>
        <button type="submit" name="confirmar">Confirmar Exclusão</button>
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