<?php
session_start();
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorProduto = new ControladorProdutos();
$controladorCotacao = new ControladorCotacao();
$controladorNutricionista = new ControladorUsuarios();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_cardapio'])) {
    if (empty($_POST['nutricionista']) || empty($_POST['dataC']) || empty($_POST['periodo']) || empty($_POST['descricao'])) {
        die("Todos os campos são obrigatórios.");
    }

    // Cria o cardápio
    $controladorCardapio->criarcardapio($_POST['nutricionista'], $_POST['dataC'], $_POST['periodo'], $_POST['descricao']);
    $cardapios = $controladorCardapio->listarcardapios();

    // Obtém o ID do último cardápio criado
    $cardMaior = 0;
    foreach ($cardapios as $cardapio) {
        if ($cardapio->getId() > $cardMaior) {
            $cardMaior = $cardapio->getId();
        }
    }

    // Decodifica os produtos enviados como JSON
    $produtos = json_decode($_POST['produtos'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Erro ao decodificar JSON: " . json_last_error_msg());
    }

    // Insere os produtos no banco de dados
    if (is_array($produtos)) {
        foreach ($produtos as $produto) {
            if (isset($produto['produtoId'], $produto['quantidade'])) {
                var_dump($cardMaior, $produto['produtoId'], $produto['quantidade']); // Depuração
                $controladorCardapio->criarCadProd($cardMaior, $produto['produtoId'], $produto['quantidade']);
            } else {
                error_log("Produto com dados incompletos: " . json_encode($produto));
            }
        }
    }

    // Redireciona para a página de listagem de cardápios
    // header('Location: ../listarCardapio/listarCardapio.php');
    // exit();
}
var_dump($_POST['produtos']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cardápio</title>
    <link rel="stylesheet" href="../../styles/CadStyle.css">
    <link rel="stylesheet" href="./custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
<h1><i class="fas fa-utensils"></i> Cadastrar Cardápio</h1>
<div class="form">
    <!-- Coluna Esquerda -->
    <div class="form-left">
        <form id="cardapioForm" action="" method="post">
            <input type="hidden" name="form_type" value="cardapioForm">
            <input type="hidden" id="produtos" name="produtos"> <!-- Campo oculto para armazenar os produtos -->
            <section>
                <label for="nutricionista"><i class="fas fa-user-md"></i> Nutricionista:</label>
                <select id="nutricionista" name="nutricionista" required>
                    <?php $controladorNutricionista->filtrarNutricionistas(); ?>
                </select>
            </section>
            <section>
                <label for="dataC"><i class="fas fa-calendar-alt"></i> Data:</label>
                <input type="date" id="dataC" name="dataC" required>
            </section>
            <section>
                <label for="periodo"><i class="fas fa-clock"></i> Período:</label>
                <select id="periodo" name="periodo" required>
                    <option value="manha">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="manha-tarde">Manhã e Tarde</option>
                </select>
            </section>
            <section>
                <label for="descricao"><i class="fas fa-align-left"></i> Descrição:</label>
                <textarea id="descricao" name="descricao" placeholder="Digite a descrição do cardápio..." required></textarea>
            </section>
            <section class="confirm">
                <button type="submit" name="cadastrar_cardapio" id="cadBtn"><i class="fas fa-save"></i> Cadastrar Cardápio</button>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var produtosSelecionados = [];
    var produtosSalvos = [];

    document.getElementById('produtoForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var produtoSelect = document.getElementById('produto');
        var produtoId = produtoSelect.value;
        var produtoNome = produtoSelect.options[produtoSelect.selectedIndex].text;
        var quantidade = document.getElementById('quantidade').value;

        var produtoCusto = produtoSelect.options[produtoSelect.selectedIndex].getAttribute('precopergrama') * quantidade;

        // Adiciona o produto à lista
        produtosSelecionados.push({ produtoId: produtoId, produto: produtoNome, quantidade: quantidade, custo: produtoCusto });
        produtosSalvos.push({ produtoId: produtoId, produto: produtoNome, quantidade: quantidade});
        // Atualiza a tabela
        atualizarTabela();
        atualizarValorTotal();
        limpaValores();
    });

    function atualizarTabela() {
        var tableBody = document.getElementById('produtosBody');
        tableBody.innerHTML = '';

        // produtosSalvos.forEach(function(produto, index) {
        //     var newRow = tableBody.insertRow();
        //     var cell1 = newRow.insertCell(0);
        //     var cell2 = newRow.insertCell(1);
        //     cell1.innerHTML = produto.produto;
        //     cell2.innerHTML = produto.quantidade;
        // });
        produtosSelecionados.forEach(function(produto) {
            var newRow = tableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            cell1.innerHTML = produto.produto;
            cell2.innerHTML = produto.quantidade;
            cell3.innerHTML = `R$${produto.custo.toFixed(2)}`;
        });
        console.log(produtosSelecionados);
        console.log(produtosSalvos); // Depuração
    }

    function atualizarValorTotal() {
        let total = 0;
        produtosSelecionados.forEach(function(produto) {
            total += produto.custo;
        });
        document.querySelector("#valCardapio").innerHTML = `Total: R$${total.toFixed(2)}`;
    }

    function limpaValores() {
        document.getElementById('produto').value = '';
        document.getElementById('quantidade').value = '';
    }

    // Antes de enviar o formulário principal, armazena os produtos no campo oculto
    document.querySelector("#cardapioForm").addEventListener('submit', function() {
        document.getElementById('produtos').value = JSON.stringify(produtosSalvos);
        console.log("Produtos enviados:", produtosSalvos); // Depuração
    });
});
</script>
</body>
</html>