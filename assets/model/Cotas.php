<?php
class Cota {
    private $id;
    private $produtoId;
    private $fornecedorId;
    private $precoUnitario;
    private $quantidade;
    private $relacaoUnidadePeso;
    private $dataCotacao;

    public function __construct($id, $produtoId, $fornecedorId, $precoUnitario, $quantidade,$relacaoUnidadePeso, $dataCotacao) {
        $this->id = $id;
        $this->produtoId = $produtoId;
        $this->fornecedorId = $fornecedorId;
        $this->precoUnitario = $precoUnitario;
        $this->quantidade = $quantidade;
        $this->relacaoUnidadePeso = $relacaoUnidadePeso;
        $this->dataCotacao = $dataCotacao;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProdutoId() {
        return $this->produtoId;
    }

    public function setProdutoId($produtoId) {
        $this->produtoId = $produtoId;
    }

    public function getFornecedorId() {
        return $this->fornecedorId;
    }

    public function setFornecedorId($fornecedorId) {
        $this->fornecedorId = $fornecedorId;
    }

    public function getPrecoUnitario() {
        return $this->precoUnitario;
    }

    public function setPrecoUnitario($precoUnitario) {
        $this->precoUnitario = $precoUnitario;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getDataCotacao() {
        return $this->dataCotacao;
    }

    public function setDataCotacao($dataCotacao) {
        $this->dataCotacao = $dataCotacao;
    }

    public function getRelacaoUnidadePeso() {
        return $this->relacaoUnidadePeso;
    }

    public function setRelacaoUnidadePeso($relacaoUnidadePeso) {
        $this->relacaoUnidadePeso = $relacaoUnidadePeso;
    }
}
?>