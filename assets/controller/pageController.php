<?php
function renderHeader() {
    echo '
<header>
    <section class="header-container">
        <section class="logo-container">
            <img src="../../../../../src/logo_sem_fundo.png" alt="Logo do SmartControl" class="logo">
            <h1 class="system-name">SmartControl</h1>
        </section>
        <section class="user-info">
        <a href="../../principal/principal.php" class="home-btn"> Home <i class="fas fa-home"></i></a>
            <a href="../../logout.php" class="logout-btn"> Sair <i class="fas fa-door-open"></i></a>
        </section>
    </section>
</header>
';
}

function renderFooter() {
    echo '
    <footer>
        <p>SmartControl - Sistema de Gerenciamento de Cotações e Cardápios</p>
    </footer>
</body>
</html>
';
}
?>