<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';

class ControladorProdutos{
    private $connection;

    public function __construct() {
        $this->connection = new Database();
    }
    public function cadastrarProdutos(){
        echo 'teste';
    }
    public function verProdutos(){

    }
    public function editarProdutos(){

    }
    public function deletarProdutos(){

    }
    
}

    $db = new Database();
    $conn = $db->getConnection();
    $result = $db->insert("usuarios", (object)["nome" => "cu"]);
    if ($result) {
        echo "Inserido com sucesso. ID: " . $result;
    } else {
        echo "Falha na inserção.";
    }
?>