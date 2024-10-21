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
    <title>Lista de Fornecedores</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1>Lista de Fornecedores</h1>
    <section class="search">
        <input type="text" name="search" placeholder="Pesquisar fornecedores...">
        <button type="submit">Pesquisar</button>
        <section class="add-product">
            <a href="../cadastroFornecedores/cadFornecedores.php" class="add-product-btn">Cadastrar Novo Fornecedor</a>
        </section>
    </section>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>WhatsApp</th>
                <th>E-mail</th>
                <th>Ramo de Atuação</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($controler->verFornecedor()) {
                $fornecedores = $controler->verFornecedor();
                foreach ($fornecedores as $fornecedor) {
                    echo "<tr>";
                    echo "<td>{$fornecedor->getId()}</td>";
                    echo "<td>{$fornecedor->getNome()}</td>";
                    echo "<td>{$fornecedor->getEndereco()}</td>";
                    echo "<td>{$fornecedor->getTelefone()}</td>";
                    echo "<td>{$fornecedor->getWhatsapp()}</td>";
                    echo "<td>{$fornecedor->getEmail()}</td>";
                    echo "<td>{$fornecedor->getRamo()}</td>";
                    echo "<td><a href='../editarFornecedores/editFornecedores.php?id={$fornecedor->getId()}'>Editar</a></td>";
                    echo "<td><a href='../deleteFornecedores/delFornecedores.php?id={$fornecedor->getId()}'>Deletar</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
</body>
</html>