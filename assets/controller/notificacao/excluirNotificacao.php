<?php
require_once __DIR__ . '/../../model/pdo/DataBase.php';
require_once __DIR__ . '/../notificacaoController.php';

if (isset($_GET['id'])) {
    $notificacaoId = intval($_GET['id']);
    $notificacaoController = new ControladorNotificacao();

    if ($notificacaoController->deletarNotificacao($notificacaoId)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID da notificação não fornecido.']);
}
?>