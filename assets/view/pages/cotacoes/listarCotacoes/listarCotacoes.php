<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
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
</head>
<body>
<header>
    <section class="header-container">
        <section class="logo-container">
            <img src="../../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </section>
        <section class="user-info">
            <a href="../../principal.php" class="home-btn">Home</a>
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
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
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Fornecedor</th>
                <th>DataCotação</th>
                <th>Maior Preço</th>
                <th>Fornecedor Maior Preço</th>
                <th>Menor Preço</th>
                <th>Fornecedor Menor Preço</th>
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

                echo "<tr>";
                echo "<td>{$cotacao->getId()}</td>";
                echo "<td>{$produtoNome}</td>";
                echo "<td>{$cotacao->getPrecoUnitario()}</td>";
                echo "<td>{$cotacao->getQuantidade()}</td>";
                echo "<td>{$fornecedorNome}</td>";
                echo "<td>{$cotacao->getDataCotacao()}</td>";
                echo "<td>{$maiorPreco}</td>";
                echo "<td>{$fornecedorMaiorPreco}</td>";
                echo "<td>{$menorPreco}</td>";
                echo "<td>{$fornecedorMenorPreco}</td>";
                if ($podeGerenciarCotacoes) {
                    echo "<td> <a href='../editarCotacoes/editCotacoes.php?id={$cotacao->getId()}'>Editar</a> </td>";
                    echo "<td> <a href='../deletarCotacoes/delCotacoes.php?id={$cotacao->getId()}'>Deletar</a> </td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>