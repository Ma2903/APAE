<?php
session_start();
require_once __DIR__ . '/../../../../controller/cardapioController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/userController.php';
require_once __DIR__ . '/../../../../controller/pageController.php';

$controladorCardapio = new CardapioController();
$controladorProduto = new ControladorProdutos();
$controladorCotacao = new ControladorCotacao();
$controladorNutricionista = new ControladorUsuarios();

$controladorCardapio->criarcardapio($_POST['nutricionista_id'], $_POST['dataC'], $_POST['periodo'], $_POST['descricao']);
$cardapios = $controladorCardapio->listarcardapios();

$cardMaior = 0;
foreach($cardapios as $cardapio){
    if($cardapio->getId() > $cardMaior){
        $cardMaior = $cardapio->getId();
    }
}

var_dump("AKI FILHA DA PUTA" . $cardMaior);

$produtos = json_decode($_POST['produtos']);

foreach ($produtos as $produto) {
    $controladorCardapio->criarCadProd($cardMaior, $produto->produtoId, $produto->quantidade,$produto->custo);
}

// header('Location: ../listarCardapio/listarCardapio.php');

?>