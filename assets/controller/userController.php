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
                    session_start();
                    switch ($usuarioBanco['tipo_usuario']) {
                        case 'nutricionista':
                            $_SESSION['user'] = new Nutricionista($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['crn'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha'],$usuarioBanco['tipo_usuario']);
                            break;
                        case 'funcionario':
                            $_SESSION['user'] = new Funcionario($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha'],$usuarioBanco['tipo_usuario']);
                            break;
                        case 'administrador':
                            $_SESSION['user'] = new Administrador($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha'],$usuarioBanco['tipo_usuario']);
                            break;
                        default:
                            $_SESSION['user'] = new Usuario($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha'], $usuarioBanco['tipo_usuario']);
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

    public function listarUsuarios()
    {
        $usuarioBanco = $this->banco->read("usuarios");
        foreach($usuarioBanco as $usuario)
        {
            switch ($usuario['tipo_usuario']) {
                case 'nutricionista':
                    $usuarios[] = new Nutricionista($usuario['id'], $usuario['cpf'], $usuario['crn'], $usuario['nome'], $usuario['sobrenome'], $usuario['data_nascimento'], $usuario['endereco'], $usuario['telefone'], $usuario['email'], $usuario['senha'],$usuario['tipo_usuario']);
                    break;
                case 'funcionario':
                    $usuarios[] = new Funcionario($usuario['id'], $usuario['cpf'], $usuario['nome'], $usuario['sobrenome'], $usuario['data_nascimento'], $usuario['endereco'], $usuario['telefone'], $usuario['email'], $usuario['senha'],$usuario['tipo_usuario']);
                    break;
                case 'administrador':
                    $usuarios[] = new Administrador($usuario['id'], $usuario['cpf'], $usuario['nome'], $usuario['sobrenome'], $usuario['data_nascimento'], $usuario['endereco'], $usuario['telefone'], $usuario['email'], $usuario['senha'],$usuario['tipo_usuario']);
                    break;
                default:
                    $usuarios[] = new Usuario($usuario['id'], $usuario['cpf'], $usuario['nome'], $usuario['sobrenome'], $usuario['data_nascimento'], $usuario['endereco'], $usuario['telefone'], $usuario['email'], $usuario['senha'], $usuario['tipo_usuario']);
                    break;
            }
            
        }
        return $usuarios;
    }
    public function editarUsuario($id, $cpf, $nome, $sobrenome, $data_nascimento, $endereco, $telefone, $email, $senha, $tipo_usuario, $crn)
    {
        $usuarios = $this->banco->read("usuarios");
        foreach($usuarios as $usuario)
        {
            if($usuario['id'] == $id)
            {
                $this->banco->update("usuarios",(object)[
                    'cpf' => $cpf,
                    'nome' => $nome,
                    'sobrenome' => $sobrenome,
                    'data_nascimento' => $data_nascimento,
                    'endereco' => $endereco,
                    'telefone' => $telefone,
                    'email' => $email,
                    'senha' => $senha,
                    'tipo_usuario' => $tipo_usuario,
                    'crn' => $crn === 'nulo' ? NULL : $crn
                ],$id);
                break;
            }
        }

    }
}

?>