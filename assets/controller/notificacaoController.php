<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ . '/../model/Notificacao.php';

class ControladorNotificacao{
    private $bd;
    public function __construct() {
        $this->bd = new Database();
    }
    public function cadastrarNotificacao($descricao, $data_criacao){
        $this->bd->insert("notificacoes", (object)[
            "mensagem" => $descricao,
            "data_notificacao" => $data_criacao
        ]);
    }
    public function verNotificacao(){
        $todasNotificacoes = $this->bd->read("notificacoes");
        $arr = [];
        foreach($todasNotificacoes as $notificacao){
            $novaNotificacao = new Notificacao($notificacao['id'],$notificacao['usuario_id'], $notificacao['mensagem'],$notificacao['data_notificacao'] );
            $arr[] = $novaNotificacao;
        }
        return $arr;
    }
    public function editarNotificacao($id, $titulo, $descricao){
        $this->bd->update("notificacoes", (object)[
            "titulo" => $titulo,
            "descricao" => $descricao
        ], $id);
    }
    public function deletarNotificacao($id){
        $this->bd->delete("notificacoes", $id);
    }
    
    public function verNotificacaoPorId($id) {
        // Supondo que você tenha um método para obter todas as notificações
        $notificacoes = $this->verNotificacao();
        $notificacoesEncontradas = [];
        
        foreach ($notificacoes as $notificacao) {
            if ($notificacao->getUserId() == $id) {
                $notificacoesEncontradas[] = $notificacao;
            }
        }
        
        return $notificacoesEncontradas; // Retorna um array com todas as notificações encontradas
    }
    public function verificarNotificacoes($usuario) {
        // Obtém o ID do usuário a partir do método getId()
        $usuarioId = $usuario->getId();
    
        // Obtém as notificações do usuário
        $notificacoes = $this->verNotificacaoPorId($usuarioId);
    
        // Verifica se o usuário é um cotador usando o método getTipo()
        if ($usuario->getTipoUsuario() === 'contador') {
            // Obtém a data da semana atual
            $inicioSemana = date('Y-m-d', strtotime('monday this week'));
            $fimSemana = date('Y-m-d', strtotime('sunday this week'));
    
            // Verifica se há cotações na semana atual
            $query = "SELECT COUNT(*) as total FROM cotas WHERE data_cotacao BETWEEN :inicioSemana AND :fimSemana";
            $params = [
                ':inicioSemana' => $inicioSemana,
                ':fimSemana' => $fimSemana
            ];
            $resultado = $this->bd->executeQuery($query, $params);
    
            if ($resultado[0]['total'] == 0) {
                // Gera uma notificação caso não haja cotações
                $this->cadastrarNotificacao(
                    "Lembrete de Cotações",
                    "Você não realizou cotações nesta semana. Não se esqueça de realizar suas cotações!",
                    date('Y-m-d H:i:s')
                );
            }
        }
    }
}


?>