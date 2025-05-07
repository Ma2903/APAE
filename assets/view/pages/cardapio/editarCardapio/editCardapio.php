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
    $controladorCardapio->editarcardapio(
        $_POST['id'],
        $_POST['nutricionista'],
        $_POST['dataC'],
        $_POST['periodo'],
        $_POST['descricao']
    );
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
    <link rel="stylesheet" href="../../styles/CadStyle.css">
    <link rel="stylesheet" href="../cadastrarCardapio/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
<h1><i class="fas fa-edit"></i> Editar Cardápio</h1>
<div class="form">
    <!-- Coluna Esquerda -->
    <div class="form-left">
        <?php if ($cardapio): ?>
        <form id="cardapioForm" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $cardapio->getId(); ?>">
            <section>
                <label for="nutricionista"><i class="fas fa-user-md"></i> Nutricionista:</label>
                <select id="nutricionista" name="nutricionista" required>
                    <?php $controladorNutricionista->filtrarNutricionistas2($cardapio->getNutricionistaId()); ?>
                </select>
            </section>
            <section>
                <label for="dataC"><i class="fas fa-calendar-alt"></i> Data:</label>
                <input type="date" id="dataC" name="dataC" value="<?php echo $cardapio->getDataC(); ?>" required>
            </section>
            <section>
                <label for="periodo"><i class="fas fa-clock"></i> Período:</label>
                <select id="periodo" name="periodo" required>
                    <option value="manha" <?php echo $cardapio->getPeriodo() === 'manha' ? 'selected' : ''; ?>>Manhã</option>
                    <option value="tarde" <?php echo $cardapio->getPeriodo() === 'tarde' ? 'selected' : ''; ?>>Tarde</option>
                    <option value="manha-tarde" <?php echo $cardapio->getPeriodo() === 'manha-tarde' ? 'selected' : ''; ?>>Manhã e Tarde</option>
                </select>
            </section>
            <section>
                <label for="descricao"><i class="fas fa-align-left"></i> Descrição:</label>
                <textarea id="descricao" name="descricao" placeholder="Digite a descrição do cardápio..." required><?php echo isset($cardapio) ? $cardapio->getDescricao() : ''; ?></textarea>
            </section>
            <section class="confirm">
                <button type="submit" name="editar_cardapio" id="editBtn"><i class="fas fa-save"></i> Salvar Alterações</button>
            </section>
        </form>
        <?php else: ?>
            <p>Cardápio não encontrado.</p>
        <?php endif; ?>
    </div>

    <!-- Coluna Direita -->
    <div class="form-right">
        <form id="produtoForm" name="produtosForm" action="" method="post">
            <section>
                <label for="produto"><i class="fas fa-box"></i> Produto:</label>
                <select id="produto" name="produto" required>
                    <?php 
                    $produtos = $controladorProduto->filtrarProdutosCotadosSemanaAtual();
                    foreach ($produtos as $produto) {
                        echo "<option value='{$produto['produto']->getId()}' precopergrama='{$produto['preco_por_grama']}'>{$produto['produto']->getNome()}</option>";
                    }
                    if (empty($produtos)) {
                        echo "<option value=''>Nenhum produto disponível</option>";
                    }
                    ?>
                </select>
            </section>
            <section>
                <label for="quantidade"><i class="fas fa-weight"></i> Quantidade (g):</label>
                <input type="number" id="quantidade" name="quantidade" required placeholder="30(g)">
            </section>
            <section class="secbutton">
                <button type="submit" name="adicionar_produto"><i class="fas fa-plus"></i> Adicionar Produto</button>
            </section>
            <div class="lista-produtos">
                <h2><i class="fas fa-list"></i> Lista de Produtos Adicionados</h2>
                <table id="listaProdutosTable">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Custo</th>
                        </tr>
                    </thead>
                    <tbody id="produtosBody">
                        <!-- Produtos adicionados serão inseridos aqui -->
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</main>
<?php renderFooter(); ?>
</body>
</html>
