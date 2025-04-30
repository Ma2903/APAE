<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ .'/../model/Produto.php';

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
            $novoProduto->setUnidadeMedida($produto['unidade_medida']); // Adicionado
            $arr[] = $novoProduto;
        }
        return $arr;
    }
    
    public function editarProduto($idParaEditar, $nome, $categoria, $un) { // Renomeado de editarProdutos para editarProduto
        $this->bd->update('produtos', (object)[
            'nome' => $nome,
            'categoria' => $categoria,
            'unidade_medida' => $un,
        ], $idParaEditar);
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

    public function filtrarProdutosCotadosSemanaAtual(){
        $cotas = $this->bd->read("cotas");
        $semanaAtual = $this->obterInicioEFimDaSemanaAtual();
        $produtosCotados = [];


        foreach($cotas as $cota){
            if($cota['data_cotacao'] >= $semanaAtual['inicioSemana'] && $cota['data_cotacao'] <= $semanaAtual['fimSemana']){

                $produtos = $this->bd->read("produtos");
                
                foreach($produtos as $produto){
                    if($produto['id'] == $cota['produto_id']){
                        $produtosCotados[] = [
                            "preco_por_grama" => floatval($cota['preco_unitario']) / floatval($cota['rel_un_peso']),
                            "produto" => new Produto($produto['id'], $produto['nome'], $produto['categoria'], $produto['data_criacao'])
                        ];
                    }
                }
            }
        }
        
        return $produtosCotados;
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

    
    function obterInicioEFimDaSemanaAtual() {
        // Obter a data atual
        $dataAtual = date('Y-m-d');
        
        // Calcular o início da semana (segunda-feira)
        $inicioSemana = date('Y-m-d', strtotime('monday this week', strtotime($dataAtual)));
        
        // Calcular o fim da semana (domingo)
        $fimSemana = date('Y-m-d', strtotime('sunday this week', strtotime($dataAtual)));
        
        return [
            'inicioSemana' => $inicioSemana,
            'fimSemana' => $fimSemana
        ];
    }
}
?>