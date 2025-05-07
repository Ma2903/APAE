<?php
session_start();
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorCota = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorNutricionista = new ControladorUsuarios();

if (isset($_GET['id'])) {
    $cardapioID = $_GET['id'];
    $cardapio = $controladorCardapio->getCardapioById($cardapioID);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_cardapio'])) {
    if (empty($_POST['nutricionista']) || empty($_POST['dataC']) || empty($_POST['periodo']) || empty($_POST['descricao'])) {
        die("Todos os campos são obrigatórios.");
    }

    // Cria o cardápio
    $controladorCardapio->updatecardapio($_POST['nutricionista'], $_POST['dataC'], $_POST['periodo'], $_POST['descricao']);
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
                $controladorCardapio->editarCadProd($cardMaior, $produto['produtoId'], $produto['quantidade']);
            } else {
                error_log("Produto com dados incompletos: " . json_encode($produto));
            }
        }
    }

    // Redireciona para a página de listagem de cardápios
    // header('Location: ../listarCardapio/listarCardapio.php');
    // exit();
}
var_dump($controladorCota->listarCadProdutos($cardapioID));
var_dump($_POST['produtos']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cardápio</title>
    <link rel="stylesheet" href="../../styles/EditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <style>
.cardapioedit{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: 20px;
}    

form{
    min-height: 500px;
}

#produtoForm{
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

#cardapioForm{
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.secbutton{
    display: flex;
    justify-content: end;
}

.lista-produtos{
    color: #2a3e85;
    overflow-y: scroll;
    min-height: 240px;
    max-height: 240px;
    margin-top: 10px;
}
table{
    border-collapse: collapse;
}

.lista-produtos th, .lista-produtos td{
    border: 1px solid #2a3e85;
}

.lista-produtos td{
    padding: 5px;   
}
.confirm{
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    button{
        margin-top: 0;
    }	
}
#valCardapio{
    font-size: 24px;
}


    </style> -->
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Editar Cardápio</h1>
    <div class="cardapioedit">
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
            <button type="submit" name="adicionar_produto">Editar Cardápio</button>
            <span id="valCardapio">Total: R$00.00</span>
        </div>
    </form>
    <div class="barra"></div>
        <form id="produtoForm" name="produtosForm" action="" method="post">
            <input type="hidden" name="form_type" value="produtosForm">
            <section>
                <label for="produto_id">Produto:</label>
                <select id="produto" name="produto" required>
                    <?php 
                    $produtos = $controladorProduto->filtrarProdutosCotadosSemanaAtual();
                    foreach ($produtos as $produto) {
                        echo "<option value='{$produto['produto']->getId()}' precopergrama='{$produto['preco_por_grama']}'>{$produto['produto']->getNome()}</option>";
                    }
                    if(empty($produtos)){
                        echo "<option value=''>Nenhum produto disponível</option>";
                    }
                    ?>
                </select>
            </section>
            <section>
                <label for="quantidade">Quantidade (g):</label>
                <input type="number" id="quantidade" name="quantidade" required placeholder="30(g)">
            </section>
            <section class="secbutton">
                <button type="submit" name="adicionar_produto">Adicionar Produto</button>
            </section>
            <div class="lista-produtos">
                <h2>Lista de Produtos Adicionados</h2>
                <table id="listaProdutosTable" width="100%">
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
    <?php else: ?>
        <p>Cardápio não encontrado.</p>
    <?php endif; ?>
    </div>
</main>
<?php renderFooter(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var produtosSelecionados = [];
    var produtosSalvos = [];

    // Carrega os produtos do banco de dados
    produtosSelecionados = produtosSelecionados.concat(
        <?php echo json_encode($controladorCota->listarCadProdutos($cardapioID), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>
    );

    atualizarTabela();
    atualizarValorTotal();

    document.getElementById('produtoForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var produtoSelect = document.getElementById('produto');
        var produtoId = produtoSelect.value;
        var produtoNome = produtoSelect.options[produtoSelect.selectedIndex].text;
        var quantidade = parseFloat(document.getElementById('quantidade').value);

        var produtoCusto = 0;

        // Busca o custo do produto na lista de produtos carregados do banco
        var produtoBanco = produtosSelecionados.find(function(produto) {
            return produto.produtoId == produtoId;
        });

        if (produtoBanco) {
            produtoCusto = produtoBanco.custo * quantidade;
        } else {
            produtoCusto = produtoSelect.options[produtoSelect.selectedIndex].getAttribute('precopergrama') * quantidade;
        }

        // Adiciona o produto à lista
        produtosSelecionados.push({ produtoId: produtoId, produto: produtoNome, quantidade: quantidade, custo: produtoCusto });
        produtosSalvos.push({ produtoId: produtoId, produto: produtoNome, quantidade: quantidade });

        // Atualiza a tabela
        atualizarTabela();
        atualizarValorTotal();
        limpaValores();
    });

    function atualizarTabela() {
        var tableBody = document.getElementById('produtosBody');
        tableBody.innerHTML = '';

        produtosSelecionados.forEach(function(produto, index) {
            var newRow = tableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            cell1.innerHTML = produto.produto;
            cell2.innerHTML = produto.quantidade;
            cell3.innerHTML = `R$${produto.custo.toFixed(2)}`;
            cell4.innerHTML = `<button class="remove-btn" onclick="removerProduto(${index})">Remover</button>`;
        });

        console.log("Tabela atualizada com os produtos:", produtosSelecionados);
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

    // Função para remover um produto da lista
    window.removerProduto = function(index) {
        // Remove o produto pelo índice
        produtosSelecionados.splice(index, 1);

        // Atualiza a tabela e o valor total
        atualizarTabela();
        atualizarValorTotal();
    };

    // Antes de enviar o formulário principal, armazena os produtos no campo oculto
    document.querySelector("#cardapioForm").addEventListener('submit', function() {
        document.getElementById('produtos').value = JSON.stringify(produtosSalvos);
        console.log("Produtos enviados:", produtosSalvos); // Depuração
    });
});
</script>
</body>
</html>
