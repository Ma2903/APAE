<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo-container">
            <img src="../../../../../src/logo0.jpg" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </div>
        <div class="user-info">
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </div>
</header>
<main>
    <h1>Listar Produtos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Unidade de Medida</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aqui você deve adicionar o código PHP para listar os produtos -->
            <?php
            // Exemplo de código PHP para listar produtos
            // $produtos = obterProdutos(); // Função fictícia para obter produtos do banco de dados
            // foreach ($produtos as $produto) {
            //     echo "<tr>";
            //     echo "<td>{$produto['id']}</td>";
            //     echo "<td>{$produto['nome']}</td>";
            //     echo "<td>{$produto['categoria']}</td>";
            //     echo "<td>{$produto['unidade_medida']}</td>";
            //     echo "<td>{$produto['data_criacao']}</td>";
            //     echo "<td><a href='editProduto.php?id={$produto['id']}'>Editar</a></td>";
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