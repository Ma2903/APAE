<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cardápios</title>
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
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
    <h1>Listar Cardápios</h1>
    <section class="search">
        <input type="text" name="search" placeholder="Pesquisar cardápios...">
        <button type="submit">Pesquisar</button>
    </section>
    <section class="add-cardapio">
        <a href="../cadastrarCardapio/cadCardapio.php" class="add-cardapio-btn">Cadastrar Novo Cardápio</a>
    </section>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nutricionista</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Descrição</th>
                <th>Data Criação</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Aqui você deve adicionar o código PHP para listar os cardápios
            // Exemplo:
            // $cardapios = obterCardapios(); // Função fictícia para obter cardápios do banco de dados
            // foreach ($cardapios as $cardapio) {
            //     echo "<tr>";
            //     echo "<td>{$cardapio['id']}</td>";
            //     echo "<td>{$cardapio['nutricionista_nome']}</td>";
            //     echo "<td>{$cardapio['data_inicio']}</td>";
            //     echo "<td>{$cardapio['data_fim']}</td>";
            //     echo "<td>{$cardapio['descricao']}</td>";
            //     echo "<td>{$cardapio['data_criacao']}</td>";
                 echo "<td><a href='../editarCardapio/editCardapio.php?'>Editar</a></td>";
                 echo "<td><a href='../deleteCardapio/delCardapio.php?'>Deletar</a></td>";
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