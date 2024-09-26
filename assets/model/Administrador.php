<?php
include_once 'Usuario.php';

class Administrador extends Usuario{
    public function __construct($id, $cpf, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha) {
        parent::__construct($id, $cpf, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha);
    }
}
?>