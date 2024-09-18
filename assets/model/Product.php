<?php
class Product {
    private $conn;
    private $table = 'produtos';

    public $id;
    public $nome;
    public $categoria;
    public $unidade_medida;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (nome, categoria, unidade_medida) VALUES (:nome, :categoria, :unidade_medida)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':unidade_medida', $this->unidade_medida);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET nome = :nome, categoria = :categoria, unidade_medida = :unidade_medida WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':unidade_medida', $this->unidade_medida);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}