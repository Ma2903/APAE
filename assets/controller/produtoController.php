<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ .'/../model/produto.php';

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
        $todosProdutos = $this->bd->read("produtos");
        $arr = [];
        foreach($todosProdutos as $produto){
            $novoProduto = new Produto($produto['id'], $produto['nome'], $produto['categoria'], $produto['unidade_medida'], $produto['data_criacao']);
            $arr[] = $novoProduto;
        }
        return $arr;
    }
    public function editarProdutos($idParaEditar, $nome, $categoria, $un){
            $this->bd->update('produtos', (object)[
                'nome'=> $nome,
                'categoria'=> $categoria,
                'unidade_medida'=> $un,
            ],$idParaEditar);
        }
    public function deletarProdutos($id){
        $this->bd->delete("produtos", $id);
    }
    
}
?>