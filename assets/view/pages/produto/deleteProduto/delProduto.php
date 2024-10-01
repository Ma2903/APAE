<?php
    require_once __DIR__ . "/../../../../controller/produtoController.php";
    $controler = new ControladorProdutos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
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
    <a href="../listarProduto/listarProduto.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Excluir Produto</h1>
    
    <p>Tem certeza que deseja excluir o seguinte produto?</p>
    
    <ul>
        <li>
        <?php 
            $produtos = $controler->verProdutos();
            foreach ($produtos as $produto){
                if($produto->getId() == $_GET['id']){
                    echo "Nome: " . $produto->getNome() . "<br>";
                    echo "Preço: " . $produto->getUn() . "<br>";
                    echo "Descrição: " . $produto->getCategoria() . "<br>";
                }
            }
        ?>
        </li>
    </ul>
    
    <form method="POST" action="">
        <input type="hidden" name="produto_id">
        <button type="submit" name="confirmar">Confirmar Exclusão</button>
        <button type="submit" name="cancelar">Cancelar</button>
    </form>
    <?php
    if(isset($_POST['confirmar'])){
        $controler->deletarProdutos($_GET['id']);
        header('Location: ../listarProduto/listarProduto.php');
    }
    
    ?>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>
