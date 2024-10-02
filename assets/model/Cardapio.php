<?php
require_once __DIR__ . "/pdo/Database.php";

class Cardapio {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($nutricionista, $data_inicio, $data_fim, $descricao) {
        $sql = "INSERT INTO cardapios (nutricionista, data_inicio, data_fim, descricao) VALUES (:nutricionista, :data_inicio, :data_fim, :descricao)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':nutricionista', $nutricionista);
        $stmt->bindParam(':data_inicio', $data_inicio);
        $stmt->bindParam(':data_fim', $data_fim);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id) {
            $sql = "SELECT * FROM cardapios WHERE id = :id";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM cardapios";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($id, $nutricionista, $data_inicio, $data_fim, $descricao) {
        $sql = "UPDATE cardapios SET nutricionista = :nutricionista, data_inicio = :data_inicio, data_fim = :data_fim, descricao = :descricao WHERE id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nutricionista', $nutricionista);
        $stmt->bindParam(':data_inicio', $data_inicio);
        $stmt->bindParam(':data_fim', $data_fim);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM cardapios WHERE id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>