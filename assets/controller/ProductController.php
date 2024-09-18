<?php
require_once '../model/Database.php';
require_once '../model/Product.php';

class ProductController {
    public function create() {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        $product->nome = $_POST['nome'];
        $product->categoria = $_POST['categoria'];
        $product->unidade_medida = $_POST['unidade_medida'];

        if ($product->create()) {
            echo "Produto cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar produto.";
        }
    }

    public function readAll() {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        return $product->readAll();
    }

    public function update() {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        $product->id = $_POST['id'];
        $product->nome = $_POST['nome'];
        $product->categoria = $_POST['categoria'];
        $product->unidade_medida = $_POST['unidade_medida'];

        if ($product->update()) {
            echo "Produto atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar produto.";
        }
    }

    public function delete() {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        $product->id = $_POST['id'];

        if ($product->delete()) {
            echo "Produto deletado com sucesso!";
        } else {
            echo "Erro ao deletar produto.";
        }
    }
}