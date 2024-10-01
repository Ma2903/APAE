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
            <a href="../../index.php" class="home-btn">Home</a>
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
<a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h2>Excluir Fornecedor</h2>
    
    <p>Tem certeza que deseja excluir o seguinte fornecedor?</p>
    
    <ul>
        <?php
        
        $fornecedores = $controler->verFornecedor();
        foreach ($fornecedores as $fornecedor){
            if($fornecedor->getId() == $_GET['id']){
                echo '
            <li><strong>ID:</strong> ' . htmlspecialchars($fornecedor->getId()) . '</li>
            <li><strong>Nome:</strong> ' . htmlspecialchars($fornecedor->getNome()) . '</li>
            <li><strong>Endereço:</strong> ' . htmlspecialchars($fornecedor->getEndereco()) . '</li>
            <li><strong>Telefone:</strong> ' . htmlspecialchars($fornecedor->getTelefone()) . '</li>
            <li><strong>WhatsApp:</strong> ' . htmlspecialchars($fornecedor->getWhatsapp()) . '</li>
            <li><strong>E-mail:</strong> ' . htmlspecialchars($fornecedor->getEmail()) . '</li>
            <li><strong>Ramo de Atuação:</strong> ' . htmlspecialchars($fornecedor->getRamo()) . '</li>';
            }
        }
        
        ?>

    </ul>
    
    <form method="POST" action="">
        <button type="submit" name="confirmar">Confirmar Exclusão</button>
        <button type="submit" name="cancelar">Cancelar</button>
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