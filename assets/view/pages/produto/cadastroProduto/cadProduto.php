<?php
    require_once __DIR__ . "/../../../../controller/produtoController.php";
    $controler = new ControladorProdutos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<header>
        <section class="header-container">
            <section class="logo-container">
            <img src="../../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
                <h1 class="system-name">SmartControl</h1>
            </section>
            <section class="user-info">
            <a href="../../principal.php" class="home-btn">Home</a>
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
        </section>
    </header>
<body>
    <main>
    <a href="../listarProduto/listarProduto.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
        <h1>Cadastro de Produto</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $categoria = $_POST['categoria'];
            $unidade_medida = $_POST['unidade_medida'];
            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao = date("Y-m-d H:i:s");

            if (!empty($nome) && !empty($categoria) && !empty($unidade_medida) && !empty($data_criacao)) {
                $controler->cadastrarProdutos($nome, $categoria, $unidade_medida, $data_criacao);
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
                <option value="Outros">Outros</option>
            </select>
            </section>
            <section>
            <label for="unidade_medida">Unidade de Medida:</label>
            <select id="unidade_medida" name="unidade_medida" required>
                <option value="CX">CX</option>
                <option value="UN">UN</option>
                <option value="KG">KG</option>
                <option value="SC">SC</option>
            </select>
            </section>
            <section>
            <button type="submit">Cadastrar Produto</button>
            </section>
        </form>
    </main>
    <footer>
        <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
    </footer>
</body>
</html>