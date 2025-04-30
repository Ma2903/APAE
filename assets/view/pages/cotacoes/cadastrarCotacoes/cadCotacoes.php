<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';
$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();

$cotas = $controladorCotacao->verCotas();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cotação</title>
    <link rel="stylesheet" href="../../styles/CadStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarCotacoes/listarCotacoes.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-file-invoice-dollar"></i> Cadastrar Cotação</h1>
    <form action="" method="post">
        <section>
            <label for="produto_id"><i class="fas fa-box"></i> Produto:</label>
            <select id="produto_id" name="produto_id" required>
                <?php
                foreach ($controladorProduto->verProdutos() as $produto) {
                    echo "<option value='{$produto->getId()}'>{$produto->getNome()}</option>";
                }
                ?>
            </select>
        </section>
        <section>
            <label for="fornecedor_id"><i class="fas fa-truck"></i> Fornecedor:</label>
            <select id="fornecedor_id" name="fornecedor_id" required>
                <?php
                foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                    echo "<option value='{$fornecedor->getId()}'>{$fornecedor->getNome()}</option>";
                }
                ?>
            </select>
        </section>
        <section>
            <label for="preco_unitario"><i class="fas fa-dollar-sign"></i> Preço Unitário:</label>
            <input type="number" step="0.01" id="preco_unitario" name="preco_unitario" required placeholder="Ex: 19.99 (Reais)">
        </section>
        <section>
            <label for="quantidade"><i class="fas fa-sort-numeric-up"></i> Quantidade:</label>
            <input type="number" step="0.01" id="quantidade" name="quantidade" required placeholder="Ex: 5 (Unidade)">
        </section>
        <section>
            <label for="rel_un_peso"><i class="fas fa-weight"></i> Relação Peso da Unidade:</label>
            <input type="number" step="0.01" id="rel_un_peso" name="rel_un_peso" required placeholder="Ex: 200 (gramas / unidade)">
        </section>
        <button type="submit"><i class="fas fa-save"></i> Cadastrar Cotação</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controladorCotacao->cadastrarCota($_POST['produto_id'], $_POST['fornecedor_id'], $_POST['preco_unitario'], $_POST['rel_un_peso'], $_POST['quantidade']);
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