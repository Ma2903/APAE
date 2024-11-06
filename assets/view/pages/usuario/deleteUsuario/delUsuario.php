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
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="../../styles/DeleteStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarUsuario/listarUsuario.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Excluir Usuário</h1>
    <form method="POST" action="">
      <h3>Tem certeza que deseja excluir o seguinte usuário?</h3>
    <?php
      $usuarios = $controler->listarUsuarios();
      foreach($usuarios as $usuario){
        if($usuario->getId() == $_GET['id']){
          echo '
                <input type="hidden" id="usuario_id" name="usuario_id" value="'.$usuario->getId().'" readonly>
            <section>
              <label for="cpf"><strong>CPF:</strong></label>
              <input type="text" id="cpf" name="cpf" value="'.$usuario->getCpf().'" readonly>
            </section> 
            <section>
              <label for="nome"><strong>Nome:</strong></label>
              <input type="text" id="nome" name="nome" value="'.$usuario->getNome().'" readonly>
            </section>
            <section>
              <label for="sobrenome"><strong>Sobrenome:</strong></label>
              <input type="text" id="sobrenome" name="sobrenome" value="'.$usuario->getSobrenome().'" readonly>
            </section>
            <section>
              <label for="data_nascimento"><strong>Data de Nascimento:</strong></label>
              <input type="text" id="data_nascimento" name="data_nascimento" value="'.$usuario->getDataNasc().'" readonly>
            </section>
            <section>
              <label for="email"><strong>E-mail:</strong></label>
              <input type="text" id="email" name="email" value="'.$usuario->getEmail().'" readonly>
            </section>
            <section>
              <label for="tipo_usuario"><strong>Tipo de Usuário:</strong></label>
              <input type="text" id="tipo_usuario" name="tipo_usuario" value="'.$usuario->getTipoUsuario().'" readonly>
            </section>
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
<?php renderFooter(); ?>
</body>
</html>