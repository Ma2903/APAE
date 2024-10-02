<?php 
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../global.php";
$controler = new ControladorUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>
    <section class="header-container">
        <section class="logo-container">
            <img src="../../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </section>
        <section class="user-info">
            <a href="../../principal.php" class="home-btn">Home</a>
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
    <h1>Listar Usuários</h1>
    <section class="search">
        <input type="text" name="search" placeholder="Pesquisar usuários...">
        <button type="submit">Pesquisar</button>
        <section class="add-user">
            <a href="../cadastroUsuario/register_user.php" class="add-user-btn">Cadastrar Novo Usuário</a>
        </section>
    </section>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Data de Nascimento</th>
                <th>Email</th>
                <th>Tipo de Usuário</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
                    <?php
            $usuarios = $controler->listarUsuarios();
            if ($usuarios) {
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>{$usuario->getId()}</td>";
                    echo "<td>{$usuario->getCpf()}</td>";
                    echo "<td>{$usuario->getNome()}</td>";
                    echo "<td>{$usuario->getSobrenome()}</td>";
                    echo "<td>".converterDataParaBR($usuario->getDataNasc())."</td>";
                    echo "<td>{$usuario->getEmail()}</td>";
                    echo "<td>{$usuario->getTipoUsuario()}</td>";
                    echo "<td><a href='../editarUsuario/editUsuario.php?id={$usuario->getId()}'>Editar</a></td>";
                    echo "<td><a href='../deleteUsuario/delUsuario.php?id={$usuario->getId()}'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr></tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>