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
<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
=======
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
>>>>>>> 7d437f2677a998a3b3e932ccf4364d50c5966fd9
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarCardapio/listarCardapio.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
<<<<<<< HEAD
<h1><i class="fas fa-edit"></i> Editar Cardápio</h1>
<div class="form">
    <!-- Coluna Esquerda -->
    <div class="form-left">
        <?php if ($cardapio): ?>
        <form id="cardapioForm" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $cardapio->getId(); ?>">
            <section>
                <label for="nutricionista"><i class="fas fa-user-md"></i> Nutricionista:</label>
=======
    <h1>Editar Cardápio</h1>
    <div class="cardapioedit">
    <?php if ($cardapio): ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $cardapio->getId(); ?>">
        <div>
            <label for="nutricionista">Nutricionista:</label>
>>>>>>> 7d437f2677a998a3b3e932ccf4364d50c5966fd9
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
<<<<<<< HEAD
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
=======
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
>>>>>>> 7d437f2677a998a3b3e932ccf4364d50c5966fd9
                <select id="produto" name="produto" required>
                    <?php 
                    $produtos = $controladorProduto->filtrarProdutosCotadosSemanaAtual();
                    foreach ($produtos as $produto) {
                        echo "<option value='{$produto['produto']->getId()}' precopergrama='{$produto['preco_por_grama']}'>{$produto['produto']->getNome()}</option>";
                    }
<<<<<<< HEAD
                    if (empty($produtos)) {
=======
                    if(empty($produtos)){
>>>>>>> 7d437f2677a998a3b3e932ccf4364d50c5966fd9
                        echo "<option value=''>Nenhum produto disponível</option>";
                    }
                    ?>
                </select>
            </section>
            <section>
<<<<<<< HEAD
                <label for="quantidade"><i class="fas fa-weight"></i> Quantidade (g):</label>
                <input type="number" id="quantidade" name="quantidade" required placeholder="30(g)">
            </section>
            <section class="secbutton">
                <button type="submit" name="adicionar_produto"><i class="fas fa-plus"></i> Adicionar Produto</button>
            </section>
            <div class="lista-produtos">
                <h2><i class="fas fa-list"></i> Lista de Produtos Adicionados</h2>
                <table id="listaProdutosTable">
=======
                <label for="quantidade">Quantidade (g):</label>
                <input type="number" id="quantidade" name="quantidade" required placeholder="30(g)">
            </section>
            <section class="secbutton">
                <button type="submit" name="adicionar_produto">Adicionar Produto</button>
            </section>
            <div class="lista-produtos">
                <h2>Lista de Produtos Adicionados</h2>
                <table id="listaProdutosTable" width="100%">
>>>>>>> 7d437f2677a998a3b3e932ccf4364d50c5966fd9
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
<<<<<<< HEAD
</div>
</main>
<?php renderFooter(); ?>
=======
    <?php else: ?>
        <p>Cardápio não encontrado.</p>
    <?php endif; ?>
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

        var produtoCusto = produtoSelect.options[produtoSelect.selectedIndex].getAttribute('precopergrama') * quantidade;

        // Adiciona o produto à lista
        produtosSelecionados.push({ produtoId: produtoId, produto: produtoNome, quantidade: quantidade, custo: produtoCusto });

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

    window.removerProduto = function(index) {
        // Remove o produto da lista pelo índice
        produtosSelecionados.splice(index, 1);

        // Atualiza a tabela e o valor total
        atualizarTabela();
        atualizarValorTotal();
    };

    document.querySelector("#cardapioForm").addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = new FormData();

        formData.append('nutricionista_id', document.querySelector("#nutricionista").value);
        formData.append('dataC', document.querySelector("#dataC").value);
        formData.append('periodo', document.querySelector("#periodo").value);
        formData.append('descricao', document.querySelector("#descricao").value);

        formData.append('produtos', JSON.stringify(produtosSelecionados));

        fetch('procCad.php', {
            method: 'POST',
            body: formData
        }).then(response => window.location.href = './editarCardapio/procCad.php');
    });
});
</script>
>>>>>>> 7d437f2677a998a3b3e932ccf4364d50c5966fd9
</body>
</html>
