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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1><i class="fas fa-truck"></i> Lista de Fornecedores</h1>
    <section class="search">
        <input 
            type="text" 
            id="search-input" 
            name="search" 
            placeholder="Pesquisar fornecedores..." 
            onkeyup="searchSuppliers()" 
            aria-label="Pesquisar fornecedores"
        >
        <section class="add-product">
            <a href="../cadastroFornecedores/cadFornecedores.php" class="add-product-btn" aria-label="Cadastrar novo fornecedor">
            <i class="fas fa-truck"></i></i> Cadastrar Novo Fornecedor
            </a>
        </section>
    </section>
    <section class="filter">
        <label for="ramo" class="filter-label">Filtrar por Ramo de Atuação:</label>
        <select id="ramo" name="ramo" onchange="filterSuppliersBySelect()" aria-label="Filtrar fornecedores por ramo">
            <option value="">Todos</option>
            <option value="alimenticio">Alimentício</option>
            <option value="açougue">Açougue</option>
            <option value="frutas">Frutas</option>
            <option value="verduras">Verduras</option>
            <option value="limpeza">Limpeza</option>
            <option value="outros">Outros</option>
        </select>
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
            usort($fornecedores, function($a, $b) {
                return strcmp($a->getNome(), $b->getNome());
            });

            if ($fornecedores) {
                foreach ($fornecedores as $fornecedor) {
                    $iconeRamo = '';
                    switch (strtolower($fornecedor->getRamo())) {
                        case 'alimenticio':
                            $iconeRamo = '<i class="fas fa-utensils"></i>';
                            break;
                        case 'açougue':
                            $iconeRamo = '<i class="fas fa-drumstick-bite"></i>';
                            break;
                        case 'frutas':
                            $iconeRamo = '<i class="fas fa-apple-alt"></i>';
                            break;
                        case 'verduras':
                            $iconeRamo = '<i class="fas fa-leaf"></i>';
                            break;
                        case 'limpeza':
                            $iconeRamo = '<i class="fas fa-broom"></i>';
                            break;
                        case 'outros':
                            $iconeRamo = '<i class="fas fa-box"></i>';
                            break;
                        default:
                            $iconeRamo = '<i class="fas fa-question-circle"></i>';
                            break;
                    }

                    echo "<tr>";
                    echo "<td>{$fornecedor->getNome()}</td>";
                    echo "<td>{$fornecedor->getEndereco()}</td>";
                    echo "<td>{$fornecedor->getTelefone()}</td>";
                    echo "<td>{$fornecedor->getWhatsapp()}</td>";
                    echo "<td>{$fornecedor->getEmail()}</td>";
                    echo "<td>{$iconeRamo} {$fornecedor->getRamo()}</td>";
                    echo "<td><a href='../editarFornecedores/editFornecedores.php?id={$fornecedor->getId()}' class='acao-editar'><i class='fas fa-edit'></i> Editar</a></td>";
                    echo "<td><a href='#' class='acao-deletar' onclick='confirmDelete({$fornecedor->getId()}, \"{$fornecedor->getNome()}\")'><i class='fas fa-trash'></i> Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum fornecedor encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
<script>
    function filterSuppliersBySelect() {
        const selectedRamo = document.getElementById('ramo').value.toLowerCase();
        const rows = document.querySelectorAll('#supplier-table-body tr');
        const searchInput = document.getElementById('search-input').value.toLowerCase();

        rows.forEach(row => {
            const supplierRamo = row.querySelector('td:nth-child(6)').textContent.toLowerCase(); // Ramo está na sexta coluna
            const supplierName = row.querySelector('td:nth-child(1)').textContent.toLowerCase(); // Nome está na primeira coluna

            // Exibe a linha se o ramo e o texto de busca coincidirem
            if (
                (selectedRamo === "" || supplierRamo.includes(selectedRamo)) &&
                (searchInput === "" || supplierName.startsWith(searchInput))
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function searchSuppliers() {
        filterSuppliersBySelect(); // Reutiliza a lógica do filtro para combinar busca e ramo
    }

    // Adiciona o evento de input ao campo de busca
    document.getElementById('search-input').addEventListener('input', searchSuppliers);

    function confirmDelete(fornecedorId, fornecedorNome) {
        Swal.fire({
            title: `Deseja realmente excluir o fornecedor "${fornecedorNome}"?`,
            text: "Digite 'DELETAR' para confirmar.",
            input: 'text',
            inputPlaceholder: 'Digite DELETAR',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (value !== 'DELETAR') {
                    return 'Você precisa digitar "DELETAR" para confirmar!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireciona para o script de exclusão
                window.location.href = `../deleteFornecedores/delFornecedores.php?id=${fornecedorId}`;
            }
        });
    }
</script>
</body>
</html>