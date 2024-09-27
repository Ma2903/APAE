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
        <div class="header-container">
            <div class="logo-container">
                <img src="../../../src/logo0.jpg" alt="Logo do SmartControl" class="logo">
                <h1 class="system-name">SmartControl</h1>
            </div>
            <div class="user-info">
                <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <div class="menu">
                <div class="menu-item">
                    <a href="user_management.php">Gerenciar Usuários</a>
                </div>
                <div class="menu-item">
                    <a href="product_management.php">Gerenciar Produtos</a>
                </div>
                <div class="menu-item">
                    <a href="supplier_management.php">Gerenciar Fornecedores</a>
                </div>
                <div class="menu-item">
                    <a href="quotation_management.php">Gerenciar Cotações</a>
                </div>
                <div class="menu-item">
                    <a href="menu_management.php">Gerenciar Cardápios</a>
                </div>
            </div>
        </div>
        <div class="main-content">
            <h2>Bem-vindo ao SmartControl</h2>
            <p>Este é o sistema principal para gerenciar cotações e cardápios. Utilize o menu à esquerda para navegar pelas diferentes funcionalidades do sistema.</p>
            <img src="../assets/images/welcome_image.jpg" alt="Imagem de boas-vindas" style="max-width: 100%; height: auto;">
        </div>
    </div>

    <footer>
        <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
    </footer>
</body>
</html>