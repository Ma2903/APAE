<?php
require_once __DIR__ . "/../model/pdo/Database.php";
require_once __DIR__ . "/../model/Cardapio.php";

class cardapioController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    public function criarcardapio($nutricionista_id, $dataC, $periodo, $descricao) {
        try {
            $this->db->insert("cardapios", (object)[
                "nutricionista_id" => $nutricionista_id,
                "dataC" => $dataC,
                "periodo" => $periodo,
                "descricao" => $descricao
            ]);
        } catch (Exception $e) {
            die("Erro ao cadastrar cardápio: " . $e->getMessage());
        }
    }
    public function criarCadProd($cardapio_id, $produto_id, $quantidade) {
        $this->db->insert("cardapio_produtos", (object)[
            "cardapio_id" => $cardapio_id,
            "produto_id" => $produto_id,
            "quantidade" => $quantidade,
        ]);
    }
    public function editarCadProd($cardapio_id, $produto_id, $quantidade) {
        $this->db->update(
            "cardapio_produtos",
            (object)[
                "quantidade" => $quantidade
            ],
            [
                "cardapio_id" => $cardapio_id,
                "produto_id" => $produto_id
            ]
        );
    }

    public function deleteCadProd($cardapio_id, $produto_id) {
        $this->db->delete("cardapio_produtos", [
            "cardapio_id" => $cardapio_id,
            "produto_id" => $produto_id
        ]);
        error_log("Removendo produto do cardápio: cardapio_id={$cardapio_id}, produto_id={$produto_id}");
    }

    public function listarcardapios() {
        $todosCardapio = $this->db->read("cardapios");

        usort($todosCardapio, function($a, $b) {
            return strtotime($a['dataC']) - strtotime($b['dataC']);
        });

        $arr = [];

        foreach($todosCardapio as $cardapio) {
            $novocardapio = new Cardapio($cardapio['id'], $cardapio['nutricionista_id'], $cardapio['dataC'], $cardapio['periodo'], $cardapio['descricao']);
            $arr[] = $novocardapio;
        }

        return $arr;
    }
    public function editarcardapio($id, $nutricionista_id, $dataC, $periodo, $descricao) {
        $this->db->update('cardapios', (object)[
            'nutricionista_id'=> $nutricionista_id,
            'dataC'=> $dataC,
            'periodo'=> $periodo,
            'descricao'=> $descricao,
        ],$id);
    }

    public function excluircardapio($id) {
        $this->db->delete("cardapios", $id);
    }

    public function filtrarCardapio() {
        $cardapios = $this->db->read("cardapios");
        foreach($cardapios as $cardapio){
            echo "<option value=". $cardapio['id']. ">" . $cardapio['descricao'] . "</option>";
        }
    }

    public function getNutricionistaNome($nutricionista_id) {
        $todoscardapios = $this->db->read("cardapios");
        $usuarioBanco = $this->db->read("usuarios");
        $nutricio = "";
        foreach($todoscardapios as $cardapio){
            if($cardapio['nutricionista_id'] == $nutricionista_id){
                foreach($usuarioBanco as $usuario){
                    if($cardapio['nutricionista_id'] == $usuario['id']){
                        $nutricio = $usuario['nome'];
                    }
                }
            }
        }
        return $nutricio;
        // foreach($usuarioBanco as $usuario)
        // {
        //     switch ($id) {
        //         case $usuario['id']:
        //             $nutricio = $usuario['nome'];
        //             break;
        //     }
        //     var_dump($nutricio); 
        //     return $nutricio;
        // }
    }

    public function getCardapioById($cardapioID) {
        $cardapio = $this->db->read("cardapios");
        foreach($cardapio as $cardapios) {
            if ($cardapios['id'] == $cardapioID) {
                return new Cardapio($cardapios['id'], $cardapios['nutricionista_id'], $cardapios['dataC'], $cardapios['periodo'], $cardapios['descricao']);
            }
        }
    }

    public function verificarProdutoNoCardapio($cardapio_id, $produto_id) {
        $produtos = $this->db->read("cardapio_produtos", [
            "cardapio_id" => $cardapio_id,
            "produto_id" => $produto_id
        ]);
        return !empty($produtos); // Retorna true se o produto existir
    }

    public function listarCadProdutos($cardapioID) {
        $query = "
            SELECT 
                cp.produto_id, 
                cp.quantidade, 
                p.nome AS produto_nome, 
                (SELECT preco_unitario / rel_un_peso FROM cotas WHERE produto_id = cp.produto_id ORDER BY data_cotacao DESC LIMIT 1) AS preco_por_grama,
                (cp.quantidade * (SELECT preco_unitario / rel_un_peso FROM cotas WHERE produto_id = cp.produto_id ORDER BY data_cotacao DESC LIMIT 1)) AS custo
            FROM 
                cardapio_produtos cp
            JOIN 
                produtos p ON cp.produto_id = p.id
            WHERE 
                cp.cardapio_id = :cardapio_id
        ";

        return $this->db->executeQuery($query, ['cardapio_id' => $cardapioID]);
    }
}
?>