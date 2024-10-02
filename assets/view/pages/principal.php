<?php
    require_once __DIR__ . "/../../controller/userController.php";
    session_start();
    
    $user = $_SESSION['user'];

    if(!isset($user)){
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartControl - Menu Principal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <section class="header-container">
            <section class="logo-container">
                <img src="../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
                <h1 class="system-name">SmartControl</h1>
            </section>
            <section class="user-info">
                <span><?php echo get_class($user) .'|'. $user->getNome()?></span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </section>
            <button class="menu-btn" onclick="toggleSidebar()">☰</button> <!-- Botão Menu -->  
        </section>
    </header>
    <main>
        <section class="container">
            <section class="sidebar">
                <h2>Menu</h2>
                <section class="menu">
                    <section class="menu-item">
                        <a href="usuario/listarUsuario/listarUsuario.php">Gerenciar Usuários</a>
                    </section>
                    <section class="menu-item">
                        <a href="produto/listarProduto/listarProduto.php">Gerenciar Produtos</a>
                    </section>
                    <section class="menu-item">
                        <a href="fornecedores/listarFornecedores/listarFornecedores.php">Gerenciar Fornecedores</a>
                    </section>
                    <section class="menu-item">
                        <a href="cotacoes/listarCotacoes/listarCotacoes.php">Gerenciar Cotações</a>
                    </section>
                    <section class="menu-item">
                        <a href="cardapio/listarCardapio/listarCardapio.php">Gerenciar Cardápios</a>
                    </section>
                </section>
            </section>
            <section class="welcome-banner">  
            <h1>Bem-vindo ao SmartControl!</h1>  
            <p>Gerencie suas cotações e fornecedores de maneira simples e eficiente.</p>  
            <section class="description">
                <p>Com o SmartControl, você pode monitorar processos, otimizar custos e ter uma visão clara de suas operações. Acelere sua gestão e melhore seus resultados!</p>  
            </section>  
            <div class="icon-container">  
                <span class="icon">📊</span>  
                <span class="icon">✉️</span>  
                <span class="icon">🔒</span>  
                <span class="icon">⚙️</span>  
            </div>  
            <a class="btn-primary" onclick="toggleSidebar()">Comece Agora</a>  
        </section>
    </main>
    <footer>
        <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
    </footer>
    <script>  
        function toggleSidebar() {  
            const sidebar = document.querySelector('.sidebar');  
            sidebar.classList.toggle('active');  
        }  
</script>
</body>
</html>