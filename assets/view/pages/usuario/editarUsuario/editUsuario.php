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
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarUsuario/listarUsuario.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Editar Usuário</h1>
    <form action="" method="POST">
        <?php
            $usuarios = $controler->listarUsuarios();
            foreach ($usuarios as $usuario) {
                if($usuario->getId() == $_GET['id']){
                    echo ' <section>  
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="'.$usuario->getCpf().'" required>
                    </section>
                    <section>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="'.$usuario->getNome().'" required>
                    </section>
                    <section>
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" id="sobrenome" name="sobrenome" value="'.$usuario->getSobrenome().'" required>
                    </section>
                    <section>
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="'.$usuario->getDataNasc().'" required>
                    </section>
                    <section>
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="'.$usuario->getEndereco().'">
                    </section>
                    <section>
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" value="'.$usuario->getTelefone().'">
                    </section>
                    <section>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="'.$usuario->getEmail().'" required>
                    </section>
                    <section>
                    <label for="senha">Senha:</label>
                    <input type="text" id="senha" name="senha"  value="'.$usuario->getSenha().'" required>
                    </section>
                    <section>
                    <label for="tipo_usuario">Tipo de Usuário:</label>
                    <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="administrador"'; if($usuario->getTipoUsuario() == 'administrador') echo 'selected'; echo '>Administrador</option>
                    <option value="contador"'; if($usuario->getTipoUsuario() == 'contador') echo 'selected'; echo '>Adm Compras</option>
                    <option value="nutricionista"'; if($usuario->getTipoUsuario() == 'nutricionista') echo 'selected'; echo '>Nutricionista</option>
                    </select>
                    </section>';
                    if($usuario->getTipoUsuario() == 'nutricionista'){
                        
                        echo '<label for="CRN">CRN</label> <input type="text" name="crn" value="'.$usuario->getCrn().'">';
                    }
                    echo '<button type="submit">Salvar Alterações</button>';
                }
            }
        ?>
    </form>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['crn'])){
            $controler->editarUsuario($_GET['id'], $_POST['cpf'], $_POST['nome'], $_POST['sobrenome'], $_POST['data_nascimento'], $_POST['endereco'], $_POST['telefone'], $_POST['email'], $_POST['senha'], $_POST['tipo_usuario'],$_POST['crn']);
        }else{
            $crn = 'nulo';
            $controler->editarUsuario($_GET['id'], $_POST['cpf'], $_POST['nome'], $_POST['sobrenome'], $_POST['data_nascimento'], $_POST['endereco'], $_POST['telefone'], $_POST['email'], $_POST['senha'], $_POST['tipo_usuario'],$crn);
        }
        header('Location: ../listarUsuario/listarUsuario.php');
    }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>