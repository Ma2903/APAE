<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ . '/../model/Cotas.php';

class ControladorCotacao {
    private $bd;

    public function __construct() {
        $this->bd = new Database();
    }

    public function cadastrarCota($produtoId, $fornecedorId, $precoUnitario,$relacaoUnidadePeso, $quantidade) {
        date_default_timezone_set('America/Sao_Paulo');
        $data_criacao = date("Y-m-d H:i:s");

        $this->bd->insert("cotas", (object)[
            "produto_id" => $produtoId,
            "fornecedor_id" => $fornecedorId,
            "preco_unitario" => $precoUnitario,
            "quantidade" => $quantidade,
            "rel_un_peso" => $relacaoUnidadePeso,
            "data_cotacao" => $data_criacao
        ]);

        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Cota cadastrada com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                     window.location.href = './../listarCotacoes/listarCotacoes.php';
                });
              </script>";
    }

    public function verCotas() {
        $todasCotas = $this->bd->read("cotas");
        $arr = [];
        foreach($todasCotas as $cota) {
            $novaCota = new Cota($cota['id'], $cota['produto_id'], $cota['fornecedor_id'], $cota['preco_unitario'], $cota['quantidade'],$cota['rel_un_peso'], $cota['data_cotacao']);
            $arr[] = $novaCota;
        }
        return $arr;
    }

    public function editarCota($idParaEditar, $produtoId, $fornecedorId, $precoUnitario,$rel_un_preco, $quantidade, $dataCotacao) {
        $this->bd->update('cotas', (object)[
            'produto_id' => $produtoId,
            'fornecedor_id' => $fornecedorId,
            'preco_unitario' => $precoUnitario,
            'rel_un_peso' => $rel_un_preco,
            'quantidade' => $quantidade,
            'data_cotacao' => $dataCotacao
        ], $idParaEditar);
        
        echo $dataCotacao;
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Cota editada com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    }

    public function deletarCota($id) {
        $this->bd->delete("cotas", $id);

        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Cota deletada com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    }

    public function verCadProdutos($cardapio_id){
        $todosCadProdutosCot = $this->bd->read("cardapio_produtos");
        $todosCardapios = $this->bd->read("cardapios");
        $todosProdutos = $this->bd->read("produtos");

        
        $arr = [];
        foreach($todosCardapios as $cardapio){
            if($cardapio['id'] == $cardapio_id){
                $cardapioSelecionado = $cardapio;
                
                foreach($todosCadProdutosCot as $ProdutoCot){
                    if($ProdutoCot['cardapio_id'] == $cardapioSelecionado['id']){
                        
                        foreach($todosProdutos as $produto){
                            if($produto['id'] == $ProdutoCot['produto_id']){
                                $arr[] = $produto['nome'];
                            }
                        }
                        
                    }
                }
            }
        }
        return $arr;
    }
    
}
?>