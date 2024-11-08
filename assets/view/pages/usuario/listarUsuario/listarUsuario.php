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
    <link rel="stylesheet" href="../../styles/ListarStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1>Listar Usuários</h1>
    <section class="search">
        <input type="text" id="search-input" name="search" placeholder="Pesquisar usuários..." onkeyup="searchUsers()">
        <section class="add-user">
            <a href="../cadastroUsuario/register_user.php" class="add-user-btn">Cadastrar Novo Usuário</a>
        </section>
        <section class="filter">
            <button class="filter-btn" onclick="toggleFilterMenu()">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <section class="filter-menu" id="filter-menu">
                <button onclick="filterUsers('contador')">Contadores</button>
                <button onclick="filterUsers('nutricionista')">Nutricionistas</button>
                <button onclick="filterUsers('administrador')">Administradores</button>
                <button class="close-filter" onclick="clearFilter()"><i class="fas fa-times"></i></button>
            </section>
        </section>
    </section>
    <section class="legend">
        <span>Legenda: </span>
        <section class="legend-item">
            <div class="legend-color legend-nutricionista"></div>
            <span>Nutricionista</span>
        </section>
        <section class="legend-item">
            <div class="legend-color legend-contador"></div>
            <span>Contador</span>
        </section>
        <section class="legend-item">
            <div class="legend-color legend-administrador"></div>
            <span>Administrador</span>
        </section>
    </section>
    <table>
        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Data de Nascimento</th>
                <th>Email</th>
                <th>Tipo de Usuário</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody id="user-table-body">
        <?php
            $usuarios = $controler->listarUsuarios();
            // Ordenar usuários em ordem alfabética pelo nome
            usort($usuarios, function($a, $b) {
                return strcmp($a->getNome(), $b->getNome());
            });

            if ($usuarios) {
                foreach ($usuarios as $usuario) {
                    $classeUsuario = '';
                    $idUsuario = '';
                    
                    switch ($usuario->getTipoUsuario()) {
                        case 'administrador':
                            $classeUsuario = 'administrador';
                            $idUsuario = 'usuario-administrador';
                            break;
                        case 'nutricionista':
                            $classeUsuario = 'nutricionista';
                            $idUsuario = 'usuario-nutricionista';
                            break;
                        case 'contador':
                            $classeUsuario = 'contador';
                            $idUsuario = 'usuario-contador';
                            break;
                    }
                    
                    echo "<tr class='{$classeUsuario}' id='{$idUsuario}'>";
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
                echo "<tr><td colspan='8'>Nenhum usuário cadastrado</td></tr>";
            }
        ?>
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
<script>
    function toggleFilterMenu() {
    const filterMenu = document.getElementById('filter-menu');
    filterMenu.classList.toggle('show');
}

function filterUsers(type) {
    const rows = document.querySelectorAll('#user-table-body tr');
    rows.forEach(row => {
        const userType = row.querySelector('td:nth-child(6)').textContent.toLowerCase(); // Coluna "Tipo de Usuário"
        if (userType.includes(type.toLowerCase())) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function clearFilter() {
    const rows = document.querySelectorAll('#user-table-body tr');
    rows.forEach(row => {
        row.style.display = '';
    });
    const filterMenu = document.getElementById('filter-menu');
    filterMenu.classList.remove('show');
}

document.getElementById('search-input').addEventListener('input', function() {
        const filterValue = this.value;
        if (filterValue) {
            filterUsers(filterValue);
        } else {
            clearFilter();
        }
    });

function searchUsers() {
    const searchInput = document.getElementById('search-input').value.toLowerCase();
    const rows = document.querySelectorAll('#user-table-body tr');
    rows.forEach(row => {
        const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Nome está na segunda coluna
        if (userName.startsWith(searchInput)) { // Verifica se o nome começa com a letra digitada
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
</body>
</html>