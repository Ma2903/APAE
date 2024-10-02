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

    public function cadastrarUsuarios($nome, $cpf,$sobrenome,$datanasc,$endereco,$telefone,$email,$tipo, $senha,$crn)
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
            if($usuarioBanco['cpf'] == $cpf)
            {
                $usuarioEncontrado = true;
                echo "Usuario já cadastrado";
                break;
            }
        }
        if(!$usuarioEncontrado)
        {
            if($crn != ''){
                $crn;
            }
            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao = date("Y-m-d H:i:s");

            $this->banco->insert("usuarios",(object) [
                'cpf' => $cpf,
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'data_nascimento' => $datanasc,
                'endereco' => $endereco,
                'telefone' => $telefone,
                'email' => $email,
                'senha' => $senha,
                'tipo_usuario' => $tipo,
                'crn' => $crn,
                'data_criacao' => $data_criacao
            ]);
            header("Location: ./../listarUsuario/listarUsuario.php");
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
                    header("Location: principal.php");
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
            echo "<script>alert('Usuario Não Encontrado!')<script>";
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
                // default:
                //     $usuarios[] = new Usuario($usuario['id'], $usuario['cpf'], $usuario['nome'], $usuario['sobrenome'], $usuario['data_nascimento'], $usuario['endereco'], $usuario['telefone'], $usuario['email'], $usuario['senha'], $usuario['tipo_usuario']);
                //     break;
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
    public function deleteUsuario($id){
        var_dump($this->banco->delete('usuarios',$id));
        header('Location: ./../listarUsuario/listarUsuario.php');
    }

    // CODIGO COM ERRO PARA SER CONSERTADO FUTURAMENTE ANTES DA PROXIMA ENTREGA

    // public function enviarCodigoRedefinicao($email) {
    //     // Verificar se o e-mail existe no banco de dados
    //     $query = "SELECT id FROM usuarios WHERE email = :email";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->execute();
    //     $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if ($usuario) {
    //         // Gerar um código de redefinição aleatório
    //         $codigo = rand(100000, 999999);
            
    //         // Salvar o código no banco de dados
    //         $query = "UPDATE usuarios SET codigo_redefinicao = :codigo WHERE id = :id";
    //         $stmt = $this->db->prepare($query);
    //         $stmt->bindParam(':codigo', $codigo);
    //         $stmt->bindParam(':id', $usuario['id']);
    //         $stmt->execute();

    //         // Enviar o e-mail com o código de redefinição
    //         $assunto = "Redefinição de Senha";
    //         $mensagem = "Seu código para redefinir a senha é: $codigo";
    //         $headers = "From: no-reply@apae.org";

    //         mail($email, $assunto, $mensagem, $headers);
            
    //         return true;
    //     } else {
    //         return false; // Usuário não encontrado
    //     }
    // }
    // public function redefinirSenha($email, $codigo, $novaSenha) {
    //     // Verificar o código de redefinição
    //     $query = "SELECT id FROM usuarios WHERE email = :email AND codigo_redefinicao = :codigo";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->bindParam(':codigo', $codigo);
    //     $stmt->execute();
    //     $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if ($usuario) {
    //         // Atualizar a senha do usuário
    //         $hashSenha = password_hash($novaSenha, PASSWORD_BCRYPT);
    //         $query = "UPDATE usuarios SET senha = :senha, codigo_redefinicao = NULL WHERE id = :id";
    //         $stmt = $this->db->prepare($query);
    //         $stmt->bindParam(':senha', $hashSenha);
    //         $stmt->bindParam(':id', $usuario['id']);
    //         $stmt->execute();

    //         return true; // Senha alterada com sucesso
    //     } else {
    //         return false; // Código inválido
    //     }
    // Array simulado de usuários (substitua isso pela sua lógica de armazenamento real)
    // Função para obter um usuário pelo e-mail


    // CODIGO INCOMPLETO
    public function getUsuarioPorEmail($email) {
        $usuario = $this->banco->read("usuarios");
        if($email == $usuario['email']){
            return true;
        }
        else{
            return false;
        }

    }

    // Função para alterar a senha do usuário
    public function alterarSenha($email, $novaSenha) {
        $stmt = $this->banco->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
        $stmt->bindParam(':senha', $novaSenha);
        $stmt->bindParam(':email', $email);
    }
    
    public function obterPermissoes($tipo_usuario) {
        $conn = $this->banco->conn;
        $sql = "SELECT * FROM permissoes WHERE tipo_usuario = :tipo_usuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":tipo_usuario", $tipo_usuario);
        $stmt->execute();
        $permissoes = $stmt->fetch(PDO::FETCH_ASSOC);
        return $permissoes;
    }
}
?>