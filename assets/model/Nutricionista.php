<?php
include_once 'Usuario.php';

class Nutricionista extends Usuario{
    protected $crn;
    public function __construct($id, $cpf,$crn, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha) {
        parent::__construct($id, $cpf, $crn, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha);
        $this->crn = $crn;
    }
}
?>