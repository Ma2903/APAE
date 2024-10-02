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
        <input type="text" name="search" placeholder="Pesquisar cotações...">
        <button type="submit">Pesquisar</button>
        <section class="add-quote">
        <?php if ($podeGerenciarCotacoes): ?>
            <a href="../cadastrarCotacoes/cadCotacoes.php" class="add-quote-btn">Cadastrar Nova Cotação</a>
        <?php endif; ?>
        </section>
    </section>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Data</th>
                <th>Fornecedor</th>
                <th>DataCotação</th>
                <?php if ($podeGerenciarCotacoes): ?>
                <th colspan="2">Ações</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php // Função fictícia para obter cotações do banco de dados
            foreach ($cotas as $cotacao) {
                echo "<tr>";
                echo "<td>{$cotacao->getId()}</td>";
                foreach ($controladorProduto->verProdutos() as $produto) {
                    if($cotacao->getProdutoId() == $produto->getId()){
                        echo "<td>{$produto->getNome()}</td>";
                    }
                }
                foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                    if($cotacao->getFornecedorId() == $fornecedor->getId()){
                        echo "<td>{$fornecedor->getNome()}</td>";
                    }
                }
                echo "<td>{$cotacao->getPrecoUnitario()}</td>";
                echo "<td>{$cotacao->getQuantidade()}</td>";
                echo "<td>{$cotacao->getDataCotacao()}</td>";
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