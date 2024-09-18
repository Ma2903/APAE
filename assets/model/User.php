<?php
class User {
    private $conn;
    private $table = 'usuarios';

    public $id;
    public $cpf;
    public $nome;
    public $sobrenome;
    public $data_nascimento;
    public $endereco;
    public $telefone;
    public $email;
    public $senha;
    public $tipo_usuario;
    public $crn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email AND senha = :senha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->execute();
        return $stmt;
    }

    public function register() {
        $query = "INSERT INTO " . $this->table . " 
            (cpf, nome, sobrenome, data_nascimento, endereco, telefone, email, senha, tipo_usuario, crn)
            VALUES (:cpf, :nome, :sobrenome, :data_nascimento, :endereco, :telefone, :email, :senha, :tipo_usuario, :crn)";
        $stmt = $this->conn->prepare($query);

        // Binding params
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':sobrenome', $this->sobrenome);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':endereco', $this->endereco);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
        $stmt->bindParam(':crn', $this->crn);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}