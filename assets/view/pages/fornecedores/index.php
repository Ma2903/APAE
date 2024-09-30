<?php
require_once __DIR__ . "/../../../controller/fornecedorController.php";
$controler = new ControladorFornecedor();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Fornecedores</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Fornecedores</h2>
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
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aqui você deve adicionar o código PHP para listar os fornecedores -->
            <?php
            $fornecedores = $controler->verFornecedor(); // Função fictícia para obter fornecedores do banco de dados
            foreach ($fornecedores as $fornecedor) {
                echo "<tr>";
                echo "<td>{$fornecedor->getId()}</td>";
                echo "<td>{$fornecedor->getNome()}</td>";
                echo "<td>{$fornecedor->getEndereco()}</td>";
                echo "<td>{$fornecedor->getTelefone()}</td>";
                echo "<td>{$fornecedor->getWhatsapp()}</td>";
                echo "<td>{$fornecedor->getEmail()}</td>";
                echo "<td>{$fornecedor->getRamo()}</td>";
                echo "<td><a href='./editFornecedores/?id={$fornecedor->getId()}'>Editar</a></td>";
                echo "</tr>";
            }
            ?>
        <tbody>
        </tbody>
    </table>
</body>
</html>