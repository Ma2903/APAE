<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ . '/../model/Cotas.php';

class ControladorCotacao {
    private $bd;

    public function __construct() {
        $this->bd = new Database();
    }

    public function cadastrarCota($produtoId, $fornecedorId, $precoUnitario, $quantidade, $dataCotacao) {
        $this->bd->insert("cotas", (object)[
            "produto_id" => $produtoId,
            "fornecedor_id" => $fornecedorId,
            "preco_unitario" => $precoUnitario,
            "quantidade" => $quantidade,
            "data_cotacao" => $dataCotacao
        ]);
    }

    public function verCotas() {
        $todasCotas = $this->bd->read("cotas");
        $arr = [];
        foreach($todasCotas as $cota) {
            $novaCota = new Cota($cota['id'], $cota['produto_id'], $cota['fornecedor_id'], $cota['preco_unitario'], $cota['quantidade'], $cota['data_cotacao']);
            $arr[] = $novaCota;
        }
        return $arr;
    }

    public function editarCota($idParaEditar, $produtoId, $fornecedorId, $precoUnitario, $quantidade, $dataCotacao) {
        $this->bd->update('cotas', (object)[
            'produto_id' => $produtoId,
            'fornecedor_id' => $fornecedorId,
            'preco_unitario' => $precoUnitario,
            'quantidade' => $quantidade,
            'data_cotacao' => $dataCotacao
        ], $idParaEditar);
    }

    public function deletarCota($id) {
        $this->bd->delete("cotas", $id);
    }
}
?>