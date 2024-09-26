<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';

class ControladorProdutos{
    private $bd;
    public function __construct() {
        $this->bd = new Database();
    }
    public function cadastrarProdutos($nome, $categoria, $un , $dt_criacao){
        $this->bd->insert("produtos", (object)[
            "nome" => $nome,
            "categoria" => $categoria,
            "unidade_medida" => $un,
            "data_criacao" => $dt_criacao
        ]);
    }
    public function verProdutos(){
        
    }
    public function editarProdutos(){

    }
    public function deletarProdutos($id){
        $this->bd->delete("produtos", $id);
    }
    
}

    // $db = new Database();
    // $conn = $db->getConnection();
    // $result = $db->insert("usuarios", (object)["nome" => "teste"]);
    // if ($result) {
    //     echo "Inserido com sucesso. ID: " . $result;
    // } else {
    //     echo "Falha na inserção.";
    // }
?>