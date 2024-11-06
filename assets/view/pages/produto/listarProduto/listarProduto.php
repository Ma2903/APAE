<?php
    require_once __DIR__ . "/../../../../controller/produtoController.php";
    require_once __DIR__ . "/../../../../controller/userController.php";
    require_once __DIR__ . "/../../../../controller/pageController.php";
    require_once __DIR__ . "/../../../../model/utils.php"; 
    session_start();

    $controler = new ControladorProdutos();
    $user = $_SESSION['user'];
    $tipo_usuario = $user->getTipoUsuario();

    if(!isset($user)){
        header("Location: index.php");
    }

    $podeGerenciarProdutos = verificarPermissao($tipo_usuario, 'gerenciar_produtos');
?>
    
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos</title>
    <link rel="stylesheet" href="../../styles/ListarStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1>Listar Produtos</h1>
        <section class="search">
            <input type="text" name="search" placeholder="Pesquisar produtos...">
            <button type="submit">Pesquisar</button>
            <section class="add-product">
            <?php if ($podeGerenciarProdutos): ?>
                <a href="../cadastroProduto/cadProduto.php" class="add-product-btn">Cadastrar Novo Produto</a>
                <?php endif; ?>
            </section>
    </section>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Unidade de Medida</th>
                <th>Data de Criação</th>
                <?php if ($podeGerenciarProdutos): ?>
                <th colspan="2">Ações</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $produtos = $controler->verProdutos();
            //TERMINAR DEPOIS
            //if ($_SERVER["REQUEST_METHOD"] == "POST"){
              //  var_dump($produtos);
                //$like = $search = $_POST['search'];
                // if($search != ""){
                    
                // }
            //}
            if ($controler->verProdutos()) {
                foreach ($produtos as $produto) {
                    echo "<tr>";
                    echo "<td>{$produto->getId()}</td>";
                    echo "<td>{$produto->getNome()}</td>";
                    echo "<td>{$produto->getCategoria()}</td>";
                    echo "<td>{$produto->getUn()}</td>";
                    echo "<td>{$produto->getDtCriacao()}</td>";
                    if ($podeGerenciarProdutos) {
                        echo "<td> <a href='../editarProduto/editProduto.php?id={$produto->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar</a> </td>";
                        echo "<td> <a href='../deleteProduto/delProduto.php?id={$produto->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar</a> </td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr></tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
</body>
</html>