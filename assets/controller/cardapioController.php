<?php
require_once __DIR__ . "/../model/pdo/Database.php";
require_once __DIR__ . "/../model/Cardapio.php";

class cardapioController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function criarcardapio($nutricionista_id, $dataC, $periodo, $descricao) {
        $this->db->insert("cardapios", (object)[
            "nutricionista_id" => $nutricionista_id,
            "dataC" => $dataC,
            "periodo" => $periodo,
            "descricao" => $descricao
        ]);
    }

    public function listarcardapios() {
        $todosCardapio = $this->db->read("cardapios");
        $arr = [];
        foreach($todosCardapio as $cardapio){
            $novocardapio = new cardapio($cardapio['id'], $cardapio['nutricionista_id'], $cardapio['dataC'], $cardapio['periodo'], $cardapio['descricao']);
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
        foreach($cardapios as $cardapio)
        {
                    echo "<option value=". $cardapio['id']. ">" . $cardapio['descricao'] . "</option>";
        }
    }
}
?>