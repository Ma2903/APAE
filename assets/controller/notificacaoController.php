<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ . '/../model/Notificacao.php';

class ControladorNotificacao{
    private $bd;
    public function __construct() {
        $this->bd = new Database();
    }
    public function cadastrarNotificacao($titulo, $descricao, $data_criacao){
        $this->bd->insert("notificacoes", (object)[
            "titulo" => $titulo,
            "descricao" => $descricao,
            "data_criacao" => $data_criacao
        ]);
    }
    public function verNotificacao(){
        $todasNotificacoes = $this->bd->read("notificacoes");
        $arr = [];
        foreach($todasNotificacoes as $notificacao){
            $novaNotificacao = new Notificacao($notificacao['id'],$notificacao['usuario_id'], $notificacao['mensagem'],$notificacao['data_notificacao'], $notificacao['is_active']);
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
}


?>