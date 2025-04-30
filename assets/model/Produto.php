<?php
class Produto {
    private $id;
    private $nome;
    private $categoria;
    private $dt_criacao;
    private $unidade_medida; // Renomeado de $un para $unidade_medida

    public function __construct($id, $nome, $categoria, $dt_criacao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->dt_criacao = $dt_criacao;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getUnidadeMedida() { // Renomeado de getUn para getUnidadeMedida
        return $this->unidade_medida;
    }

    public function setUnidadeMedida($unidade_medida) { // Renomeado de setUn para setUnidadeMedida
        $this->unidade_medida = $unidade_medida;
    }

    public function getDtCriacao() {
        return $this->dt_criacao;
    }

    public function setDtCriacao($dt_criacao) {
        $this->dt_criacao = $dt_criacao;
    }
}
?>