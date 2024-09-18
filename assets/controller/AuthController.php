<?php
require_once '../model/Database.php';
require_once '../model/User.php';

class AuthController {
    public function login() {
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);

        $user->email = $_POST['email'];
        $user->senha = $_POST['senha'];

        $result = $user->login();
        if ($result->rowCount() > 0) {
            session_start();
            $_SESSION['user'] = $result->fetch(PDO::FETCH_ASSOC);
            header("Location: ../view/dashboard.php");
        } else {
            echo "Usuário ou senha incorretos!";
        }
    }
}