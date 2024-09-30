<?php
    require_once __DIR__ . "/../../../../controller/produtoController.php";
    $controler = new ControladorProdutos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo-container">
            <img src="../../../../../src/logo0.jpg" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </div>
        <div class="user-info">
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </div>
</header>
<main>
    <h1>Editar Produto</h1>
    <form action="" method="post">
        <div>
            <label for="produto_id">Selecione o Produto:</label>
            <?php
                echo '<input id="produto_id" name="produto_id" required disabled value="'.$_GET['id'].'">';
            ?>
        </div>
        <?php
            $produtos = $controler->verProdutos();
            foreach ($produtos as $produto){
                if($produto->getId() == $_GET['id']){
                    echo '
                    <div>
                        <label for="nome">Nome do Produto:</label>
                        <input type="text" id="nome" name="nome" required value="'.$produto->getNome().'">
                    </div>
                    <div>
                    <label for="categoria">Categoria:</label>
                    <select type="text" id="categoria" name="categoria" required>
                        <option value="Verduras"';if($produto->getCategoria() == "Verduras") echo ' selected';echo'>Verduras</option>
                        <option value="Higiene Pessoal"';if($produto->getCategoria() == "Higiene Pessoal") echo ' selected';echo'>Higiene Pessoal</option>
                        <option value="Açougue"';if($produto->getCategoria() == "Açougue") echo ' selected';echo'>Açougue</option>
                        <option value="Limpeza"';if($produto->getCategoria() == "Limpeza") echo ' selected';echo'>Limpeza</option>
                        <option value="Descartáveis"';if($produto->getCategoria() == "Descartáveis") echo ' selected';echo'>Descartáveis</option>
                        <option value="Frios"';if($produto->getCategoria() == "Frios") echo ' selected';echo'>Frios</option>
                        <option value="Outros"';if($produto->getCategoria() == "Outros") echo ' selected';echo'>Outros</option>
                    </select>
                    </div>
                    <div>
                    <label for="unidade_medida">Unidade de Medida:</label>
                    <select type="text" id="unidade_medida" name="unidade_medida" required>
                        <option value="CX"';if($produto->getUn() == "CX") echo ' selected'; echo '>CX</option>
                        <option value="UN"';if($produto->getUn() == "UN") echo ' selected'; echo '>UN</option>
                        <option value="KG"';if($produto->getUn() == "KG") echo ' selected'; echo '>KG</option>
                        <option value="SC"';if($produto->getUn() == "SC") echo ' selected'; echo '>SC</option>
                    </select>
                    </div>';
                }
            }
        ?>
        <div>
            <button type="submit">Salvar Alterações</button>
        </div>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Verifica se todos os campos estão preenchidos
                if (!empty($_POST['nome']) && !empty($_POST['categoria']) && !empty($_POST['unidade_medida'])) {
                    $controler->editarProdutos($_GET['id'],$_POST['nome'],$_POST['categoria'],$_POST['unidade_medida']);
                    header('Location: ../index.php');
                } else {
                    echo '<p>Por favor, preencha todos os campos.</p>';
                }
            }
        ?>
    </form>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>