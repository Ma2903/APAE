<?php
    require_once __DIR__ . "/../../../../controller/fornecedorController.php";
    $controler = new ControladorFornecedor();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor</title>
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
            <a href="../../index.php" class="home-btn">Home</a>
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
<a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h2>Editar Fornecedor</h2>
    <form action="" method="POST">
        <?php
        echo '<label for="nome">Id:</label>';
        echo '<input type="text" name="id" value="'.$_GET['id'].'" required readonly>';
            $fornecedores = $controler->verFornecedor();
            foreach($fornecedores as $fornecedor){
                if($fornecedor->getId() == $_GET['id']){

                echo '<label for="nome">Nome:</label>
                <input type="text" name="nome" value="'.$fornecedor->getNome().'" required>
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" value="'.$fornecedor->getEndereco().'">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" value="'.$fornecedor->getTelefone().'">
                <label for="whatsapp">WhatsApp:</label>
                <input type="text" name="whatsapp" value="'.$fornecedor->getWhatsapp().'">
                <label for="email">E-mail:</label>
                <input type="email" name="email" value="'.$fornecedor->getEmail().'">
                <label for="ramo_atuacao">Ramo de Atuação:</label>
                <input type="text" name="ramo_atuacao" value="'.$fornecedor->getRamo().'">';
                }
            }
            ?>
            <button type="submit">Salvar</button>; 
            <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $controler->editarFornecedor($_POST['id'], $_POST['nome'], $_POST['endereco'], $_POST['telefone'], $_POST['whatsapp'], $_POST['email'], $_POST['ramo_atuacao']);
                header('Location: ../listarFornecedores/listarFornecedores.php');
            }
            
            ?>
    </form>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>