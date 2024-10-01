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
            <a href="../../index.php" class="home-btn">Home</a>
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
    <main>
        <h1>Listar Cotações</h1>
        <section class="search">
        <input type="text" name="search" placeholder="Pesquisar cotações...">
        <button type="submit">Pesquisar</button>
    </section>
    <section class="add-quote">
        <a href="../cadastrarCotacoes/cadCotacoes.php" class="add-quote-btn">Cadastrar Nova Cotação</a>
    </section>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Data</th>
                <th>Fornecedor</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Aqui você deve adicionar o código PHP para listar as cotações
            // Exemplo:
            // $cotas = obterCotas(); // Função fictícia para obter cotações do banco de dados
            // foreach ($cotas as $cotacao) {
            //     echo "<tr>";
            //     echo "<td>{$cotacao['id']}</td>";
            //     echo "<td>{$cotacao['produto_nome']}</td>";
            //     echo "<td>{$cotacao['fornecedor_nome']}</td>";
            //     echo "<td>{$cotacao['preco_unitario']}</td>";
            //     echo "<td>{$cotacao['quantidade']}</td>";
            //     echo "<td>{$cotacao['data_cotacao']}</td>";
                echo "<td><a href='../editarCotacoes/editCotacoes.php?'>Editar</a></td>";
                echo "<td><a href='../deletarCotacoes/delCotacoes.php?'>Deletar</a></td>";
            //     echo "</tr>";
            // }
            ?>
        </tbody>
    </table>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>