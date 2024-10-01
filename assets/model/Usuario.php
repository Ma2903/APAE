<?php
abstract class Usuario {
    protected $id;
    protected $cpf;
    protected $nome;
    protected $sobrenome;
    protected $dataNasc;
    protected $endereco;
    protected $telefone;
    protected $email;
    protected $senha;
    protected $tipo_usuario;

    public function __construct($id, $cpf, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha,$tipo_usuario) {
        $this->id = $id;
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->dataNasc = $dataNasc;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function getDataNasc() {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function getTipoUsuario() {
        return $this->tipo_usuario;
    }
}
?>