<?php
class Fornecedor {
    private $id;
    private $nome;
    private $endereco;
    private $telefone;
    private $whatsapp;
    private $email;
    private $ramo_atuacao;
    private $data_criacao;

    public function __construct($id, $nome, $endereco, $telefone, $whatsapp, $email, $ramo_atuacao, $data_criacao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->whatsapp = $whatsapp;
        $this->email = $email;
        $this->ramo_atuacao = $ramo_atuacao;
        $this->daata_criacao = $data_criacao;
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

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getWhatsapp() {
        return $this->whatsapp;
    }

    public function setWhatsapp($whatsapp) {
        $this->whatsapp = $whatsapp;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRamo() {
        return $this->ramo;
    }

    public function setRamo($ramo_atuacao) {
        $this->ramo_atuacao = $ramo_atuacao;
    }

    public function getDataCriacao() {
        return $this->data_criacao;
    }

    public function setDataCriacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
}
?>