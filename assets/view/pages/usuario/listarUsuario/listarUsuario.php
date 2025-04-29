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
    <h1> <i class="fas fa-users"></i> Listar Usuários</h1>
    <section class="search">
        <input type="text" id="search-input" name="search" placeholder="Pesquisar usuários..." onkeyup="searchUsers()">
        <section class="add-user">
            <href="../cadastroUsuario/register_user.php" class="add-user-btn"> <i class="fas fa-users"></i> Cadastrar Novo Usuário</a>
        </section>
        <section class="filter">
            <label for="tipo-usuario" class="filter-label">Filtrar por Tipo de Usuário:</label>
            <select id="tipo-usuario" name="tipo-usuario" onchange="filterUsersBySelect()" aria-label="Filtrar usuários por tipo">
                <option value="">Todos</option>
                <option value="administrador">Administrador</option>
                <option value="nutricionista">Nutricionista</option>
                <option value="contador">Adm Compras</option>
            </select>
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
            <span>Adm Compras</span>
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
                    $iconeUsuario = '';
                    switch ($usuario->getTipoUsuario()) {
                        case 'administrador':
                            $classeUsuario = 'administrador';
                            $iconeUsuario = '<i class="fas fa-user-shield"></i>'; // Ícone para Administrador
                            break;
                        case 'nutricionista':
                            $classeUsuario = 'nutricionista';
                            $iconeUsuario = '<i class="fas fa-utensils"></i>'; // Ícone para Nutricionista
                            break;
                        case 'contador':
                            $classeUsuario = 'contador';
                            $iconeUsuario = '<i class="fas fa-calculator"></i>'; // Ícone para Adm Compras
                            break;
                    }
                    $tipo = $usuario->getTipoUsuario() === "contador" ? 'Adm Compras' : ucfirst($usuario->getTipoUsuario());
                    echo "<tr class='{$classeUsuario}'>";
                    echo "<td>{$usuario->getCpf()}</td>";
                    echo "<td>{$usuario->getNome()}</td>";
                    echo "<td>{$usuario->getSobrenome()}</td>";
                    echo "<td>".converterDataParaBR($usuario->getDataNasc())."</td>";
                    echo "<td>{$usuario->getEmail()}</td>";
                    echo "<td>{$iconeUsuario} {$tipo}</td>";
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
function filterUsersBySelect() {
    const select = document.getElementById('tipo-usuario');
    const selectedValue = select.value.toLowerCase();
    const rows = document.querySelectorAll('#user-table-body tr');
    rows.forEach(row => {
        const userType = row.querySelector('td:nth-child(6)').textContent.toLowerCase(); // Coluna "Tipo de Usuário"
        if (selectedValue === "" || userType.includes(selectedValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
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