<?php
require_once __DIR__ . "/../../../../controller/produtoController.php";

$controler = new ControladorProdutos();

if (isset($_GET['id'])) {
    $controler->deletarProdutos($_GET['id']);
    header('Location: ../listarProduto/listarProduto.php');
    exit();
}
?>
