<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'sistema_apae';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }
    }
    public function insert($table, $data) {
        $columns = implode(", ", array_keys((array)$data));
        $placeholders = ":" . implode(", :", array_keys((array)$data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        try {
            $stmt = $this->conn->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $exception) {
            echo "Erro ao inserir: " . $exception->getMessage();
            return false;
        }
    }

    public function update($table, $data, $id) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $sql = "UPDATE $table SET $fields WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(":id", $id);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erro ao atualizar: " . $exception->getMessage();
            return false;
        }
    } 

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $id);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erro ao deletar: " . $exception->getMessage();
            return false;
        }
    }

    public function read($table, $columns = "*", $id = null) {
        $sql = "SELECT $columns FROM $table";
        if ($id !== null) {
            $sql .= " WHERE id = :id";
        }
        
        try {
            $stmt = $this->conn->prepare($sql);
            if ($id !== null) {
                $stmt->bindValue(":id", $id);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erro ao ler: " . $exception->getMessage();
            return false;
        }
    }
}
?>