<?php
require_once __DIR__ . '/../controller/produtoController.php';
$controlador = new ControladorProdutos();

$controlador->cadastrarProdutos();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Bom dia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <input type="text" name="nome" id="nome">
    <input type="text" name="preco" id="preco">
    <input type="text">
</body>
</html>