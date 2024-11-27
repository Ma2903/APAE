<?php
    require_once __DIR__ . "/../../../../controller/produtoController.php";
    require_once __DIR__ . "/../../../../controller/userController.php";
    require_once __DIR__ . "/../../../../controller/pageController.php";
    require_once __DIR__ . "/../../../../model/utils.php"; 
    session_start();

    $controler = new ControladorProdutos();
    $user = $_SESSION['user'];
    $tipo_usuario = $user->getTipoUsuario();

    if(!isset($user)){
        header("Location: index.php");
    }

    $podeGerenciarProdutos = verificarPermissao($tipo_usuario, 'gerenciar_produtos');
?>
    
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos</title>
    <link rel="stylesheet" href="../../styles/ListarStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1>Listar Produtos</h1>
        <section class="search">
        <input type="text" id="search-input" name="search" placeholder="Pesquisar Produtos..." onkeyup="searchProducts()">
            <section class="add-product">
            <?php if ($podeGerenciarProdutos): ?>
                <a href="../cadastroProduto/cadProduto.php" class="add-product-btn">Cadastrar Novo Produto</a>
                <?php endif; ?>
            </section>
            <section class="filter">
            <button class="filter-btn" onclick="toggleFilterMenu()">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <section class="filter-menu" id="filter-menu">
                <button onclick="filterProducts('alimenticios')">Alimenticios</button>
                <button onclick="filterProducts('acougue')">Açougue</button>
                <!-- <button onclick="filterProducts('bebidas')">Bebidas</button> -->
                <button onclick="filterProducts('descartaveis')">Descartáveis</button>
                <button onclick="filterProducts('frios')">Frios</button>
                <button onclick="filterProducts('frutas')">Frutas</button>
                <button onclick="filterProducts('higiene pessoal')">Higiene Pessoal</button>
                <button onclick="filterProducts('limpeza')">Limpeza</button>
                <button onclick="filterProducts('verduras')">Verduras</button>
                <button onclick="filterProducts('outros')">Outros</button>
                <button class="close-filter" onclick="clearFilter()"><i class="fas fa-times"></i></button>
            </section>
        </section>
    </section>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Data de Criação</th>
                <?php if ($podeGerenciarProdutos): ?>
                <th colspan="2">Ações</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php
            $produtos = $controler->verProdutos();
            usort($produtos, function($a, $b) {
                return strcmp($a->getNome(), $b->getNome());
            });
            if ($produtos) {
                foreach ($produtos as $produto) {
                    $dataCriacao = date('d-m-Y', strtotime($produto->getDtCriacao()));
                    echo "<tr>";
                    echo "<td>{$produto->getNome()}</td>";
                    echo "<td>{$produto->getCategoria()}</td>";
                    echo "<td>{$dataCriacao}</td>";
                    if ($podeGerenciarProdutos) {
                        echo "<td> <a href='../editarProduto/editProduto.php?id={$produto->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar</a> </td>";
                        echo "<td> <a href='../deleteProduto/delProduto.php?id={$produto->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar</a> </td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum produto encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
<script>
    function toggleFilterMenu() {
        const filterMenu = document.getElementById('filter-menu');
        filterMenu.classList.toggle('show');
    }

    function filterProducts(category) {
        const rows = document.querySelectorAll('#product-table-body tr');
        rows.forEach(row => {
            const productCategory = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (productCategory.includes(category)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function clearFilter() {
        const rows = document.querySelectorAll('#product-table-body tr');
        rows.forEach(row => {
            row.style.display = '';
        });
        const filterMenu = document.getElementById('filter-menu');
        filterMenu.classList.remove('show');
    }

    document.getElementById('search-input').addEventListener('input', function() {
        const filterValue = this.value;
        if (filterValue) {
            searchProducts(filterValue);
        } else {
            clearFilter();
        }
    });

    function searchProducts() {
        const searchInput = document.getElementById('search-input').value.toLowerCase();
        const rows = document.querySelectorAll('#product-table-body tr');
        rows.forEach(row => {
            const productName = row.querySelector('td:nth-child(1)').textContent.toLowerCase(); // Nome está na primeira coluna
            if (productName.startsWith(searchInput)) { // Verifica se o nome começa com a letra digitada
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
</body>
</html>