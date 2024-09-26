<?php
require_once __DIR__ . '/../model/Administrador.php';
require_once __DIR__ . '/../model/Funcionario.php';
require_once __DIR__ . '/../model/Nutricionista.php';
require_once __DIR__ . '/../model/Usuario.php';

require_once __DIR__ . '/../model/pdo/DataBase.php';

class ControladorUsuarios
{
    private $banco;
    public function __construct() {
        $this->banco = new DataBase;
    }
    public function cadastrarUsuarios($nome, $email, $senha)
    {
        $usuarios = $this->banco->read("usuarios");
        $usuarioEncontrado = false;
        foreach($usuarios as $usuarioBanco)
        {
            if($usuarioBanco['email'] == $email)
            {
                $usuarioEncontrado = true;
                echo "Usuario já cadastrado";
                break;
            }
        }
        if(!$usuarioEncontrado)
        {
            $this->banco->create("usuarios", ['nome' => $nome, 'email' => $email, 'senha' => $senha]);
            echo "Usuario cadastrado com sucesso";
        }
    }

    public function logarUsuarios($email, $senha)
    {
        $usuarios = $this->banco->read("usuarios");
        $usuarioEncontrado = false;
        foreach($usuarios as $usuarioBanco)
        {
            if($usuarioBanco['email'] == $email)
            {
                $usuarioEncontrado = true;
                if($usuarioBanco['senha'] == $senha){
                    switch ($usuarioBanco['tipo_usuario']) {
                        case 'nutricionista':
                            $_SESSION['user'] = new Nutricionista($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['crn'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha']);
                            break;
                        case 'funcionario':
                            $_SESSION['user'] = new Funcionario($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha']);
                            break;
                        case 'administrador':
                            $_SESSION['user'] = new Administrador($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha']);
                            break;
                        default:
                            $_SESSION['user'] = new Usuario($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha']);
                            break;
                    }
                    break;
                }
                else {
                    echo "Senha Incorreta";
                    break;
                }
            }
        }
        if(!$usuarioEncontrado)
        {
            echo "Usuario não encontrado";
        }

    }
}

?>