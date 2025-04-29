<?php
require_once __DIR__ . "/../../../../controller/produtoController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
$controler = new ControladorProdutos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../../styles/EditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
<?php renderHeader(); ?>
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
<main>
    <a href="../listarProduto/listarProduto.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-box"></i> Editar Produto</h1>
    <form action="" method="POST">
        <?php
        $produtos = $controler->verProdutos();
        foreach ($produtos as $produto) {
            if ($produto->getId() == $_GET['id']) {
                echo '
                <section>
                    <label for="nome"><i class="fas fa-tag"></i> Nome do Produto:</label>
                    <input type="text" id="nome" name="nome" value="'.$produto->getNome().'" required>
                </section>
                <section>
                    <label for="categoria"><i class="fas fa-list"></i> Categoria:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="Frutas"'; if ($produto->getCategoria() == "Frutas") echo ' selected'; echo '>Frutas</option>
                        <option value="Verduras"'; if ($produto->getCategoria() == "Verduras") echo ' selected'; echo '>Verduras</option>
                        <option value="Higiene Pessoal"'; if ($produto->getCategoria() == "Higiene Pessoal") echo ' selected'; echo '>Higiene Pessoal</option>
                        <option value="Açougue"'; if ($produto->getCategoria() == "Açougue") echo ' selected'; echo '>Açougue</option>
                        <option value="Limpeza"'; if ($produto->getCategoria() == "Limpeza") echo ' selected'; echo '>Limpeza</option>
                        <option value="Descartáveis"'; if ($produto->getCategoria() == "Descartáveis") echo ' selected'; echo '>Descartáveis</option>
                        <option value="Frios"'; if ($produto->getCategoria() == "Frios") echo ' selected'; echo '>Frios</option>
                        <option value="Alimenticios"'; if ($produto->getCategoria() == "Alimenticios") echo ' selected'; echo '>Alimentícios</option>
                        <option value="Outros"'; if ($produto->getCategoria() == "Outros") echo ' selected'; echo '>Outros</option>
                    </select>
                </section>
                <section>
                    <label for="un"><i class="fas fa-balance-scale"></i> Unidade de Medida:</label>
                    <select id="un" name="un" required>
                        <option value="CX"'; if ($produto->getUnidade() == "CX") echo ' selected'; echo '>Caixa (CX)</option>
                        <option value="UN"'; if ($produto->getUnidade() == "UN") echo ' selected'; echo '>Unidade (UN)</option>
                        <option value="KG"'; if ($produto->getUnidade() == "KG") echo ' selected'; echo '>Quilograma (KG)</option>
                        <option value="MC"'; if ($produto->getUnidade() == "MC") echo ' selected'; echo '>Metro Cúbico (MC)</option>
                        <option value="SC"'; if ($produto->getUnidade() == "SC") echo ' selected'; echo '>Saco (SC)</option>
                        <option value="BDJ"'; if ($produto->getUnidade() == "BDJ") echo ' selected'; echo '>Balde (BDJ)</option>
                        <option value="CBÇ"'; if ($produto->getUnidade() == "CBÇ") echo ' selected'; echo '>Cabeça (CBÇ)</option>
                    </select>
                </section>
                <button type="submit"><i class="fas fa-save"></i> Salvar Alterações</button>';
            }
        }
        ?>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controler->editarProduto($_GET['id'], $_POST['nome'], $_POST['categoria'], $_POST['un']);
        header('Location: ../listarProduto/listarProduto.php');
    }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>