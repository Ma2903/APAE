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
$notificacaoController->verificarNotificacoes($_SESSION['user']);
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
    <header class="header-container">
        <section class="logo-container">
            <img src="../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </section>
        <section class="user-info">
            <span class="greeting">
                Olá, <span class="user-role">
                <?php 
                if ($user->getTipoUsuario() == 'contador') {
                    echo 'Administrador de Compras';
                } else {
                    echo $user->getTipoUsuario();
                }
                ?>
                </span> 
                <span class="user-name"><?php echo $user->getNome(); ?></span>
            </span>
        </section>
        <div class="right-div">
            <section class="notification-container">
                <span class="notification-btn" aria-label="Notificações">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">
                        <?php echo count($notificacaoController->verNotificacaoPorId($user->getId())); ?>
                    </span>
                </span>
            </section>
            <a href="../logout.php" class="logout-btn" aria-label="Sair do sistema">
                Sair <i class="fas fa-door-open"></i>
            </a>
        </div>
    </header>
    <main>
        <section class="dashboard">
            <nav class="sidebar" role="navigation" aria-label="Menu principal">
                <h2 class="sidebar-title">Menu</h2>
                <ul class="menu">
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_usuarios')): ?>
                        <li>
                            <a href="../usuario/listarUsuario/listarUsuario.php" aria-label="Gerenciar usuários">
                                <i class="fas fa-users"></i> Usuários
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_produtos') || verificarPermissao($tipo_usuario, 'ver_produtos')): ?>
                        <li>
                            <a href="../produto/listarProduto/listarProduto.php" aria-label="Gerenciar produtos">
                                <i class="fas fa-box"></i> Produtos
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_fornecedores')): ?>
                        <li>
                            <a href="../fornecedores/listarFornecedores/listarFornecedores.php" aria-label="Gerenciar fornecedores">
                                <i class="fas fa-truck"></i> Fornecedores
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_cotacoes') || verificarPermissao($tipo_usuario, 'ver_cotacoes')): ?>
                        <li>
                            <a href="../cotacoes/listarCotacoes/listarCotacoes.php" aria-label="Gerenciar cotações">
                                <i class="fas fa-file-invoice-dollar"></i> Cotações
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (verificarPermissao($tipo_usuario, 'gerenciar_cardapios') || verificarPermissao($tipo_usuario, 'ver_cardapios')): ?>
                        <li>
                            <a href="../cardapio/listarCardapio/listarCardapio.php" aria-label="Gerenciar cardápios">
                                <i class="fas fa-utensils"></i> Cardápios
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <section class="content">
                <h1><i class="fas fa-home"></i> Bem-vindo ao SmartControl!</h1>
                <p>Gerencie suas cotações e fornecedores de maneira simples e eficiente.</p>
                <p>Com o SmartControl, você pode monitorar processos, otimizar custos e ter uma visão clara de suas operações.</p>
                <a class="btn-primary" href="./principal.php" aria-label="Comece agora">
                    Comece Agora
                </a>
                <div class="content-icons">
                    <i class="fas fa-chart-line" aria-hidden="true"></i>
                    <i class="fas fa-cogs" aria-hidden="true"></i>
                    <i class="fas fa-users" aria-hidden="true"></i>
                    <i class="fas fa-file-invoice-dollar" aria-hidden="true"></i>
                </div>
            </section>
        </section>
    </main>
    <?php
    $notificacoes = $notificacaoController->verNotificacaoPorId($user->getId());

    // Converte as notificações para arrays associativos
    $notificacoesArray = array_map(function($notificacao) {
        return $notificacao->toArray();
    }, $notificacoes);
    ?>
    <script>
        const notifications = <?php echo json_encode($notificacoesArray); ?>;
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoutButton = document.querySelector('a[href="../logout.php"]'); // Caminho ajustado
            if (logoutButton) {
                logoutButton.addEventListener('click', (event) => {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Deseja realmente sair?',
                        text: "Você será desconectado do sistema.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sim, sair',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = logoutButton.href;
                        }
                    });
                });
            }
        });
        function showNotification(text){
            Swal.fire({
                title: 'Deseja realmente sair?',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, sair',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutButton.href;
                }
            });
        }
        document.addEventListener('DOMContentLoaded', () => {
            const notificationButton = document.querySelector('.notification-btn'); // Botão do sininho

            // Função para formatar a data no formato brasileiro
            function formatarDataBrasileira(data) {
                const dataObj = new Date(data);
                const dia = String(dataObj.getDate()).padStart(2, '0');
                const mes = String(dataObj.getMonth() + 1).padStart(2, '0'); // Mês começa do 0
                const ano = dataObj.getFullYear();
                return `${dia}/${mes}/${ano}`;
            }

            if (notificationButton) {
                notificationButton.addEventListener('click', () => {
                    if (notifications.length > 0) {
                        let notificationList = '<ul style="text-align: left; list-style: none; padding: 0;">';
                        notifications.forEach(notification => {
                            const dataFormatada = formatarDataBrasileira(notification.dt_notification);
                            notificationList += `
                                <li style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9;">
                                    <strong style="color: #333;">Mensagem:</strong> ${notification.mensagem}<br>
                                    <small style="color: #666;"><strong>Data:</strong> ${dataFormatada}</small>
                                    <button class="delete-notification-btn" data-id="${notification.id}" style="margin-top: 10px; padding: 5px 10px; background-color: #ff4d4d; color: white; border: none; border-radius: 3px; cursor: pointer;">
                                        Excluir
                                    </button>
                                </li>`;
                        });
                        notificationList += '</ul>';

                        Swal.fire({
                            title: '<h3 style="color: #333;">Suas Notificações</h3>',
                            html: notificationList,
                            icon: 'info',
                            confirmButtonText: 'Fechar',
                            didRender: () => {
                                document.querySelectorAll('.delete-notification-btn').forEach(button => {
                                    button.addEventListener('click', (event) => {
                                        const notificationId = event.target.getAttribute('data-id');
                                        excluirNotificacao(notificationId);
                                    });
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Sem notificações',
                            text: 'Você não possui notificações no momento.',
                            icon: 'info',
                            confirmButtonText: 'Fechar'
                        });
                    }
                });
            }

            // Função para excluir notificação
            function excluirNotificacao(notificationId) {
                fetch(`../../../controller/notificacao/excluirNotificacao.php?id=${notificationId}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Resposta do servidor:', data); // Log para depuração
                    if (data.success) {
                        Swal.fire({
                            title: 'Notificação excluída!',
                            text: 'A notificação foi removida com sucesso.',
                            icon: 'success',
                            confirmButtonText: 'Fechar'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Não foi possível excluir a notificação.',
                            icon: 'error',
                            confirmButtonText: 'Fechar'
                        });
                    }
                })
                .catch(error => {
                    console.error('Erro ao excluir notificação:', error); // Log para erros
                });
            }
        });
    </script>
    <?php renderFooter(); ?>
</body>
</html>