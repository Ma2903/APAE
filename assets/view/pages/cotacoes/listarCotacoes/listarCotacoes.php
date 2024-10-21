<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
require_once __DIR__ . "/../../../../controller/pageController.php";
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../../../model/utils.php";
session_start();

$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();

$cotas = $controladorCotacao->verCotas();

$user = $_SESSION['user'];
$tipo_usuario = $user->getTipoUsuario();

if(!isset($user)){
    header("Location: index.php");
}

$podeGerenciarCotacoes = verificarPermissao($tipo_usuario, 'gerenciar_cotacoes');

// Função para calcular maior e menor preço por produto
function calcularMaiorMenorPreco($cotas) {
    $resultados = [];

    foreach ($cotas as $cotacao) {
        $produtoId = $cotacao->getProdutoId();
        $preco = $cotacao->getPrecoUnitario();
        $fornecedorId = $cotacao->getFornecedorId();

        if (!isset($resultados[$produtoId])) {
            $resultados[$produtoId] = [
                "maior_preco" => $preco,
                "menor_preco" => $preco,
                "fornecedor_maior" => $fornecedorId,
                "fornecedor_menor" => $fornecedorId
            ];
        } else {
            if ($preco > $resultados[$produtoId]["maior_preco"]) {
                $resultados[$produtoId]["maior_preco"] = $preco;
                $resultados[$produtoId]["fornecedor_maior"] = $fornecedorId;
            }
            if ($preco < $resultados[$produtoId]["menor_preco"]) {
                $resultados[$produtoId]["menor_preco"] = $preco;
                $resultados[$produtoId]["fornecedor_menor"] = $fornecedorId;
            }
        }
    }

    return $resultados;
}

    $precos = calcularMaiorMenorPreco($cotas);

// Função para filtrar cotações por intervalo de datas
function filtrarPorData($cotas, $dataInicio, $dataFim) {
    $filtradas = [];

    foreach ($cotas as $cotacao) {
        $dataCotacao = $cotacao->getDataCotacao();
        if ($dataCotacao >= $dataInicio && $dataCotacao <= $dataFim) {
            $filtradas[] = $cotacao;
        }
    }

    return $filtradas;
}

$dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';
$dataFim = isset($_GET['dataFim']) ? $_GET['dataFim'] : '';

$cotasFiltradas = $dataInicio && $dataFim ? filtrarPorData($cotas, $dataInicio, $dataFim) : $cotas;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cotações</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1>Listar Cotações</h1>
    <section class="search">
        <form method="GET" action="" class="date-filter-form">
            <label for="dataInicio">Data Início:</label>
            <input type="date" id="dataInicio" name="dataInicio" value="<?= $dataInicio ?>">
            <label for="dataFim">Data Fim:</label>
            <input type="date" id="dataFim" name="dataFim" value="<?= $dataFim ?>">
            <button type="submit">Filtrar</button>
            <section class="add-quote">
                <?php if ($podeGerenciarCotacoes): ?>
                    <a href="../cadastrarCotacoes/cadCotacoes.php" class="add-quote-btn">Cadastrar Nova Cotação</a>
                <?php endif; ?>
            </section>
        </form>
    </section>
    <table>
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>DataCotação</th>
                <th>Preços (Maior | Menor)</th>
                <th>Fornecedores (Maior | Menor)</th>
                <?php if ($podeGerenciarCotacoes): ?>
                <th colspan="2">Ações</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($cotasFiltradas as $cotacao) {
                $produtoId = $cotacao->getProdutoId();
                $fornecedorId = $cotacao->getFornecedorId();
                $produtoNome = '';
                $fornecedorNome = '';

                foreach ($controladorProduto->verProdutos() as $produto) {
                    if ($produtoId == $produto->getId()) {
                        $produtoNome = $produto->getNome();
                    }
                }

                foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                    if ($fornecedorId == $fornecedor->getId()) {
                        $fornecedorNome = $fornecedor->getNome();
                    }
                }

                $maiorPreco = $precos[$produtoId]['maior_preco'];
                $menorPreco = $precos[$produtoId]['menor_preco'];
                $fornecedorMaiorPreco = $controladorFornecedor->verFornecedorPorId($precos[$produtoId]['fornecedor_maior'])->getNome();
                $fornecedorMenorPreco = $controladorFornecedor->verFornecedorPorId($precos[$produtoId]['fornecedor_menor'])->getNome();

                // Formatar a data para o formato brasileiro
                $dataCotacao = date("d/m/Y", strtotime($cotacao->getDataCotacao()));

                echo "<tr>";
                echo "<td>{$produtoNome}</td>";
                echo "<td>{$dataCotacao}</td>";
                echo "<td>R$ <span class='maior-preco'>{$maiorPreco} ↑</span> | R$ <span class='menor-preco'>{$menorPreco} ↓</span></td>";
                echo "<td> <span class='maior-preco'>{$fornecedorMaiorPreco} ↑</span> | <span class='menor-preco'>{$fornecedorMenorPreco} ↓</span></td>";
                if ($podeGerenciarCotacoes) {
                    echo "<td> <a href='../editarCotacoes/editCotacoes.php?id={$cotacao->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                    echo "<td> <a href='../deletarCotacoes/delCotacoes.php?id={$cotacao->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
</body>
</html>