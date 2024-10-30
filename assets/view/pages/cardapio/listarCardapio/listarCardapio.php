<?php
    require_once __DIR__ . '/../../../../controller/cardapioController.php';
    require_once __DIR__ . "/../../../../controller/userController.php";
    require_once __DIR__ . "/../../../../model/utils.php";
    session_start();
    
    $user = $_SESSION['user'];
    $tipo_usuario = $user->getTipoUsuario();

    if(!isset($user)){
        header("Location: index.php");
    }

    $podeGerenciarCardapios = verificarPermissao($tipo_usuario, 'gerenciar_cardapios');

    $cardapioController = new CardapioController();
    $cardapios = $cardapioController->listarCardapios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cardápios</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <h1>Listar Cardápios</h1>
        <section class="search">
            <input type="text" name="search" placeholder="Pesquisar produtos...">
            <button type="submit">Pesquisar</button>
        <section class="add-user">
        <?php if ($podeGerenciarCardapios): ?>
            <a href="../cadastrarCardapio/cadCardapio.php" class="add-user-btn">Cadastrar Cardápio</a>
            <?php endif; ?>
            </section>
        </section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nutricionista</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Descrição</th>
                    <?php if ($podeGerenciarCardapios): ?>
                        <th colspan="2">Ações</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($cardapios) {
                    foreach ($cardapios as $cardapio) {
                        echo "<tr>";
                         echo "<td>{$cardapio['id']}</td>";
                         echo "<td> Nome nutricionista </td>";
                         echo "<td>{$cardapio['data_inicio']}</td>";
                         echo "<td>{$cardapio['data_fim']}</td>";
                         echo "<td>{$cardapio['descricao']}</td>";
                        if ($podeGerenciarCardapios) {
                            echo "<td><a href='../editarCardapio/editCardapio.php?id={$cardapio['id']}'class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                            echo "<td><a href='../deleteCardapio/delCardapio.php?id={$cardapio['id']}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum cardápio encontrado.</td></tr>";
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