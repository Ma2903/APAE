<?php
require_once __DIR__ . '/../model/Administrador.php';
require_once __DIR__ . '/../model/Funcionario.php';
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

    public function enviarCodigoRedefinicao($email) {
        // Verificar se o e-mail existe no banco de dados
        $banco = $this->banco->read("usuarios");
        $usuarios = $banco;
        foreach($usuarios as $usuario){
            if($usuario['email'] == $email){
                $usuarioExists = true;
            }
        }

        if ($usuarioExists) {
            // Gerar um código de redefinição aleatório
            $codigo = rand(100000, 999999);

            // Enviar o e-mail com o código de redefinição
            $assunto = "Redefinição de Senha";
            $mensagem = "Seu código para redefinir a senha é: $codigo";
            $headers = "From: no-reply@apae.org";

            $this->EnviarEmail($email, $assunto, $mensagem, $headers);

            return true;
        } else {
            return false; // Usuário não encontrado
        }
    }

    public function EnviarEmail($email, $assunto, $mensagem, $headers) {
        $mail = new PHPMailer(true);
        try {
            //ConfiguraÃ§Ãµes do servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Defina o servidor SMTP
            $mail->SMTPAuth = true; // Ativar autenticaÃ§Ã£o SMTP
            $mail->Username = 'godlolpro32@gmail.com'; // Seu usuÃ¡rio SMTP
            $mail->Password = 'bepn wogf bvty gtpb'; // Sua senha SMTP
            $mail->SMTPSecure = 'tls'; // Ativar criptografia TLS
            $mail->Port = 587; // Porta TCP a conectar
        
            $mail->setFrom('no-reply@apae.com', 'Apae');
            $mail->addAddress($email, 'Nome do DestinatÃ¡rio'); // Adicione um destinatÃ¡rio
        
            $mail->isHTML(true); // Defina o formato de email como HTML
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;
        
            $mail->send();
            echo 'E-mail enviado com sucesso!';
        } catch (Exception $e) {
            echo "E-mail nÃ£o pÃ´de ser enviado. Erro: {$mail->ErrorInfo}";
        }
    }

    public function UpSenha($email, $password, $Verifpassword){
        $usuarios = $this->banco->read("usuarios");
        foreach($usuarios as $usuario)
        {
            if($usuario['email'] == $email)
            {
                if($password == $Verifpassword){
                    $this->banco->update("usuarios",(object)[
                        'senha' => $password,
                    ],$usuario['id']);
                    break;
                }
            }
        }
        header('Location: ../index.php');
    }

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