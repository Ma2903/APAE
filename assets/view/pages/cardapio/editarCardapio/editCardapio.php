<?php
session_start();
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorCota = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorCotacao = new ControladorCotacao();
$controladorNutricionista = new ControladorUsuarios();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cardapioID = (int)$_GET['id'];
    $cardapio = $controladorCardapio->getCardapioById($cardapioID);

    if (!$cardapio) {
        die("Cardápio não encontrado.");
    }
} else {
    die("ID inválido.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_cardapio'])) {
    // Atualiza os dados do cardápio
    $controladorCardapio->editarcardapio(
        $cardapioID,
        $_POST['nutricionista'],
        $_POST['dataC'],
        $_POST['periodo'],
        $_POST['descricao']
    );

    // Processa os produtos adicionados
    $produtos = json_decode($_POST['produtos'], true);
    if (is_array($produtos)) {
        foreach ($produtos as $produto) {
            if (isset($produto['produtoId'], $produto['quantidade'])) {
                // Verifica se o produto já existe no cardápio
                $produtoExistente = $controladorCardapio->verificarProdutoNoCardapio($cardapioID, $produto['produtoId']);
                if ($produtoExistente) {
                    // Atualiza a quantidade do produto
                    $controladorCardapio->editarCadProd($cardapioID, $produto['produtoId'], $produto['quantidade']);
                } else {
                    // Insere um novo produto no cardápio
                    $controladorCardapio->criarCadProd($cardapioID, $produto['produtoId'], $produto['quantidade']);
                }
            } else {
                error_log("Produto inválido: " . json_encode($produto));
            }
        }
    }

    // Processa os produtos removidos
    $produtosRemovidos = json_decode($_POST['produtosRemovidos'], true);
    if (is_array($produtosRemovidos)) {
        foreach ($produtosRemovidos as $produto) {
            if (isset($produto['produtoId'])) {
                $controladorCardapio->deleteCadProd($cardapioID, $produto['produtoId']);
                error_log("Produto removido: " . $produto['produtoId']); // Log para depuração
            } else {
                error_log("Produto removido inválido: " . json_encode($produto));
            }
        }
    } else {
        error_log("Nenhum produto removido recebido ou formato inválido.");
    }

    // Redireciona para a página de listagem de cardápios
    header('Location: ../listarCardapio/listarCardapio.php');
    exit();
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
<h1><i class="fas fa-utensils"></i> Editar Cardápio</h1>
<div class="form">
    <!-- Coluna Esquerda -->
    <div class="form-left">
        <form id="cardapioForm" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $cardapio->getId(); ?>">
            <input type="hidden" name="form_type" value="cardapioForm">
            <input type="hidden" id="produtos" name="produtos"> <!-- Campo oculto para armazenar os produtos -->
            <input type="hidden" id="produtosRemovidos" name="produtosRemovidos"> <!-- Campo oculto para armazenar os produtos removidos -->
            <section>
                <label for="nutricionista"><i class="fas fa-user-md"></i> Nutricionista:</label>
                <select id="nutricionista" name="nutricionista" required>
                    <?php $controladorNutricionista->filtrarNutricionistas(); ?>
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
                <textarea id="descricao" name="descricao" placeholder="Digite a descrição do cardápio..." required><?php echo $cardapio->getDescricao(); ?></textarea>
            </section>
            <section class="confirm">
                <button type="submit" name="cadastrar_cardapio" id="cadBtn"><i class="fas fa-save"></i> Salvar Alterações</button>
                <span id="valCardapio">Total: R$00.00</span>
            </section>
        </form>
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
                        echo "<option value='{$produto['produto']->getId()}' precopergrama='{$produto['preco_por_grama']}'>
    {$produto['produto']->getNome()}
</option>";
                    }
                    if (empty($produtos)) {
                        echo "<option value=''>Nenhum produto disponível</option>";
                    }
                    ?>
                </select>
            </section>
            <section>
                <label for="quantidade"><i class="fas fa-weight"></i> Quantidade (g):</label>
                <input type="number" id="quantidade" name="quantidade" placeholder="30(g)">
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
                            <th>Ações</th>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    var produtosSelecionados = [];
    var produtosSalvos = [];
    var produtosRemovidos = [];

    // Carrega os produtos do banco de dados com os custos já calculados
    produtosSelecionados = produtosSelecionados.concat(
        <?php echo json_encode($controladorCardapio->listarCadProdutos($cardapioID), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>
    );

    atualizarTabela();
    atualizarValorTotal();

    // Atualizar tabela de produtos
    function atualizarTabela() {
        var tableBody = document.getElementById('produtosBody');
        tableBody.innerHTML = '';

        produtosSelecionados.forEach(function (produto, index) {
            var newRow = tableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = produto.produto_nome;
            cell2.innerHTML = `${produto.quantidade} g`;
            cell3.innerHTML = `R$${produto.custo.toFixed(2)}`;
            cell4.innerHTML = `<button class="remove-btn" data-index="${index}"><i class="fas fa-trash"></i> Remover</button>`;
        });

        document.querySelectorAll('.remove-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                var index = this.getAttribute('data-index');
                removerProduto(index);
            });
        });
    }

    // Atualizar valor total
    function atualizarValorTotal() {
        let total = 0;
        produtosSelecionados.forEach(function (produto) {
            total += produto.custo;
        });
        document.querySelector("#valCardapio").innerHTML = `Total: R$${total.toFixed(2)}`;
    }
});
</script>
</body>
</html>