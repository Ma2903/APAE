<?php
session_start();
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
    <link rel="stylesheet" href="../../styles/CadStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Cadastrar Cardápio</h1>
    <div class="form">
        <form id="cardapioForm" action="" method="post">
            <input type="hidden" name="form_type" value="cardapioForm">
            <section>
                <label for="nutricionista">Nutricionista:</label>
                <select id="nutricionista" name="nutricionista" required>
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
                <textarea id="descricao" name="descricao" style="resize: none" rows="6" cols="100"></textarea>
            </section>
            <section>
                <button type="submit" name="cadastrar_cardapio">Cadastrar Cardápio</button>
            </section>
        </form>
        <div class="barra"></div>
        <form id="produtoForm" name="produtosForm" action="" method="post">
            <input type="hidden" name="form_type" value="produtosForm">
            <section>
                <label for="produto_id">Produto:</label>
                <select id="produto" name="produto" required>
                    <?php $controladorProduto->filtrarProdutos(); ?>
                </select>
            </section>
            <section>
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" required>
            </section>
            <section>
                <button type="submit" name="adicionar_produto">Adicionar Produto</button>
            </section>
            <div class="lista-produtos">
                <h2>Lista de Produtos Adicionados</h2>
                <table id="listaProdutosTable">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody id="produtosBody">
                        <!-- Produtos adicionados serão inseridos aqui -->
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</main>
<?php renderFooter(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var produtosSelecionados = [];

    document.getElementById('produtoForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var produtoSelect = document.getElementById('produto');
        var produtoId = produtoSelect.value;
        var produtoNome = produtoSelect.options[produtoSelect.selectedIndex].text;
        var quantidade = document.getElementById('quantidade').value;

        // Adiciona o produto à lista
        produtosSelecionados.push({ produto: produtoNome, quantidade: quantidade });

        // Atualiza a tabela
        atualizarTabela();
    });

    function atualizarTabela() {
        var tableBody = document.getElementById('produtosBody');
        tableBody.innerHTML = '';

        produtosSelecionados.forEach(function(produto) {
            var newRow = tableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            cell1.innerHTML = produto.produto;
            cell2.innerHTML = produto.quantidade;
        });
    }
});
</script>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['form_type'] === 'cardapioForm') {
        $controladorCardapio->criarcardapio($_POST['nutricionista'], $_POST['dataC'], $_POST['periodo'], $_POST['descricao']);
        header('Location: ../listarCardapio/listarCardapio.php');
    }
}
?>