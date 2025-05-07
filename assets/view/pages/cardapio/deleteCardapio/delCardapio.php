<?php
session_start();
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorProduto = new ControladorProdutos();
$controladorNutricionista = new ControladorUsuarios();

if (isset($_GET['id'])) {
    $cardapioID = $_GET['id'];
    $controladorCardapio->excluirCardapio($cardapioID);
    header('Location: ../listarCardapio/listarCardapio.php');
    exit();
} else {
    header('Location: ../listarCardapio/listarCardapio.php?error=CardapioNaoEncontrado');
    exit();
}
?>