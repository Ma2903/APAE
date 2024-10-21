<?php 
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
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
                    $classeUsuario = '';
                    switch ($usuario->getTipoUsuario()) {
                        case 'administrador':
                            $classeUsuario = 'usuario-administrador';
                            break;
                        case 'funcionario':
                            $classeUsuario = 'usuario-funcionario';
                            break;
                        case 'nutricionista':
                            $classeUsuario = 'usuario-nutricionista';
                            break;
                    }
                    echo "<tr class='{$classeUsuario}'>";
                    echo "<td>{$usuario->getId()}</td>";
                    echo "<td>{$usuario->getCpf()}</td>";
                    echo "<td>{$usuario->getNome()}</td>";
                    echo "<td>{$usuario->getSobrenome()}</td>";
                    echo "<td>".converterDataParaBR($usuario->getDataNasc())."</td>";
                    echo "<td>{$usuario->getEmail()}</td>";
                    echo "<td>{$usuario->getTipoUsuario()}</td>";
                    echo "<td><a href='../editarUsuario/editUsuario.php?id={$usuario->getId()}' class='acao-editar'><i class='fas fa-edit'></i> Editar</a></td>";
                    echo "<td><a href='../deleteUsuario/delUsuario.php?id={$usuario->getId()}' class='acao-deletar'><i class='fas fa-trash'></i> Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Nenhum usuário encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
</body>
</html>