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
    <title>Editar Fornecedor</title>
    <link rel="stylesheet" href="../../styles/EditStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
<a href="../listarFornecedores/listarFornecedores.php" class="back-btn"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1>Editar Fornecedor</h1>
    <form action="" method="POST">
        <?php
            $fornecedores = $controler->verFornecedor();
            foreach($fornecedores as $fornecedor){
                if($fornecedor->getId() == $_GET['id']){
                echo ' 
                <input type="hidden" name="id" value="'.$fornecedor->getId().'">
                <section>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="'.$fornecedor->getNome().'" required>
                </section>
                <section>
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" value="'.$fornecedor->getEndereco().'">
                </section>
                <section>
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" value="'.$fornecedor->getTelefone().'">
                </section>
                <section>
                <label for="whatsapp">WhatsApp:</label>
                <input type="text" name="whatsapp" value="'.$fornecedor->getWhatsapp().'">
                </section>
                <section>
                <label for="email">E-mail:</label>
                <input type="email" name="email" value="'.$fornecedor->getEmail().'">
                </section>
                <section>
                <label for="ramo_atuacao">Ramo de Atuação:</label>
                <input type="text" name="ramo_atuacao" value="'.$fornecedor->getRamo().'">
                </section>';
                }
            }
        ?>
            <section>
            <button type="submit">Salvar Alterações</button>
            </section>
            <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(!empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['telefone']) && !empty($_POST['whatsapp']) && !empty($_POST['email']) && !empty($_POST['ramo_atuacao'])){
                $controler->editarFornecedor($_POST['id'], $_POST['nome'], $_POST['endereco'], $_POST['telefone'], $_POST['whatsapp'], $_POST['email'], $_POST['ramo_atuacao']);
                header('Location: ../listarFornecedores/listarFornecedores.php');
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