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
            <a href="../../index.php" class="home-btn">Home</a>
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
    <h1>Listar Usuários</h1>
    <section class="search">
        <input type="text" name="search" placeholder="Pesquisar usuários...">
        <button type="submit">Pesquisar</button>
    </section>
    <section class="add-user">
        <a href="../cadastroUsuario/register_user.php" class="add-user-btn">Cadastrar Novo Usuário</a>
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
            // if ($usuarios) {
            //     foreach ($usuarios as $usuario) {
            //         echo "<tr>";
            //         echo "<td>{$usuario['id']}</td>";
            //         echo "<td>{$usuario['cpf']}</td>";
            //         echo "<td>{$usuario['nome']}</td>";
            //         echo "<td>{$usuario['sobrenome']}</td>";
            //         echo "<td>{$usuario['data_nascimento']}</td>";
            //         echo "<td>{$usuario['email']}</td>";
            //         echo "<td>{$usuario['tipo_usuario']}</td>";
                     echo "<td><a href='../editarUsuario/editUsuario.php?'>Editar</a></td>";
                     echo "<td><a href='../deleteUsuario/delUsuario.php?'>Deletar</a></td>";
            //         echo "</tr>";
            //     }
            // } else {
            //     echo "<tr><td colspan='9'>Nenhum usuário encontrado.</td></tr>";
            // }
            ?>
        </tbody>
    </table>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>