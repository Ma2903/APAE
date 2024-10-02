<?php 
    require_once __DIR__ . "/../../../../controller/userController.php";
    $controler = new ControladorUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <section class="header-container">
        <section class="logo-container">
            <img src="../../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </section>
        <section class="user-info">
            <a href="../../principal.php" class="home-btn">Home</a>
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
    <a href="../listarUsuario/listarUsuario.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Editar Usuário</h1>
    <form action="" method="POST">
        <?php
            $usuarios = $controler->listarUsuarios();
            foreach ($usuarios as $usuario) {
                if($usuario->getId() == $_GET['id']){
                    echo '  <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="'.$usuario->getCpf().'" required>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="'.$usuario->getNome().'" required>
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" id="sobrenome" name="sobrenome" value="'.$usuario->getSobrenome().'" required>
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="'.$usuario->getDataNasc().'" required>
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="'.$usuario->getEndereco().'">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" value="'.$usuario->getTelefone().'">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="'.$usuario->getEmail().'" required>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="******" required>
                    <label for="tipo_usuario">Tipo de Usuário:</label>
                    <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="administrador"'; if($usuario->getTipoUsuario() == 'administrador') echo 'selected'; echo '>Administrador</option>
                    <option value="funcionario"'; if($usuario->getTipoUsuario() == 'funcionario') echo 'selected'; echo '>Funcionário</option>
                    <option value="nutricionista"'; if($usuario->getTipoUsuario() == 'nutricionista') echo 'selected'; echo '>Nutricionista</option>
                    </select>';
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
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>