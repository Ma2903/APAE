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
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="../../styles/CadStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-truck"></i> Cadastrar Fornecedor</h1>
    <form action="" method="POST">
        <section>
            <label for="nome"><i class="fas fa-user"></i> Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome do Fornecedor" required>
        </section>
        <section>
            <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço:</label>
            <input type="text" id="endereco" name="endereco" placeholder="Endereço">
        </section>
        <section>
            <label for="telefone"><i class="fas fa-phone"></i> Telefone:</label>
            <input type="text" id="telefone" name="telefone" placeholder="Telefone">
        </section>
        <section>
            <label for="whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp:</label>
            <input type="text" id="whatsapp" name="whatsapp" placeholder="WhatsApp">
        </section>
        <section>
            <label for="email"><i class="fas fa-envelope"></i> E-mail:</label>
            <input type="email" id="email" name="email" placeholder="E-mail">
        </section>
        <section>
            <label for="ramo_atuacao"><i class="fas fa-briefcase"></i> Ramo de Atuação:</label>
            <select id="ramo_atuacao" name="ramo_atuacao" required>
                <option value="Frutas">Frutas</option>
                <option value="Verduras">Verduras</option>
                <option value="Higiene Pessoal">Higiene Pessoal</option>
                <option value="Açougue">Açougue</option>
                <option value="Limpeza">Limpeza</option>
                <option value="Descartáveis">Descartáveis</option>
                <option value="Frios">Frios</option>
                <option value="Alimenticios">Alimentícios</option>
                <option value="Outros">Outros</option>
            </select>
        </section>
        <button type="submit"><i class="fas fa-save"></i> Cadastrar Fornecedor</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $whatsapp = $_POST['whatsapp'];
            $email = $_POST['email'];
            $ramo_atuacao = $_POST['ramo_atuacao'];
            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao = date("Y-m-d H:i:s");

            if (!empty($nome) && !empty($endereco) && !empty($telefone) && !empty($whatsapp) && !empty($email) && !empty($ramo_atuacao)) {
                $controler->cadastrarFornecedor($nome, $endereco, $telefone, $whatsapp, $email, $ramo_atuacao, $data_criacao);
                header("Location: ../listarFornecedores/listarFornecedores.php");
            }
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