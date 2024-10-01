<?php
    require_once __DIR__ . "/../../../../controller/fornecedorController.php";
    $controler = new ControladorFornecedor();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <!-- <span><?php echo htmlspecialchars($user['nome']); ?></span> -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </section>
    </section>
</header>
<main>
<a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h2>Cadastrar Fornecedor</h2>
    <form action="" method="POST">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = $_POST['nome'];
                $endereco = $_POST['endereco'];
                $telefone = $_POST['telefone'];
                $whatsapp = $_POST['whatsapp'];
                $email = $_POST['email'];
                $ramo_atuacao = $_POST['ramo_atuacao'];
                date_default_timezone_set('America/Sao_Paulo');
                $data_criacao = date("Y-m-d H:i:s");

                if (!empty($nome) && !empty($endereco) && !empty($telefone) && !empty($whatsapp) && !empty($email) && !empty($ramo_atuacao)) {
                    $controler->cadastrarFornecedor($nome, $endereco, $telefone, $whatsapp, $email, $ramo_atuacao ,$data_criacao);
                    header("Location: ../listarFornecedores/listarFornecedores.php");
                }
            }
        ?>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco">
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone">
        <label for="whatsapp">WhatsApp:</label>
        <input type="text" name="whatsapp">
        <label for="email">E-mail:</label>
        <input type="email" name="email">
        <label for="ramo_atuacao">Ramo de Atuação:</label>
        <input type="text" name="ramo_atuacao">
        <button type="submit">Cadastrar</button>
    </form>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>