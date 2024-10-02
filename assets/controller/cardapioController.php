<?php
require_once __DIR__ . "/../model/Cardapio.php";

class CardapioController {
    private $cardapio;

    public function __construct() {
        $this->cardapio = new Cardapio();
    }

    public function criarCardapio($nutricionista, $data_inicio, $data_fim, $descricao) {
        return $this->cardapio->create($nutricionista, $data_inicio, $data_fim, $descricao);
    }

    public function listarCardapios() {
        return $this->cardapio->read();
    }

    public function obterCardapio($id) {
        return $this->cardapio->read($id);
    }

    public function atualizarCardapio($id, $nutricionista, $data_inicio, $data_fim, $descricao) {
        return $this->cardapio->update($id, $nutricionista, $data_inicio, $data_fim, $descricao);
    }

    public function excluirCardapio($id) {
        return $this->cardapio->delete($id);
    }
}
?>