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
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../styles/CadStyle.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <a href="../listarProduto/listarProduto.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1><i class="fas fa-box"></i> Cadastro de Produto</h1>
    <form action="" method="post">
        <section>
            <label for="nome"><i class="fas fa-tag"></i> Nome do Produto:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome do Produto" required>
        </section>
        <section>
            <label for="categoria"><i class="fas fa-list"></i> Categoria:</label>
            <select id="categoria" name="categoria" required>
                <option value="Frutas">Frutas</option>
                <option value="Verduras">Verduras</option>
                <option value="Higiene Pessoal">Higiene Pessoal</option>
                <option value="Açougue">Açougue</option>
                <option value="Limpeza">Limpeza</option>
                <option value="Descartáveis">Descartáveis</option>
                <option value="Frios">Frios</option>
                <option value="Alimenticios">Alimentícios</option>
                <option value="Outros">Outros</option>
            </select>
        </section>
        <section>
            <label for="un"><i class="fas fa-balance-scale"></i> Unidade de Medida:</label>
            <select id="un" name="un" required>
                <option value="CX">Caixa (CX)</option>
                <option value="UN">Unidade (UN)</option>
                <option value="KG">Quilograma (KG)</option>
                <!-- <option value="MC">Metro Cúbico (MC)</option> -->
                <option value="SC">Saco (SC)</option>
                <option value="BDJ">Balde (BDJ)</option>
                <option value="CBÇ">Cabeça (CBÇ)</option>
            </select>
        </section>
        <button type="submit"><i class="fas fa-save"></i> Cadastrar Produto</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $categoria = $_POST['categoria'];
            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao = date("Y-m-d H:i:s");

            if (!empty($nome) && !empty($categoria)) {
                $controler->cadastrarProdutos($nome, $categoria, $un, $data_criacao);
                header("Location: ../listarProduto/listarProduto.php");
            } else {
                echo "<p>Por favor, preencha todos os campos.</p>";
            }
        }
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>