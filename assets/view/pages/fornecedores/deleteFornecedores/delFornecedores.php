<?php
    require_once __DIR__ . "/../../../../controller/fornecedorController.php";
    $controler = new ControladorFornecedor();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Fornecedor</title>
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
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
<a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h2>Excluir Fornecedor</h2>
    <form method="POST" action="">
    <h3>Tem certeza que deseja excluir o seguinte fornecedor?</h3>
        <?php
        $fornecedores = $controler->verFornecedor();
        foreach ($fornecedores as $fornecedor){
            if($fornecedor->getId() == $_GET['id']){
            echo '
            <label for="id"><strong>ID:</strong></label>
            <input type="text" id="id" name="id" value="' . htmlspecialchars($fornecedor->getId()) . '" readonly>
            <label for="nome"><strong>Nome:</strong></label>
            <input type="text" id="nome" name="nome" value="' . htmlspecialchars($fornecedor->getNome()) . '" readonly>
            <label for="endereco"><strong>Endereço:</strong></label>
            <input type="text" id="endereco" name="endereco" value="' . htmlspecialchars($fornecedor->getEndereco()) . '" readonly>
            <label for="telefone"><strong>Telefone:</strong></label>
            <input type="text" id="telefone" name="telefone" value="' . htmlspecialchars($fornecedor->getTelefone()) . '" readonly>
            <label for="whatsapp"><strong>WhatsApp:</strong></label>
            <input type="text" id="whatsapp" name="whatsapp" value="' . htmlspecialchars($fornecedor->getWhatsapp()) . '" readonly>
            <label for="email"><strong>E-mail:</strong></label>
            <input type="text" id="email" name="email" value="' . htmlspecialchars($fornecedor->getEmail()) . '" readonly>
            <label for="ramo"><strong>Ramo de Atuação:</strong></label>
            <input type="text" id="ramo" name="ramo" value="' . htmlspecialchars($fornecedor->getRamo()) . '" readonly>';
            }
        }
        ?>
        <button type="submit" name="confirmar">Confirmar Exclusão</button>
    </form>

    <?php
    if(isset($_POST['confirmar'])){
        $controler->deletarFornecedor($_GET['id']);
        header('Location: ../listarFornecedores/listarFornecedores.php');
    }
    
    ?>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>