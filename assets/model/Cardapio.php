<?php
require_once __DIR__ . "/pdo/Database.php";

class Cardapio {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($nutricionista, $dataC, $periodo, $descricao) {
        $sql = "INSERT INTO cardapios (nutricionista, dataC, periodo, descricao) VALUES (:nutricionista, :dataC, :periodo, :descricao)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':nutricionista', $nutricionista);
        $stmt->bindParam(':dataC', $dataC);
        $stmt->bindParam(':periodo', $periodo);
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

    public function update($id, $nutricionista, $dataC, $descricao) {
        $sql = "UPDATE cardapios SET nutricionista = :nutricionista, dataC = :dataC, periodo = :periodo, descricao = :descricao WHERE id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nutricionista', $nutricionista);
        $stmt->bindParam(':dataC', $dataC);
        $stmt->bindParam(':periodo', $periodo);
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