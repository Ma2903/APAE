<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cotação</title>
    <link rel="stylesheet" href="../../styles/EditStyle.css"> <!-- Caminho ajustado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php renderHeader(); ?>
    <main>
    <a href="../listarCotacoes/listarCotacoes.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-edit"></i> Editar Cotação</h1> <!-- Ícone adicionado -->
    <form action="" method="post">
        <?php
        $cotacoes = $controladorCotacao->verCotas();
        foreach ($cotacoes as $cotacao) {
            if ($cotacao->getId() == $_GET['id']) {
                echo '
                <section>
                    <label for="produto_id"><i class="fas fa-box"></i> Produto:</label>
                    <select id="produto_id" name="produto_id" required>';
                $produtos = $controladorProduto->verProdutos();
                foreach ($produtos as $produto) {
                    echo '<option value="' . $produto->getId() . '"';
                    if ($produto->getId() == $cotacao->getProdutoId()) {
                        echo ' selected';
                    }
                    echo '>' . $produto->getNome() . '</option>';
                }
                echo '</select>
                </section>
                <section>
                    <label for="fornecedor_id"><i class="fas fa-truck"></i> Fornecedor:</label>
                    <select id="fornecedor_id" name="fornecedor_id" required>';
                $fornecedores = $controladorFornecedor->verFornecedor();
                foreach ($fornecedores as $fornecedor) {
                    echo '<option value="' . $fornecedor->getId() . '"';
                    if ($fornecedor->getId() == $cotacao->getFornecedorId()) {
                        echo ' selected';
                    }
                    echo '>' . $fornecedor->getNome() . '</option>';
                }
                echo '</select>
                </section>
                <section>
                    <label for="preco_unitario"><i class="fas fa-dollar-sign"></i> Preço Unitário:</label>
                    <input type="number" step="0.01" id="preco_unitario" name="preco_unitario" required value="' . $cotacao->getPrecoUnitario() . '">
                </section>
                <section>
                    <label for="quantidade"><i class="fas fa-sort-numeric-up"></i> Quantidade:</label>
                    <input type="number" step="0.01" id="quantidade" name="quantidade" required value="' . $cotacao->getQuantidade() . '">
                </section>
                <section>
                    <label for="rel_un_peso"><i class="fas fa-weight"></i> Relação Peso da Unidade:</label>
                    <input type="number" step="0.01" id="rel_un_peso" name="rel_un_peso" required value="' . $cotacao->getRelUnPeso() . '">
                </section>
                <section>
                    <label for="data_cotacao"><i class="fas fa-calendar-alt"></i> Data da Cotação:</label>
                    <input type="date" id="data_cotacao" name="data_cotacao" required value="' . $cotacao->getDataCotacao() . '">
                </section>
                <button type="submit"><i class="fas fa-save"></i> Salvar Alterações</button>';
            }
        }
        ?>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controladorCotacao->editarCota(
            $_GET['id'],
            $_POST['produto_id'],
            $_POST['fornecedor_id'],
            $_POST['preco_unitario'],
            $_POST['rel_un_peso'],
            $_POST['quantidade'],
            $_POST['data_cotacao']
        );
        header('Location: ../listarCotacoes/listarCotacoes.php');
    }
    ?>
</main>
    <?php renderFooter(); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const logoutButton = document.querySelector('a[href="../../logout.php"]'); // Caminho ajustado
        if (logoutButton) {
            logoutButton.addEventListener('click', (event) => {
                event.preventDefault();
                Swal.fire({
                    title: 'Deseja realmente sair?',
                    text: "Você será desconectado do sistema.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, sair',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = logoutButton.href;
                    }
                });
            });
        }
    });
</script>
</body>
</html>