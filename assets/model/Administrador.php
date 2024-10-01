<?php
include_once 'Usuario.php';

class Administrador extends Usuario{
    public function __construct($id, $cpf, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha,$tipo_usuario) {
        parent::__construct($id, $cpf, $nome, $sobrenome, $dataNasc, $endereco, $telefone, $email, $senha,$tipo_usuario);
    }
}
?>