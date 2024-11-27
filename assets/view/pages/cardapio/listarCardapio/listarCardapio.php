<?php
    require_once __DIR__ . '/../../../../controller/cardapioController.php';
    require_once __DIR__ . "/../../../../controller/userController.php";
    require_once __DIR__ . "/../../../../controller/produtoController.php";
    require_once __DIR__ . "/../../../../controller/pageController.php";
    require_once __DIR__ . "/../../../../model/utils.php";
    session_start();
    
    $user = $_SESSION['user'];
    $tipo_usuario = $user->getTipoUsuario();

    if(!isset($user)){
        header("Location: index.php");
    }

    $podeGerenciarCardapios = verificarPermissao($tipo_usuario, 'gerenciar_cardapios');

    $cardapioController = new cardapioController();
    $controladorProduto = new ControladorProdutos();
    $cardapios = $cardapioController->listarcardapios();

    // Supondo que $cardapios seja um array de objetos Cardapio
    usort($cardapios, function($a, $b) {
        return strtotime($b->getDataC()) - strtotime($a->getDataC());
    });
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cardápios</title>
    <link rel="stylesheet" href="../../styles/ListarStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php renderHeader(); ?>
    <main>
        <h1>Listar Cardápios</h1>
        <section class="search">
            <input type="text" id="search-input" name="search" placeholder="Pesquisar produtos...">
        <section class="add-user">
        <?php if ($podeGerenciarCardapios): ?>
            <a href="../cadastrarCardapio/cadCardapio.php" class="add-user-btn">Cadastrar Cardápio</a>
            <?php endif; ?>
            </section>
            <section class="filter">
            <button class="filter-btn" onclick="toggleFilterMenu()">
                <i class="fas fa-filter"></i> Filtrar
            </button>
                <section class="filter-menu" id="filter-menu">
                    <button onclick="filterUsers('contador')">Contadores</button>
                    <button onclick="filterUsers('nutricionista')">Nutricionistas</button>
                    <button onclick="filterUsers('administrador')">Administradores</button>
                    <button class="close-filter" onclick="clearFilter()"><i class="fas fa-times"></i></button>
                </section>
            </section>
        </section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nutricionista</th>
                    <th>Período</th>
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
                        echo "<td colspan='7'><h2>{$cardapio->getDataC()}</h2></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>{$cardapio->getId()}</td>";
                        echo "<td>{$cardapio->getNutricionistaId()}</td>";
                        echo "<td>{$cardapio->getPeriodo()}</td>";
                        echo "<td>{$cardapio->getDescricao()}</td>";
                        if ($podeGerenciarCardapios) {
                            echo "<td><a href='../editarCardapio/editCardapio.php?id={$cardapio->getId()}&nutricionista_id={$cardapio->getNutricionistaId()}' class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                            echo "<td><a href='../deleteCardapio/delCardapio.php?id={$cardapio->getId()}' class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
                        }
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='7'><h2>Produtos:{$controladorProduto->verCadProdutos()}</h2></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum cardápio encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php renderFooter(); ?>
</body>
</html>