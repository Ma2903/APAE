<?php
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../global.php";
$controler = new ControladorUsuarios();


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
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
    <h1>Excluir Usuário</h1>
    <h3>Tem certeza que deseja excluir o seguinte usuário?</h3>
    <form method="POST" action="">
    <?php
      $usuarios = $controler->listarUsuarios();
      foreach($usuarios as $usuario){
        if($usuario->getId() == $_GET['id']){
          echo '
          <label for="usuario_id"><strong>ID:</strong></label>
            <input type="text" id="usuario_id" name="usuario_id" value="'.$usuario->getId().'" readonly>
          <label for="cpf"><strong>CPF:</strong></label>
            <input type="text" id="cpf" name="cpf" value="'.$usuario->getCpf().'" readonly>
          <label for="nome"><strong>Nome:</strong></label>
            <input type="text" id="nome" name="nome" value="'.$usuario->getNome().'" readonly>
          <label for="sobrenome"><strong>Sobrenome:</strong></label>
            <input type="text" id="sobrenome" name="sobrenome" value="'.$usuario->getSobrenome().'" readonly>
          <label for="data_nascimento"><strong>Data de Nascimento:</strong></label>
            <input type="text" id="data_nascimento" name="data_nascimento" value="'.$usuario->getDataNasc().'" readonly>
          <label for="email"><strong>E-mail:</strong></label>
            <input type="text" id="email" name="email" value="'.$usuario->getEmail().'" readonly>
          <label for="tipo_usuario"><strong>Tipo de Usuário:</strong></label>
            <input type="text" id="tipo_usuario" name="tipo_usuario" value="'.$usuario->getTipoUsuario().'" readonly>
          <button type="submit" name="confirmar">Confirmar Exclusão</button>
          ';
        }
    }
    ?>
</form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $controler->deleteUsuario($_POST['usuario_id']);
    }
    
    ?>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>