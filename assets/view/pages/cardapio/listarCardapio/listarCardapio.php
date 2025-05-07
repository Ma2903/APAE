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
    <link rel="stylesheet" href="./customCardapio.css"> <!-- Novo arquivo CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body>
    <?php renderHeader(); ?>
    <main>
        <h1>Listar Cardápios</h1>
        <section class="search">
            <div>
                <section class="input-filter-date">
                    <label for="dataInicio"><i class="fas fa-calendar-alt"></i> Data Início:</label>
                    <input type="date" id="dataInicio" name="dataInicio" value="<?php echo $_GET['dataInicio'] ?? ''; ?>">
                </section>
                <section class="input-filter-date">
                    <label for="dataFim"><i class="fas fa-calendar-alt"></i> Data Fim:</label>
                    <div class="input-group">
                        <input type="date" id="dataFim" name="dataFim" value="<?php echo $_GET['dataFim'] ?? ''; ?>">
                        <button class="buttonLimpar" onclick="limparFiltros()">
                            <i class="fas fa-times"></i> Limpar Filtro
                        </button>
                    </div>
                </section>
            </div>
            <div class="right">
                <section class="add-user">
                    <?php if ($podeGerenciarCardapios): ?>
                        <a href="../cadastrarCardapio/cadCardapio.php" class="add-user-btn">
                            <i class="fas fa-plus"></i> Cadastrar Cardápio
                        </a>
                    <?php endif; ?>
                </section>
            </div>
        </section>
        <table>
            <tbody>
                <?php 
                if ($cardapioController) {
                    $cardapios = $cardapioController->listarcardapios();
                    usort($cardapios, function($a, $b) {
                        return strtotime($b->getDataC()) - strtotime($a->getDataC());
                    });

                    if (isset($_GET['dataInicio']) && isset($_GET['dataFim'])) {
                        $dataInicio = $_GET['dataInicio'];
                        $dataFim = $_GET['dataFim'];

                        $cardapios = array_filter($cardapios, function ($cardapio) use ($dataInicio, $dataFim) {
                            $dataCardapio = $cardapio->getDataC();
                            return $dataCardapio >= $dataInicio && $dataCardapio <= $dataFim;
                        });
                    }

                    foreach ($cardapios as $cardapio) {
                        $id = 'folder' . $cardapio->getId();
                        $dataFormatada = date("d/m/Y", strtotime($cardapio->getDataC())); // Formata a data para o formato brasileiro
                        echo "<tr class='folder' onclick='toggleFolder(\"{$id}\")'>";
                        echo "<td colspan='6'><h2>{$dataFormatada} <i class='fas fa-chevron-down'></i></h2></td>"; // Adiciona a setinha
                        echo "</tr>";
                        echo "<tr id='{$id}' class='folder-content'>";
                        echo "<td colspan='7'>";
                        echo "<table>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th><i class='fas fa-hashtag'></i> ID</th>";
                        echo "<th><i class='fas fa-user-md'></i> Nutricionista</th>";
                        echo "<th><i class='fas fa-clock'></i> Período</th>";
                        echo "<th><i class='fas fa-align-left'></i> Descrição</th>";
                        if ($podeGerenciarCardapios) {
                            echo "<th colspan='2'><i class='fas fa-tools'></i> Ações</th>";
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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum cardápio encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php renderFooter(); ?>
    <script>
        function openFolder(id) {
            let folderContent = document.querySelector('#folder' + id);
            let closeBtn = document.querySelector('.close-btn');
            folderContent.style.display = 'block';
            closeBtn.style.display = 'block';
            console.log(folderContent);
            console.log(id);
        }

        function closeFolder(id) {
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
                    window.location.href = `../deleteCardapio/delCardapio.php?id=${cardapioId}`;
                }
            });
        }

        function limparFiltros() {
            window.location.href = 'listarCardapio.php';
        }

        function filterByDate() {
            const dataInicio = document.querySelector("#dataInicio").value;
            const dataFim = document.querySelector("#dataFim").value;

            if (dataInicio && dataFim) {
                window.location.href = `listarCardapio.php?dataInicio=${dataInicio}&dataFim=${dataFim}`;
            }
        }

        document.querySelector("#dataFim").addEventListener("change", filterByDate);
        document.querySelector("#dataInicio").addEventListener("change", filterByDate);

        function toggleFolder(id) {
            const folderContent = document.getElementById(id);
            const icon = folderContent.previousElementSibling.querySelector('i');

            // Alterna a classe 'active' para abrir/fechar o conteúdo
            folderContent.classList.toggle('active');

            // Rotaciona a setinha
            if (folderContent.classList.contains('active')) {
                icon.style.transform = 'rotate(180deg)';
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>
</html>