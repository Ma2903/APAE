<?php
include_once 'Usuario.php';

class Nutricionista extends Usuario{
    protected $crn;
    public function __construct($id, $cpf,$crn, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha,$tipo_usuario) {
        parent::__construct($id, $cpf, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha,$tipo_usuario);
        $this->crn = $crn;
    }
    public function getCrn() {
        return $this->crn;
    }
}
?>