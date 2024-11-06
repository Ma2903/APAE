<?php
    require_once __DIR__ . "/../../../../controller/fornecedorController.php";
    require_once __DIR__ . "/../../../../controller/pageController.php";
    $controler = new ControladorFornecedor();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Fornecedor</title>
    <link rel="stylesheet" href="../../styles/DeleteStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Excluir Fornecedor</h1>
    <form method="POST" action="">
    <h3>Tem certeza que deseja excluir o seguinte fornecedor?</h3>
        <?php
        $fornecedores = $controler->verFornecedor();
        foreach ($fornecedores as $fornecedor){
            if($fornecedor->getId() == $_GET['id']){
            echo '
            <section>
            <label for="nome"><strong>Nome:</strong></label>
            <input type="text" id="nome" name="nome" value="' . htmlspecialchars($fornecedor->getNome()) . '" readonly>
            </section>
            <section>
            <label for="endereco"><strong>Endereço:</strong></label>
            <input type="text" id="endereco" name="endereco" value="' . htmlspecialchars($fornecedor->getEndereco()) . '" readonly>
            </section>
            <section>
            <label for="telefone"><strong>Telefone:</strong></label>
            <input type="text" id="telefone" name="telefone" value="' . htmlspecialchars($fornecedor->getTelefone()) . '" readonly>
            </section>
            <section>
            <label for="whatsapp"><strong>WhatsApp:</strong></label>
            <input type="text" id="whatsapp" name="whatsapp" value="' . htmlspecialchars($fornecedor->getWhatsapp()) . '" readonly>
            </section>
            <section>
            <label for="email"><strong>E-mail:</strong></label>
            <input type="text" id="email" name="email" value="' . htmlspecialchars($fornecedor->getEmail()) . '" readonly>
            </section>
            <section>
            <label for="ramo"><strong>Ramo de Atuação:</strong></label>
            <input type="text" id="ramo" name="ramo" value="' . htmlspecialchars($fornecedor->getRamo()) . '" readonly>
            </section>';
            }
        }
        ?>
        <button type="submit" name="confirmar">Confirmar Exclusão</button>
    </form>

    <?php
    if(isset($_POST['confirmar'])){
        $controler->deletarFornecedor($_GET['id']);
        header('Location: ../listarFornecedores/listarFornecedores.php');
    }
    
    ?>
</main>
<?php renderFooter(); ?>
</body>
</html>