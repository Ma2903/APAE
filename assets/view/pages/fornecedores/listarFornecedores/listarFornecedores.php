<?php
require_once __DIR__ . "/../../../../controller/fornecedorController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
$controler = new ControladorFornecedor();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Fornecedores</title>
    <link rel="stylesheet" href="../../styles/ListarStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1>Lista de Fornecedores</h1>
    <section class="search">
        <input type="text" id="search-input" name="search" placeholder="Pesquisar fornecedores..." onkeyup="searchSuppliers()">
        <section class="add-product">
            <a href="../cadastroFornecedores/cadFornecedores.php" class="add-product-btn">Cadastrar Novo Fornecedor</a>
        </section>
        <section class="filter">
            <button class="filter-btn" onclick="toggleFilterMenu()">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <section class="filter-menu" id="filter-menu">
                <button onclick="filterSuppliers('alimenticio')">Alimenticio</button>
                <button onclick="filterSuppliers('açougue')">Açougue</button>
                <button onclick="filterSuppliers('frutas')">Frutas</button>
                <button class="close-filter" onclick="clearFilter()"><i class="fas fa-times"></i></button>
            </section>
        </section>
    </section>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>WhatsApp</th>
                <th>E-mail</th>
                <th>Ramo de Atuação</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody id="supplier-table-body">
            <?php
            $fornecedores = $controler->verFornecedor();
            // Ordenar fornecedores em ordem alfabética pelo nome
            usort($fornecedores, function($a, $b) {
                return strcmp($a->getNome(), $b->getNome());
            });

            if ($fornecedores) {
                foreach ($fornecedores as $fornecedor) {
                    echo "<tr>";
                    echo "<td>{$fornecedor->getNome()}</td>";
                    echo "<td>{$fornecedor->getEndereco()}</td>";
                    echo "<td>{$fornecedor->getTelefone()}</td>";
                    echo "<td>{$fornecedor->getWhatsapp()}</td>";
                    echo "<td>{$fornecedor->getEmail()}</td>";
                    echo "<td>{$fornecedor->getRamo()}</td>";
                    echo "<td><a href='../editarFornecedores/editFornecedores.php?id={$fornecedor->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar</a></td>";
                    echo "<td><a href='../deleteFornecedores/delFornecedores.php?id={$fornecedor->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum fornecedor encontrado.</td></tr>";
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

    function filterSuppliers(ramo) {
        const rows = document.querySelectorAll('#supplier-table-body tr');
        rows.forEach(row => {
            const supplierRamo = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
            if (supplierRamo.includes(ramo)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function clearFilter() {
        const rows = document.querySelectorAll('#supplier-table-body tr');
        rows.forEach(row => {
            row.style.display = '';
        });
        toggleFilterMenu(); // Fechar o menu de filtro
    }

    function searchSuppliers() {
        const input = document.getElementById('search-input');
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll('#supplier-table-body tr');
        rows.forEach(row => {
            const supplierName = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            if (supplierName.startsWith(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
</body>
</html>