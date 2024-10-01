<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Fornecedor</title>
    <link rel="stylesheet" href="../style.css">
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
    <h2>Excluir Fornecedor</h2>
    
    <p>Tem certeza que deseja excluir o seguinte fornecedor?</p>
    
    <ul>
        <li><strong>ID:</strong> </li>
        <li><strong>Nome:</strong></li>
        <li><strong>Endereço:</strong> </li>
        <li><strong>Telefone:</strong> </li>
        <li><strong>WhatsApp:</strong> </li>
        <li><strong>E-mail:</strong> </li>
        <li><strong>Ramo de Atuação:</strong> </li>
    </ul>
    
    <form method="POST" action="">
        <button type="submit" name="confirmar">Confirmar Exclusão</button>
        <button type="submit" name="cancelar">Cancelar</button>
    </form>
</main>
<footer>
    <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
</footer>
</body>
</html>