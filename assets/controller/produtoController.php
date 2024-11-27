<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ .'/../model/Produto.php';
require_once __DIR__ .'/../model/Cardapio_prod.php';

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


    // GAMBIARRA
    public function armazenarProdutosSelecionados($cardapio_id, $produto_id, $quantidade) {
        $this->bd->insert("cardapio_produtos");
        $produtosSelecionados = [];
        foreach ($produtosSelecionados as $produto) {
            $produto_id = $produto['produto'];
            $quantidade = $produto['quantidade'];
            $this->bd->insert("cardapio_produtos", (object)[
                "cardapio_id" => $cardapio_id,
                "produto_id" => $produto_id,
                "quantidade" => $quantidade
            ]);

        }
    }
    // GAMBIARRA


    public function verProdutos(){
        $todosProdutos = $this->bd->read("produtos");
        $arr = [];
        foreach($todosProdutos as $produto){
            $novoProduto = new Produto($produto['id'], $produto['nome'], $produto['categoria'], $produto['data_criacao']);
            $arr[] = $novoProduto;
        }
        return $arr;
    }

    public function verCadProdutos(){
        $todosCadProdutos = $this->bd->read("cardapio_produtos");
        $arr = [];
        foreach($todosCadProdutos as $Cadproduto){
            $novoProduto = new Cardapio_produtos($Cadproduto['id'], $Cadproduto['cardapio_id'], $Cadproduto['produto_id'], $Cadproduto['quantidade']);
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

    public function filtrarProdutos() {
        $produtosBanco = $this->bd->read("produtos");
        foreach($produtosBanco as $produto) {
            echo '<option value="' . $produto['id'] . '">' . $produto['nome'] . '</option>';
        }
    }

    public $ProdutosSelecionados = [];

    public function adicionarSelecionado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ProdutosSelecionados[] = [$_POST['produto'], $_POST['quantidade']];
            }
    }

    public function verSelecionados() {
        foreach($this->ProdutosSelecionados as $produto) {
            echo $produto . '<br>';
        }
    }
}
?>