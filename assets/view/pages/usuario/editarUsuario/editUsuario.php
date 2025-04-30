<?php 
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
$controler = new ControladorUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../../styles/EditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarUsuario/listarUsuario.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-user-edit"></i> Editar Usuário</h1>
    <form action="" method="POST">
        <?php
        $usuarios = $controler->listarUsuarios();
        foreach ($usuarios as $usuario) {
            if ($usuario->getId() == $_GET['id']) {
                echo '
                <section>
                    <label for="cpf"><i class="fas fa-id-card"></i> CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="'.$usuario->getCpf().'" required>
                </section>
                <section>
                    <label for="nome"><i class="fas fa-user"></i> Nome:</label>
                    <input type="text" id="nome" name="nome" value="'.$usuario->getNome().'" required>
                </section>
                <section>
                    <label for="sobrenome"><i class="fas fa-user"></i> Sobrenome:</label>
                    <input type="text" id="sobrenome" name="sobrenome" value="'.$usuario->getSobrenome().'" required>
                </section>
                <section>
                    <label for="data_nascimento"><i class="fas fa-calendar-alt"></i> Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="'.$usuario->getDataNasc().'" required>
                </section>
                <section>
                    <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="'.$usuario->getEndereco().'" required>
                </section>
                <section>
                    <label for="telefone"><i class="fas fa-phone"></i> Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="'.$usuario->getTelefone().'" required>
                </section>
                <section>
                    <label for="email"><i class="fas fa-envelope"></i> E-mail:</label>
                    <input type="email" id="email" name="email" value="'.$usuario->getEmail().'" required>
                </section>
                <section style="display: none;">
                    <input type="password" id="senha" name="senha" value="'.$usuario->getSenha().'">
                </section>
                    <label for="tipo_usuario"><i class="fas fa-users"></i> Tipo de Usuário:</label>
                    <select id="tipo_usuario" name="tipo_usuario" required>
                        <option value="administrador"'; if ($usuario->getTipoUsuario() == 'administrador') echo 'selected'; echo '>Administrador</option>
                        <option value="contador"'; if ($usuario->getTipoUsuario() == 'contador') echo 'selected'; echo '>Adm Compras</option>
                        <option value="nutricionista"'; if ($usuario->getTipoUsuario() == 'nutricionista') echo 'selected'; echo '>Nutricionista</option>
                    </select>
                </section>';
                if ($usuario->getTipoUsuario() == 'nutricionista') {
                    echo '
                    <section>
                        <label for="crn"><i class="fas fa-id-badge"></i> CRN:</label>
                        <input type="text" id="crn" name="crn" value="'.$usuario->getCrn().'">
                    </section>';
                }
                echo '<button type="submit"><i class="fas fa-save"></i> Salvar Alterações</button>';
            }
        }
        ?>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $crn = isset($_POST['crn']) ? $_POST['crn'] : 'nulo';
        $controler->editarUsuario($_GET['id'], $_POST['cpf'], $_POST['nome'], $_POST['sobrenome'], $_POST['data_nascimento'], $_POST['endereco'], $_POST['telefone'], $_POST['email'],$_POST['senha'], $_POST['tipo_usuario'], $crn);
        header('Location: ../listarUsuario/listarUsuario.php');
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