<?php
    require_once __DIR__ . '/../../../../controller/cardapioController.php';
    require_once __DIR__ . "/../../../../controller/userController.php";
    require_once __DIR__ . "/../../../../controller/cotacaoController.php";
    require_once __DIR__ . "/../../../../controller/pageController.php";
    require_once __DIR__ . "/../../../../model/utils.php";
    session_start();
    
    $user = $_SESSION['user'];
    $tipo_usuario = $user->getTipoUsuario();

    if(!isset($user)){
        header("Location: index.php");
    }
    $podeGerenciarCardapios = verificarPermissao($tipo_usuario, 'gerenciar_cardapios');

    $cardapioController = new cardapioController();
    $cotacaoController = new ControladorCotacao();
    $controladorUsuario = new ControladorUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cardápios</title>
    <link rel="stylesheet" href="../../styles/ListarStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
   <style>
        .close-btn{
            text-align: center;
            height: 50px;
            padding: 12px 20px;
            background-color: var(--darkblue);
            color: var(--white);
            border: none;
            border-radius: 0px 8px 8px 0px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
        }

        table th, table td{
            padding: 15px;
            white-space: nowrap;
        }



        .folder-content{
            display: block;
        }
        .folder{
            background-color: var(--darkblue);
            color: var(--white);
        }
    </style>
</head>
<body>
    <?php renderHeader(); ?>
    <main>
        <h1>Listar Cardápios</h1>
        <section class="search">
            <input type="text" id="search-input" name="search" placeholder="Pesquisar produtos...">
        <section class="add-user">
        <?php if ($podeGerenciarCardapios): ?>
            <a href="../cadastrarCardapio/cadCardapio.php" class="add-user-btn">Cadastrar Cardápio</a>
        <?php endif; ?>
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
        <table>
            <tbody>
                <?php 
                if ($cardapioController) {
                    $cardapios = $cardapioController->listarcardapios();
                    usort($cardapios, function($a, $b) {
                        return strtotime($b->getDataC()) - strtotime($a->getDataC());
                    });
                    foreach ($cardapios as $cardapio) {
                        $id = 'folder' . $cardapio->getId();
                        echo "<tbody>";
                        echo "<tr class='folder'>";
                        echo "<td colspan='6' onclick='openFolder(\"{$id}\")'><h2>{$cardapio->getDataC()}</h2></td>";
                        echo "<td class='close-btn' onclick='closeFolder(\"{$id}\")' style='display: none;'>Fechar</td>";
                        echo "</tr>";
                        echo "<td colspan='7' class='folder-content'>";
                        echo "<table>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Nutricionista</th>";
                        echo "<th>Período</th>";
                        echo "<th>Descrição</th>";
                        if ($podeGerenciarCardapios) {
                            echo "<th colspan='2'>Ações</th>";
                        }
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>{$cardapio->getId()}</td>";
                        echo "<td>{$cardapioController->getNutricionistaNome($cardapio->getNutricionistaId())}</td>";
                        echo "<td>{$cardapio->getPeriodo()}</td>";
                        echo "<td>{$cardapio->getDescricao()}</td>";
                        if ($podeGerenciarCardapios) {
                            echo "<td><a href='../editarCardapio/editCardapio.php?id={$cardapio->getId()}&nutricionista_id={$cardapio->getNutricionistaId()}' class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                            echo "<td><a href='#' onclick='confirmDelete({$cardapio->getId()}, \"{$cardapio->getDescricao()}\")' class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
                        }
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='7'><ul>";
                        $produtinhos = $cotacaoController->verCadProdutos($cardapio->getId());
                        var_dump($produtinhos);
                        foreach($produtinhos as $produtoes){
                            echo '<li>' .$produtoes . '</li>';
                        }
                        echo "</ul></td>";
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";
                        echo "</td>";
                        echo "</tbody>";
                    }
                } 
                else {
                    echo "<tr><td colspan='7'>Nenhum cardápio encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php renderFooter(); ?>
    <script>
        
        function openFolder(id) {
            let folder = document.getElementById('folder');
            let folderContent = document.querySelector('#folder' + id);
            let closeBtn = document.querySelector('.close-btn');
            folderContent.style.display = 'block';
            closeBtn.style.display = 'block';
            console.log(folderContent);
            console.log(id);
        }
        
        function closeFolder(id) {
            let folder = document.getElementById('folder');
            let folderContent = document.querySelector('#folder' + id);
            let closeBtn = document.querySelector('.close-btn');
            folderContent.style.display = 'none';
            closeBtn.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
        const logoutButton = document.querySelector('a[href="../../logout.php"]'); // Caminho ajustado
        if (logoutButton) {
            logoutButton.addEventListener('click', (event) => {
                event.preventDefault();
                Swal.fire({
                    title: 'Deseja realmente sair?',
                    text: "Você será desconectado do sistema.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, sair',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = logoutButton.href;
                    }
                });
            });
        }
    });

    function confirmDelete(cardapioId, cardapioDescricao) {
        Swal.fire({
            title: `Deseja realmente excluir o cardápio "${cardapioDescricao}"?`,
            text: "Digite 'DELETAR' para confirmar.",
            input: 'text',
            inputPlaceholder: 'Digite DELETAR',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (value !== 'DELETAR') {
                    return 'Você precisa digitar "DELETAR" para confirmar!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireciona para o script de exclusão
                window.location.href = `../deleteCardapio/delCardapio.php?id=${cardapioId}`;
            }
        });
    }
    </script>
</body>
</html>