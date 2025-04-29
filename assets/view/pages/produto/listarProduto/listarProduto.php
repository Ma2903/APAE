<?php
require_once __DIR__ . "/../../../../controller/produtoController.php";
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
require_once __DIR__ . "/../../../../model/utils.php"; 
session_start();

$controler = new ControladorProdutos();
$user = $_SESSION['user'];
$tipo_usuario = $user->getTipoUsuario();

if (!isset($user)) {
    header("Location: index.php");
    exit();
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
    <?php renderHeader(); ?>
    <main>
        <h1>  <i class="fas fa-box"></i> Listar Produtos</h1>
        <section class="search">
            <input 
                type="text" 
                id="search-input" 
                name="search" 
                placeholder="Pesquisar Produtos..." 
                onkeyup="searchProducts()" 
                aria-label="Pesquisar produtos"
            >
            <section class="add-product">
                <?php if ($podeGerenciarProdutos): ?>
                    <a href="../cadastroProduto/cadProduto.php" class="add-product-btn" aria-label="Cadastrar novo produto">
                    <i class="fas fa-box"></i> Cadastrar Novo Produto
                    </a>
                <?php endif; ?>
            </section>
        </section>
        <section class="filter">
            <label for="categoria" class="filter-label">Filtrar por Categoria:</label>
            <select id="categoria" name="categoria" onchange="filterProductsBySelect()" aria-label="Filtrar produtos por categoria">
                <option value="">Todas</option>
                <option value="Frutas">Frutas</option>
                <option value="Verduras">Verduras</option>
                <option value="Higiene Pessoal">Higiene Pessoal</option>
                <option value="Açougue">Açougue</option>
                <option value="Limpeza">Limpeza</option>
                <option value="Descartáveis">Descartáveis</option>
                <option value="Frios">Frios</option>
                <option value="Alimenticios">Alimenticios</option>
                <option value="Outros">Outros</option>
            </select>
        </section>
        <table aria-label="Tabela de produtos">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Data de Criação</th>
                    <?php if ($podeGerenciarProdutos): ?>
                        <th scope="col" colspan="2">Ações</th>
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
                        $iconeCategoria = '';
                        switch (strtolower($produto->getCategoria())) {
                            case 'frutas':
                                $iconeCategoria = '<i class="fas fa-apple-alt"></i>';
                                break;
                            case 'verduras':
                                $iconeCategoria = '<i class="fas fa-leaf"></i>';
                                break;
                            // Outros casos...
                        }

                        echo "<tr>";
                        echo "<td>{$produto->getNome()}</td>";
                        echo "<td>{$iconeCategoria} {$produto->getCategoria()}</td>";
                        echo "<td>{$dataCriacao}</td>";
                        if ($podeGerenciarProdutos) {
                            echo "<td><a href='#' class='acao-deletar' onclick='confirmDelete({$produto->getId()}, \"{$produto->getNome()}\")' aria-label='Deletar produto {$produto->getNome()}'><i class='fas fa-trash'></i> Deletar</a></td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php renderFooter(); ?>
    <script>
        function filterProductsBySelect() {
            const selectedCategory = document.getElementById('categoria').value.toLowerCase();
            const rows = document.querySelectorAll('#product-table-body tr');
            const searchInput = document.getElementById('search-input').value.toLowerCase();

            rows.forEach(row => {
                const productCategory = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Categoria está na segunda coluna
                const productName = row.querySelector('td:nth-child(1)').textContent.toLowerCase(); // Nome está na primeira coluna

                // Exibe a linha se a categoria e o texto de busca coincidirem
                if (
                    (selectedCategory === "" || productCategory.includes(selectedCategory)) &&
                    (searchInput === "" || productName.startsWith(searchInput)) // Verifica se o nome começa com o texto digitado
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function searchProducts() {
            filterProductsBySelect(); // Reutiliza a lógica do filtro para combinar busca e categoria
        }

        // Adiciona o evento de input ao campo de busca
        document.getElementById('search-input').addEventListener('input', searchProducts);

        function confirmDelete(produtoId, produtoNome) {
            Swal.fire({
                title: `Deseja realmente excluir o produto "${produtoNome}"?`,
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
                    window.location.href = `../deleteProduto/delProduto.php?id=${produtoId}`;
                }
            });
        }
    </script>
</body>
</html>