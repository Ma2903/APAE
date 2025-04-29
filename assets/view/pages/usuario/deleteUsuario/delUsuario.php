<?php
require_once __DIR__ . "/../../../../controller/userController.php";

$controler = new ControladorUsuarios();

if (isset($_GET['id'])) {
    $controler->deleteUsuario($_GET['id']);
    header('Location: ../listarUsuario/listarUsuario.php');
    exit();
}
?>