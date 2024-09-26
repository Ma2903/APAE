<?php
require_once __DIR__ . '/../model/Administrador.php';
require_once __DIR__ . '/../model/Funcionario.php';
require_once __DIR__ . '/../model/Nutricionista.php';

class ControladorUsuarios
{
    public function cadastrarUsuarios($nome, $email, $senha)
    {
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);

        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->cadastrar($usuario);
    }

    public function logarUsuarios($email, $senha)
    {
        $usuario = new Usuario();
        $usuario->setEmail($email);
        $usuario->setSenha($senha);

        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->logar($usuario);
    }
}

?>