<?php
require_once __DIR__ . '/../model/Administrador.php';
require_once __DIR__ . '/../model/Contador.php';
require_once __DIR__ . '/../model/Nutricionista.php';
require_once __DIR__ . '/../model/Usuario.php';

require_once __DIR__ . '/../model/pdo/DataBase.php';

require_once __DIR__ . '/../model/modules/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../model/modules/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../model/modules/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    public function RedefinirSenha($email, $senha)
    {
        $usuarios = $this->banco->read("usuarios");

        foreach($usuarios as $usuario)
        {
            if($usuario['email'] == $email)
            {
                $this->banco->update("usuarios",(object)[
                    'senha' => $senha
                ],$usuario['id']);
                header('Location: ./../principal/principal.php');
                break;
            }
        }
    }

    public function logarUsuarios($email, $senha)
    {
        $usuarioBanco = $this->getUsuarioPorEmail($email);
        if ($usuarioBanco) {
            if ($usuarioBanco['senha'] == $senha) {
                session_start();
                switch ($usuarioBanco['tipo_usuario']) {
                    case 'nutricionista':
                        $_SESSION['user'] = new Nutricionista($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['crn'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha'],$usuarioBanco['tipo_usuario']);
                        break;
                    case 'contador':
                        $_SESSION['user'] = new Contador($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha'],$usuarioBanco['tipo_usuario']);
                        break;
                    case 'administrador':
                        $_SESSION['user'] = new Administrador($usuarioBanco['id'], $usuarioBanco['cpf'], $usuarioBanco['nome'], $usuarioBanco['sobrenome'], $usuarioBanco['data_nascimento'], $usuarioBanco['endereco'], $usuarioBanco['telefone'], $usuarioBanco['email'], $usuarioBanco['senha'],$usuarioBanco['tipo_usuario']);
                        break;
                }
                return $_SESSION['user'];
            } else {
                echo "Senha Incorreta";
                return false;
            }
        } else {
            echo "<script>alert('Usuario Não Encontrado!')</script>";
            return false;
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
                case 'contador':
                    $usuarios[] = new Contador($usuario['id'], $usuario['cpf'], $usuario['nome'], $usuario['sobrenome'], $usuario['data_nascimento'], $usuario['endereco'], $usuario['telefone'], $usuario['email'], $usuario['senha'],$usuario['tipo_usuario']);
                    break;
                case 'administrador':
                    $usuarios[] = new Administrador($usuario['id'], $usuario['cpf'], $usuario['nome'], $usuario['sobrenome'], $usuario['data_nascimento'], $usuario['endereco'], $usuario['telefone'], $usuario['email'], $usuario['senha'],$usuario['tipo_usuario']);
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

    public function deleteUsuario($id){
        var_dump($this->banco->delete('usuarios',$id));
        header('Location: ./../listarUsuario/listarUsuario.php');
    }

    public function enviarCodigoRedefinicao($email) {
        $codigo = rand(100000, 999999);
        session_start();
        $_SESSION['codigo'] = $codigo;
        $_SESSION['emailRecuperar'] = $email;
        header('Location: ./../redefinirSenha/RedefinirPassword.php');
        $assunto = "Redefinição de Senha";
        $mensagem = "Seu código para redefinir a senha é: $codigo";
        $headers = "From: no-reply@apae.org";
        $this->EnviarEmail($email, $assunto, $mensagem, $headers);
    }

    public function EnviarEmail($email, $assunto, $mensagem, $headers) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'godlolpro32@gmail.com';
            $mail->Password = 'bepn wogf bvty gtpb';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
        
            $mail->setFrom('no-reply@apae.com', 'Apae');
            $mail->addAddress($email, 'Nome do Destinatário');
        
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;
        
            $mail->send();
        } catch (Exception $e) {
            echo "E-mail não pôde ser enviado. Erro: {$mail->ErrorInfo}";
        }
    }

    public function UpSenha($email, $password, $Verifpassword){
        $usuario = $this->getUsuarioPorEmail($email);
        if ($usuario) {
            if ($password == $Verifpassword) {
                $this->banco->update("usuarios", (object)[
                    'senha' => $password,
                ], $usuario['id']);
            }
        }
        header('Location: ../index.php');
    }

    public function getUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->banco->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function alterarSenha($email, $novaSenha) {
        $stmt = $this->banco->conn->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
        $stmt->bindParam(':senha', $novaSenha);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
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

    public function filtrarNutricionistas() {
        $usuarioBanco = $this->banco->read("usuarios");
        foreach($usuarioBanco as $usuario)
        {
            switch ($usuario['tipo_usuario']) {
                case 'nutricionista':
                    echo "<option value=". $usuario['id']. ">" . $usuario['nome'] . "</option>";
                    break;
            }
        }
    }
}
?>