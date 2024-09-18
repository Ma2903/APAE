<?php
require_once '../model/Database.php';
require_once '../model/User.php';

class UserController {
    public function register() {
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);

        $user->cpf = $_POST['cpf'];
        $user->nome = $_POST['nome'];
        $user->sobrenome = $_POST['sobrenome'];
        $user->data_nascimento = $_POST['data_nascimento'];
        $user->endereco = $_POST['endereco'];
        $user->telefone = $_POST['telefone'];
        $user->email = $_POST['email'];
        $user->senha = $_POST['senha'];
        $user->tipo_usuario = $_POST['tipo_usuario'];
        $user->crn = isset($_POST['crn']) ? $_POST['crn'] : null;

        if ($user->register()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
}