<?php
    require_once __DIR__ . "/../../../../controller/produtoController.php";
    $controler = new ControladorProdutos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos</title>
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
            <a href="../../index.php" class="home-btn">Home</a>
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
    <h1>Listar Produtos</h1>
    <section class="search">
        <input type="text" name="search" placeholder="Pesquisar produtos...">
        <button type="submit">Pesquisar</button>
    </section>
    <section class="add-product">
        <a href="../cadastroProduto/cadProduto.php" class="add-product-btn">Cadastrar Novo Produto</a>
    </section>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Unidade de Medida</th>
                <th>Data de Criação</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($controler->verProdutos()) {
                $produtos = $controler->verProdutos();
                foreach ($produtos as $produto) {
                    echo "<tr>";
                    echo "<td>{$produto->getId()}</td>";
                    echo "<td>{$produto->getNome()}</td>";
                    echo "<td>{$produto->getCategoria()}</td>";
                    echo "<td>{$produto->getUn()}</td>";
                    echo "<td>{$produto->getDtCriacao()}</td>";
                    echo "<td><a href='../editarProduto/editProduto.php?id={$produto->getId()}'>Editar</a></td>";
                    echo "<td><a href='../deleteProduto/delProduto.php?id={$produto->getId()}'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum produto encontrado.</td></tr>";
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