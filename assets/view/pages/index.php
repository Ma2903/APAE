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
                <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
                <a href="logout.php" class="logout-btn">Sair</a>
            </section>
        </section>
    </header>
    <section class="container">
        <section class="sidebar">
            <h2>Menu</h2>
            <section class="menu">
                <!-- <div class="menu-item">
                    <a href="user_management.php">Gerenciar Usuários</a>
                </div> -->
                <section class="menu-item">
                    <a href="produto/listarProduto/listarProduto.php">Gerenciar Produtos</a>
                </section>
                <section class="menu-item">
                    <a href="supplier_management.php">Gerenciar Fornecedores</a>
                </section>
                <section class="menu-item">
                    <a href="quotation_management.php">Gerenciar Cotações</a>
                </section>
                <section class="menu-item">
                    <a href="menu_management.php">Gerenciar Cardápios</a>
                </section>
            </section>
        </section>
        <section class="main-content">
            <h2>Bem-vindo ao SmartControl</h2>
            <p>Este é o sistema principal para gerenciar cotações e cardápios. Utilize o menu à esquerda para navegar pelas diferentes funcionalidades do sistema.</p>
            <img src="../assets/images/welcome_image.jpg" alt="Imagem de boas-vindas" style="max-width: 100%; height: auto;">
        </section>
    </section>
    <footer>
        <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
    </footer>
</body>
</html>