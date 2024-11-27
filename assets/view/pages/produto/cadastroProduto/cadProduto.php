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
<?php renderHeader(); ?>
<body>
    <main>
    <a href="../listarProduto/listarProduto.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
        <h1>Cadastro de Produto</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $categoria = $_POST['categoria'];
            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao = date("Y-m-d H:i:s");

            if (!empty($nome) && !empty($categoria) && !empty($data_criacao)) {
                $controler->cadastrarProdutos($nome, $categoria, $data_criacao);
                header("Location: ../listarProduto/listarProduto.php");
            } else {
            echo "<p>Por favor, preencha todos os campos.</p>";
            }
        }
        ?>
        <form action="" method="post">
            <section>
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>
            </section>
            <section>
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <option value="Frutas">Frutas</option>
                <option value="Verduras">Verduras</option>
                <option value="Higiene Pessoal">Higiene Pessoal</option>
                <option value="Açougue">Açougue</option>
                <option value="Limpeza">Limpeza</option>
                <option value="Descartáveis">Descartáveis</option>
                <option value="Frios">Frios</option>
                <option value="Alimenticios">Alimenticios</option>
                <option value="Outros">Outros</option>
            </select>
            </section>
            <section>
            <button type="submit">Cadastrar Produto</button>
            </section>
        </form>
    </main>
    <?php renderFooter(); ?>
</body>
</html>