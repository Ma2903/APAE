<?php
require_once __DIR__ . "/../../../../controller/produtoController.php";
require_once __DIR__ . "/../../../../controller/pageController.php";
$controler = new ControladorProdutos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Produto</title>
<link rel="stylesheet" href="../../styles/EditStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarProduto/listarProduto.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
<h1>Editar Produto</h1>
<form action="" method="post">
    <section>
        <label for="produto_id">Id do Produto Escolhido:</label>
        <?php
            echo '<input id="produto_id" name="produto_id" required disabled value="'.$_GET['id'].'">';
        ?>
    </section>
    <?php
        $produtos = $controler->verProdutos();
        foreach ($produtos as $produto){
            if($produto->getId() == $_GET['id']){
                echo '
                <section>
                    <label for="nome">Nome do Produto:</label>
                    <input type="text" id="nome" name="nome" required value="'.$produto->getNome().'">
                </section>
                <section>
                <label for="categoria">Categoria:</label>
                <select type="text" id="categoria" name="categoria" required>
                    <option value="Verduras"';if($produto->getCategoria() == "Verduras") echo ' selected';echo'>Verduras</option>
                    <option value="Frutas"';if($produto->getCategoria() == "Frutas") echo ' selected';echo'>Frutas</option>
                    <option value="Higiene Pessoal"';if($produto->getCategoria() == "Higiene Pessoal") echo ' selected';echo'>Higiene Pessoal</option>
                    <option value="Açougue"';if($produto->getCategoria() == "Açougue") echo ' selected';echo'>Açougue</option>
                    <option value="Limpeza"';if($produto->getCategoria() == "Limpeza") echo ' selected';echo'>Limpeza</option>
                    <option value="Descartáveis"';if($produto->getCategoria() == "Descartáveis") echo ' selected';echo'>Descartáveis</option>
                    <option value="Frios"';if($produto->getCategoria() == "Frios") echo ' selected';echo'>Frios</option>
                    <option value="Outros"';if($produto->getCategoria() == "Outros") echo ' selected';echo'>Outros</option>
                </select>
                </section>
                <section>
                <label for="unidade_medida">Unidade de Medida:</label>
                <select type="text" id="unidade_medida" name="unidade_medida" required>
                    <option value="CX"';if($produto->getUn() == "CX") echo ' selected'; echo '>CX</option>
                    <option value="UN"';if($produto->getUn() == "UN") echo ' selected'; echo '>UN</option>
                    <option value="KG"';if($produto->getUn() == "KG") echo ' selected'; echo '>KG</option>
                    <option value="SC"';if($produto->getUn() == "SC") echo ' selected'; echo '>SC</option>
                </select>
                </section>';
            }
        }
    ?>
    <section>
        <button type="submit">Salvar Alterações</button>
    </section>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se todos os campos estão preenchidos
            if (!empty($_POST['nome']) && !empty($_POST['categoria']) && !empty($_POST['unidade_medida'])) {
                $controler->editarProdutos($_GET['id'],$_POST['nome'],$_POST['categoria'],$_POST['unidade_medida']);
                header('Location: ../listarProduto/listarProduto.php');
            } else {
                echo '<p>Por favor, preencha todos os campos.</p>';
            }
        }
    ?>
</form>
</main>
<?php renderFooter(); ?>
</body>
</html>