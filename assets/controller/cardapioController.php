<?php
require_once __DIR__ . "/../model/Cardapio.php";

class CardapioController {
    private $cardapio;

    public function __construct() {
        $this->cardapio = new Cardapio();
    }

    public function criarCardapio($nutricionista, $dataC, $periodo, $descricao) {
        return $this->cardapio->create($nutricionista, $dataC, $periodo, $descricao);
    }

    public function listarCardapios() {
        return $this->cardapio->read();
    }

    public function obterCardapio($id) {
        return $this->cardapio->read($id);
    }

    public function atualizarCardapio($id, $nutricionista, $dataC, $periodo, $descricao) {
        return $this->cardapio->update($id, $nutricionista, $dataC, $periodo, $descricao);
    }

    public function excluirCardapio($id) {
        return $this->cardapio->delete($id);
    }
}
?>