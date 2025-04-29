<?php
require_once __DIR__ . "/../../../../controller/fornecedorController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
$controler = new ControladorFornecedor();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor</title>
    <link rel="stylesheet" href="../../styles/EditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-truck"></i> Editar Fornecedor</h1>
    <form action="" method="POST">
        <?php
        $fornecedores = $controler->verFornecedor();
        foreach ($fornecedores as $fornecedor) {
            if ($fornecedor->getId() == $_GET['id']) {
                echo '
                <section>
                    <label for="nome"><i class="fas fa-user"></i> Nome:</label>
                    <input type="text" id="nome" name="nome" value="'.$fornecedor->getNome().'" required>
                </section>
                <section>
                    <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="'.$fornecedor->getEndereco().'">
                </section>
                <section>
                    <label for="telefone"><i class="fas fa-phone"></i> Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="'.$fornecedor->getTelefone().'">
                </section>
                <section>
                    <label for="whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp:</label>
                    <input type="text" id="whatsapp" name="whatsapp" value="'.$fornecedor->getWhatsapp().'">
                </section>
                <section>
                    <label for="email"><i class="fas fa-envelope"></i> E-mail:</label>
                    <input type="email" id="email" name="email" value="'.$fornecedor->getEmail().'">
                </section>
                <section>
                    <label for="ramo"><i class="fas fa-briefcase"></i> Ramo de Atuação:</label>
                    <input type="text" id="ramo" name="ramo" value="'.$fornecedor->getRamo().'">
                </section>
                <button type="submit"><i class="fas fa-save"></i> Salvar Alterações</button>';
            }
        }
        ?>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controler->editarFornecedor($_GET['id'], $_POST['nome'], $_POST['endereco'], $_POST['telefone'], $_POST['whatsapp'], $_POST['email'], $_POST['ramo']);
        header('Location: ../listarFornecedores/listarFornecedores.php');
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