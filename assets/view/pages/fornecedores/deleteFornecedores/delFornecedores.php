<?php
require_once __DIR__ . "/../../../../controller/fornecedorController.php";

$controler = new ControladorFornecedor();

if (isset($_GET['id'])) {
    $controler->deletarFornecedor($_GET['id']);
    header('Location: ../listarFornecedores/listarFornecedores.php');
    exit();
}
?>