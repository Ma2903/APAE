<?php
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
require_once __DIR__ . "/../../global.php";
$controler = new ControladorUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="../../styles/CadStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <a href="../listarUsuario/listarUsuario.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-user-plus"></i> Cadastrar Usuário</h1>
    <form action="" method="post">
        <section>
            <label for="cpf"><i class="fas fa-id-card"></i> CPF:</label>
            <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
        </section>
        <section>
            <label for="nome"><i class="fas fa-user"></i> Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>
        </section>
        <section>
            <label for="sobrenome"><i class="fas fa-user"></i> Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required>
        </section>
        <section>
            <label for="data_nascimento"><i class="fas fa-calendar-alt"></i> Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
        </section>
        <section>
            <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço:</label>
            <input type="text" id="endereco" name="endereco" placeholder="Endereço">
        </section>
        <section>
            <label for="telefone"><i class="fas fa-phone"></i> Telefone:</label>
            <input type="tel" id="telefone" name="telefone" placeholder="Telefone">
        </section>
        <section>
            <label for="email"><i class="fas fa-envelope"></i> E-mail:</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
        </section>
        <section>
            <label for="senha"><i class="fas fa-lock"></i> Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="******" required>
        </section>
        <section>
            <label for="tipo_usuario"><i class="fas fa-users"></i> Tipo de Usuário:</label>
            <select id="tipo_usuario" name="tipo_usuario" required>
                <option value="administrador">Administrador</option>
                <option value="contador">Adm Compras</option>
                <option value="nutricionista">Nutricionista</option>
            </select>
        </section>
        <section>
            <label for="crn"><i class="fas fa-id-badge"></i> CRN (Somente Nutricionistas):</label>
            <input type="text" id="crn" name="crn" placeholder="CRN">
        </section>
        <button type="submit"><i class="fas fa-save"></i> Cadastrar Usuário</button>
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controler->cadastrarUsuarios($_POST['nome'], $_POST['cpf'], $_POST['sobrenome'], $_POST['data_nascimento'], $_POST['endereco'], $_POST['telefone'], $_POST['email'], $_POST['tipo_usuario'], $_POST['senha'], $_POST['crn']);
        }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>