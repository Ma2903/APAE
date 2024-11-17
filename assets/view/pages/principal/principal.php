<?php
    require_once __DIR__ . "/../../../controller/userController.php";
    require_once __DIR__ . "/../../../controller/pageController.php";
    require_once __DIR__ . "/../../../controller/notificacaoController.php";
    require_once __DIR__ . "/../../../model/utils.php";
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: ../login/");
        exit();
    }

    $notificacaoController = new ControladorNotificacao();
    
    $user = $_SESSION['user'];

    $notificacoes = $notificacaoController->verNotificacaoPorId($user->getId());

    // echo "<pre>";
    // var_dump($notificacoes);
    // echo "</pre>";

    if(sizeof($notificacoes) - 1 == 0) {
        echo "<script>setTimeout(() => alert('". $notificacoes[0]->getMensagem() . "'),1000);</script>";
    }else{
        echo "<script>setTimeout(() => alert('". $notificacoes[sizeof($notificacoes) - 1]->getMensagem() . "'),1000);</script>";
    }


    $tipo_usuario = $user->getTipoUsuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartControl - Menu Principal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <section class="header-container">
            <section class="logo-container">
                <img src="../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
                <h1 class="system-name">SmartControl</h1>
            </section>
            <section class="user-info">
                <span class="greeting">Olá, <span class="user-role"><?php echo get_class($user); ?></span> <span class="user-name"><?php echo $user->getNome(); ?></span></span>
            </section>
            <section class="user-buttons">
                <span class="notification-box">
                    <section class="notification-trigger">
                        <i class='bx bxs-bell'></i>
                        <span class="notification-counter"><?php echo sizeof($notificacoes)?></span>
                    </section>
                    <section class="notification-dropdown">
                        <?php
                        foreach($notificacoes as $notificacao) {
                            echo "<ul>
                                <li class='notification-item'>
                                    <span class='notification-message'>". $notificacao->getMensagem() ."</span>
                                </li>
                            </ul>";
                        }
                        ?>
                    </section>
                </span>
                <button class="menu-btn" onclick="toggleSidebar()">☰</button>
            </section>
        </section>
        <a href="../logout.php" class="logout-btn">
            Sair <i class="fas fa-door-open"></i>
        </a>
    </header>
    <main>
        <section class="container">
            <nav class="sidebar">
                <h2>Menu</h2>
                <section class="menu">
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_usuarios')): ?>
                    <section class="menu-item">
                        <a href="../usuario/listarUsuario/listarUsuario.php">Ver Usuários</a>
                    </section>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_produtos') || verificarPermissao($tipo_usuario, 'ver_produtos')): ?>
                    <section class="menu-item">
                        <a href="../produto/listarProduto/listarProduto.php">Ver Produtos</a>
                    </section>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_fornecedores')): ?>
                    <section class="menu-item">
                        <a href="../fornecedores/listarFornecedores/listarFornecedores.php">Ver Fornecedores</a>
                    </section>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_cotacoes') || verificarPermissao($tipo_usuario, 'ver_cotacoes')): ?>
                    <section class="menu-item">
                        <a href="../cotacoes/listarCotacoes/listarCotacoes.php">Ver Cotações</a>
                    </section>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_cardapios') || verificarPermissao($tipo_usuario, 'ver_cardapios')): ?>
                    <section class="menu-item">
                        <a href="../cardapio/listarCardapio/listarCardapio.php">Ver Cardápios</a>
                    </section>
                    <?php endif; ?>
                </section>
            </nav>
            <section class="welcome-banner" style="background-image: url('../../../../src/banner-background.jpg');">
                <section class="banner-overlay">
                    <h1>Bem-vindo ao SmartControl!</h1>
                    <p>Gerencie suas cotações e fornecedores de maneira simples e eficiente.</p>
                    <section class="description">
                        <p>Com o SmartControl, você pode monitorar processos, otimizar custos e ter uma visão clara de suas operações. Acelere sua gestão e melhore seus resultados!</p>
                    </section>
                    <a class="btn-primary" onclick="toggleSidebar()">Comece Agora</a>
                </section>
            </section>
    </main>
    <?php renderFooter(); ?>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
            sidebar.classList.toggle('inactive');
        }
        document.querySelector(".notification-trigger").addEventListener("click", () => {
            if(!document.querySelector(".notification-box").classList.contains("active")) {
                setTimeout(() => {
                    document.querySelector(".notification-dropdown").classList.toggle("active");
                }, 200);
                document.querySelector(".notification-box").classList.toggle("active");
            }else{
                setTimeout(() => {
                    document.querySelector(".notification-box").classList.toggle("active");
                }, 200);
                document.querySelector(".notification-dropdown").classList.toggle("active");
            }
        });
    </script>
</body>
</html>