<?php
require_once __DIR__ . "/../controller/userController.php";

function verificarPermissao($tipo_usuario, $acao) {
    $controler = new ControladorUsuarios();
    $permissoes = $controler->obterPermissoes($tipo_usuario);

    return isset($permissoes[$acao]) && $permissoes[$acao] == 1;
}
?>