<?php
require_once __DIR__ . '/../../../../controller/cotacaoController.php';
require_once __DIR__ . '/../../../../controller/produtoController.php';
require_once __DIR__ . '/../../../../controller/fornecedorController.php';
require_once __DIR__ . "/../../../../controller/pageController.php";
require_once __DIR__ . "/../../../../controller/userController.php";
require_once __DIR__ . "/../../../../model/utils.php";
error_reporting(0);
session_start();

$controladorCotacao = new ControladorCotacao();
$controladorProduto = new ControladorProdutos();
$controladorFornecedor = new ControladorFornecedor();

$cotas = $controladorCotacao->verCotas();
// $cotasFiltradas = [];

$user = $_SESSION['user'];
$tipo_usuario = $user->getTipoUsuario();
$podeGerenciarCotacoes = verificarPermissao($tipo_usuario, 'gerenciar_cotacoes');

if(!isset($user)){
    header("Location: index.php");
}

// Função para calcular maior e menor preço por produto
function calcularMaiorMenorPreco($cotas) {
    $resultados = [];

    foreach ($cotas as $cotacao) {
        $produtoId = $cotacao->getProdutoId();
        $preco = $cotacao->getPrecoUnitario();
        $fornecedorId = $cotacao->getFornecedorId();

        if (!isset($resultados[$produtoId])) {
            $resultados[$produtoId] = [
                "maior_preco" => $preco,
                "menor_preco" => $preco,
                "fornecedor_maior" => $fornecedorId,
                "fornecedor_menor" => $fornecedorId
            ];
        } else {
            if ($preco > $resultados[$produtoId]["maior_preco"]) {
                $resultados[$produtoId]["maior_preco"] = $preco;
                $resultados[$produtoId]["fornecedor_maior"] = $fornecedorId;
            }
            if ($preco < $resultados[$produtoId]["menor_preco"]) {
                $resultados[$produtoId]["menor_preco"] = $preco;
                $resultados[$produtoId]["fornecedor_menor"] = $fornecedorId;
            }
        }
    }

    return $resultados;
}

$precos = calcularMaiorMenorPreco($cotas);

if(isset($_GET['dataInicio']) && isset($_GET['dataFim'])){
    foreach($cotas as $cota){
        $dataDaCota = new DateTime($cota->getDataCotacao());
        $dataInicio = new DateTime($_GET['dataInicio']);
        $dataFim = new DateTime($_GET['dataFim']);

        if($dataDaCota >= $dataInicio && $dataDaCota <= $dataFim){
            $cotasFiltradas[] = $cota;
        }
    }
}

if($_GET['comSem'] && $_GET['fimSem']){
    foreach($cotas as $cota){
        $dataDaCota = new DateTime($cota->getDataCotacao());
        $dataInicio = new DateTime($_GET['comSem']);
        $dataFim = new DateTime($_GET['fimSem']);

        if($dataDaCota >= $dataInicio && $dataDaCota <= $dataFim){
            $cotasAtuais[] = $cota;
            unset($cotas[array_search($cota, $cotas)]);
        }
    }
};

function construirTabelas($cotas) {
    $semanas = [];

    foreach ($cotas as $cota) {
        $dataCotacao = new DateTime($cota->getDataCotacao());
        $semanaInicio = clone $dataCotacao;
        $semanaInicio->modify('monday this week');
        $semanaFim = clone $semanaInicio;
        $semanaFim->modify('sunday this week');

        $semana = $semanaInicio->format("d/m/Y") . " a " . $semanaFim->format("d/m/Y");

        if (!isset($semanas[$semana])) {
            $semanas[$semana] = [];
        }

        $semanas[$semana][] = $cota;
    }

    foreach ($semanas as $semana => $cotasDaSemana) {
        echo "<h2>Semana: $semana</h2>";
        echo "<table border='1'>";
        echo '
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>DataCotação</th>
                <th>Preços (Maior | Menor)</th>
                <th>Fornecedores (Maior | Menor)</th>
                <?php if ($podeGerenciarCotacoes): ?>
                <th colspan="2">Ações</th>
                <?php endif; ?>
            </tr>
        </thead>';
        foreach ($cotasDaSemana as $cotacao) {
            $produtoId = $cotacao->getProdutoId();
            $fornecedorId = $cotacao->getFornecedorId();

            $controladorProduto = new ControladorProdutos();
            $controladorFornecedor = new ControladorFornecedor();

            $produtoNome = '';
            $fornecedorNome = '';

            $user = $_SESSION['user'];
            $tipo_usuario = $user->getTipoUsuario();
            $podeGerenciarCotacoes = verificarPermissao($tipo_usuario, 'gerenciar_cotacoes');

            $precosFiltrados = calcularMaiorMenorPreco($cotasDaSemana);

            $maiorPreco = $precosFiltrados[$produtoId]['maior_preco'];
            $menorPreco = $precosFiltrados[$produtoId]['menor_preco'];
            $fornecedorMaiorPreco = $controladorFornecedor->verFornecedorPorId($precosFiltrados[$produtoId]['fornecedor_maior'])->getNome();
            $fornecedorMenorPreco = $controladorFornecedor->verFornecedorPorId($precosFiltrados[$produtoId]['fornecedor_menor'])->getNome();

            foreach ($controladorProduto->verProdutos() as $produto) {
                if ($produtoId == $produto->getId()) {
                    $produtoNome = $produto->getNome();
                }
            }

            foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                if ($fornecedorId == $fornecedor->getId()) {
                    $fornecedorNome = $fornecedor->getNome();
                }
            }

            // Formatar a data para o formato brasileiro
            $dataCotacao = date("d/m/Y", strtotime($cotacao->getDataCotacao()));

            echo "<tr>";
            echo "<td>{$produtoNome}</td>";
            echo "<td>{$dataCotacao}</td>";
            echo "<td>R$ <span class='maior-preco'>{$maiorPreco} ↑</span> | R$ <span class='menor-preco'>{$menorPreco} ↓</span></td>";
            echo "<td> <span class='maior-preco'>{$fornecedorMaiorPreco} ↑</span> | <span class='menor-preco'>{$fornecedorMenorPreco} ↓</span></td>";
            if ($podeGerenciarCotacoes) {
                echo "<td> <a href='../editarCotacoes/editCotacoes.php?id={$cotacao->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                echo "<td> <a href='../deletarCotacoes/delCotacoes.php?id={$cotacao->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
}

$precosFiltrados = calcularMaiorMenorPreco($cotasAtuais);

if(isset($cotasFiltradas)){
    $precosFiltradosFiltro = calcularMaiorMenorPreco($cotasFiltradas);
}

if(isset($_GET['dataInicio']) && isset($_GET['dataFim']) && $cotasFiltradas == null){
    echo "<script>function updatefiltros(){filtrosnulos = true}</script>";
}

if(!isset($cotasAtuais)){
    echo "<script>function updatenaoexiste(){naoexistecotasatuais = true}</script>";
}else{
    echo "<script>function updatenaoexiste(){naoexistecotasatuais = false}</script>";
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cotações</title>
    <link rel="stylesheet" href="../../styles/ListarStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php renderHeader(); ?>
<main>
    <h1>Listar Cotações</h1>
    <section class="search">
        <?php if ($podeGerenciarCotacoes): ?>
            <section class="add-quote">
                <a href="../cadastrarCotacoes/cadCotacoes.php" class="add-quote-btn">Cadastrar Nova Cotação</a>
            </section>
                <?php endif; ?>
            <section class="input-filter-date">
                <label for="dataInicio">Data Início:</label>
                <input type="date" id="dataInicio" name="dataInicio">
            </section>
            <section class="input-filter-date">
                <label for="dataFim">Data Fim:</label>
                <input type="date" id="dataFim" name="dataFim">
            </section>
    </section>
    <table>
        <thead>
            <?php if (isset($cotasFiltradas)): ?>
                <section class="section-cotasfiltradas">
                    <h1 class="table-title">Cotas Filtradas</h1>
                    <button onclick="limparfiltros()">Limpar Filtro</button>
                </section>
            <?php endif; ?> 
            <?php if (!isset($cotasFiltradas)): ?>
                <h1 class="table-title">Semana Atual</h1>
            <?php endif; ?>
            <tr>
                <th>Nome do Produto</th>
                <th>DataCotação</th>
                <th>Preços (Maior | Menor)</th>
                <th>Fornecedores (Maior | Menor)</th>
                <?php if ($podeGerenciarCotacoes): ?>
                <th colspan="2">Ações</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="tablecotacaoatual">
            <?php
            if(isset($cotasFiltradas)){
                foreach ($cotasFiltradas as $cotacao) {
                    $produtoId = $cotacao->getProdutoId();
                    $fornecedorId = $cotacao->getFornecedorId();
                    $produtoNome = '';
                    $fornecedorNome = '';
    
                    foreach ($controladorProduto->verProdutos() as $produto) {
                        if ($produtoId == $produto->getId()) {
                            $produtoNome = $produto->getNome();
                        }
                    }
    
                    foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                        if ($fornecedorId == $fornecedor->getId()) {
                            $fornecedorNome = $fornecedor->getNome();
                        }
                    }
    
                    $maiorPreco = $precosFiltradosFiltro[$produtoId]['maior_preco'];
                    $menorPreco = $precosFiltradosFiltro[$produtoId]['menor_preco'];
                    $fornecedorMaiorPreco = $controladorFornecedor->verFornecedorPorId($precosFiltradosFiltro[$produtoId]['fornecedor_maior'])->getNome();
                    $fornecedorMenorPreco = $controladorFornecedor->verFornecedorPorId($precosFiltradosFiltro[$produtoId]['fornecedor_menor'])->getNome();
    
                    // Formatar a data para o formato brasileiro
                    $dataCotacao = date("d/m/Y", strtotime($cotacao->getDataCotacao()));
    
                    echo "<tr>";
                    echo "<td>{$produtoNome}</td>";
                    echo "<td>{$dataCotacao}</td>";
                    echo "<td>R$ <span class='maior-preco'>{$maiorPreco} ↑</span> | R$ <span class='menor-preco'>{$menorPreco} ↓</span></td>";
                    echo "<td> <span class='maior-preco'>{$fornecedorMaiorPreco} ↑</span> | <span class='menor-preco'>{$fornecedorMenorPreco} ↓</span></td>";
                    if ($podeGerenciarCotacoes) {
                        echo "<td> <a href='../editarCotacoes/editCotacoes.php?id={$cotacao->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                        echo "<td> <a href='../deletarCotacoes/delCotacoes.php?id={$cotacao->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
                    }
                    echo "</tr>";
                }
            }else{
                foreach ($cotasAtuais as $cotacao) {
                    $produtoId = $cotacao->getProdutoId();
                    $fornecedorId = $cotacao->getFornecedorId();
                    $produtoNome = '';
                    $fornecedorNome = '';
    
                    foreach ($controladorProduto->verProdutos() as $produto) {
                        if ($produtoId == $produto->getId()) {
                            $produtoNome = $produto->getNome();
                        }
                    }
    
                    foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                        if ($fornecedorId == $fornecedor->getId()) {
                            $fornecedorNome = $fornecedor->getNome();
                        }
                    }
    
                    $maiorPreco = $precosFiltrados[$produtoId]['maior_preco'];
                    $menorPreco = $precosFiltrados[$produtoId]['menor_preco'];
                    $fornecedorMaiorPreco = $controladorFornecedor->verFornecedorPorId($precosFiltrados[$produtoId]['fornecedor_maior'])->getNome();
                    $fornecedorMenorPreco = $controladorFornecedor->verFornecedorPorId($precosFiltrados[$produtoId]['fornecedor_menor'])->getNome();
    
                    // Formatar a data para o formato brasileiro
                    $dataCotacao = date("d/m/Y", strtotime($cotacao->getDataCotacao()));
    
                    echo "<tr>";
                    echo "<td>{$produtoNome}</td>";
                    echo "<td>{$dataCotacao}</td>";
                    echo "<td>R$ <span class='maior-preco'>{$maiorPreco} ↑</span> | R$ <span class='menor-preco'>{$menorPreco} ↓</span></td>";
                    echo "<td> <span class='maior-preco'>{$fornecedorMaiorPreco} ↑</span> | <span class='menor-preco'>{$fornecedorMenorPreco} ↓</span></td>";
                    if ($podeGerenciarCotacoes) {
                        echo "<td> <a href='../editarCotacoes/editCotacoes.php?id={$cotacao->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                        echo "<td> <a href='../deletarCotacoes/delCotacoes.php?id={$cotacao->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
                    }
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <?php
        if(!isset($cotasFiltradas)){
            construirTabelas($cotas);
        }
    ?>
        <!-- <tbody>
            <?php
            foreach ($cotas  as $cotacao) {
                $produtoId = $cotacao->getProdutoId();
                $fornecedorId = $cotacao->getFornecedorId();
                $produtoNome = '';
                $fornecedorNome = '';

                foreach ($controladorProduto->verProdutos() as $produto) {
                    if ($produtoId == $produto->getId()) {
                        $produtoNome = $produto->getNome();
                    }
                }

                foreach ($controladorFornecedor->verFornecedor() as $fornecedor) {
                    if ($fornecedorId == $fornecedor->getId()) {
                        $fornecedorNome = $fornecedor->getNome();
                    }
                }

                $maiorPreco = $precos[$produtoId]['maior_preco'];
                $menorPreco = $precos[$produtoId]['menor_preco'];
                $fornecedorMaiorPreco = $controladorFornecedor->verFornecedorPorId($precos[$produtoId]['fornecedor_maior'])->getNome();
                $fornecedorMenorPreco = $controladorFornecedor->verFornecedorPorId($precos[$produtoId]['fornecedor_menor'])->getNome();

                // Formatar a data para o formato brasileiro
                $dataCotacao = date("d/m/Y", strtotime($cotacao->getDataCotacao()));

                echo "<tr>";
                echo "<td>{$produtoNome}</td>";
                echo "<td>{$dataCotacao}</td>";
                echo "<td>R$ <span class='maior-preco'>{$maiorPreco} ↑</span> | R$ <span class='menor-preco'>{$menorPreco} ↓</span></td>";
                echo "<td> <span class='maior-preco'>{$fornecedorMaiorPreco} ↑</span> | <span class='menor-preco'>{$fornecedorMenorPreco} ↓</span></td>";
                if ($podeGerenciarCotacoes) {
                    echo "<td> <a href='../editarCotacoes/editCotacoes.php?id={$cotacao->getId()}'class='acao-editar'><i class='fas fa-edit'></i> Editar </a></td>";
                    echo "<td> <a href='../deletarCotacoes/delCotacoes.php?id={$cotacao->getId()}'class='acao-deletar'><i class='fas fa-trash'></i> Deletar </a></td>";
                }
                echo "</tr>";
            }
            ?> -->
        </tbody>
    </table>
</main>
<?php renderFooter(); ?>
<script>
    let naoexistecotasatuais = false
    let filtrosnulos = 0

    document.querySelector("#dataFim").addEventListener("change",FilterData)
    document.querySelector("#dataInicio").addEventListener("change",FilterData)

    updatenaoexiste()
    if(naoexistecotasatuais){
        document.querySelector(".tablecotacaoatual").innerHTML = `
        <tr>
            <td colspan="5" class='warning'>Não Realizado</td>
        </tr>`
    }

    try {updatefiltros()} catch (error) {console.log(error)}

    function getQueryParams() {
        let params = {};
        let queryString = window.location.search.substring(1);
        let regex = /([^&=]+)=([^&]*)/g;
        let m;
        while (m = regex.exec(queryString)) {
            params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
        }
        return params;
    }

    let params = getQueryParams();

    if (params.dataInicio) {
        document.querySelector("#dataInicio").value = params.dataInicio;
    }
    if (params.dataFim) {
        document.querySelector("#dataFim").value = params.dataFim;
    }

    if(!params.comSem && !params.fimSem){
        const week = getStartAndEndOfWeek();
        window.location.href = `./listarCotacoes.php?comSem=${week.start}&fimSem=${week.end}`
    }
    function getStartAndEndOfWeek() {
        const today = new Date();
        
        // Obter o dia da semana (0 = Domingo, 1 = Segunda, ..., 6 = Sábado)
        const dayOfWeek = today.getDay();
        
        // Calcular a data do início da semana (Segunda-feira)
        const startOfWeek = new Date(today);
        startOfWeek.setDate(today.getDate() - dayOfWeek + 1);
        
        // Calcular a data do final da semana (Domingo)
        const endOfWeek = new Date(today);
        endOfWeek.setDate(today.getDate() - dayOfWeek + 7);
        
        // Formatar as datas no formato YYYY-MM-DD
        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };

        return {
            start: formatDate(startOfWeek),
            end: formatDate(endOfWeek)
        };
    }

    setTimeout(()=>{
        // window.location.reload()
    }, 1000)

    function limparfiltros(){
        window.location.href = `./listarCotacoes.php?comSem=${params.comSem}&fimSem=${params.fimSem}`
    }

    function FilterData(){
        let params = getQueryParams();

        let dataInicio = new Date(document.querySelector("#dataInicio").value);
        let dataFim = new Date(document.querySelector("#dataFim").value);
        let today = new Date();

        if (dataInicio > today) {
            alert("A data de início não pode ser maior que a data atual.");
            document.querySelector("#dataInicio").value = "";
            return;
        }

        if(dataInicio > dataFim){
            alert("A data de início não pode ser maior que a data final.");
            document.querySelector("#dataInicio").value = "";
            document.querySelector("#dataFim").value = "";
            return;
        }

        dataInicio = document.querySelector("#dataInicio").value
        dataFim = document.querySelector("#dataFim").value

        if(dataInicio !== ""){
            window.location.href = `./listarCotacoes.php?comSem=${params.comSem}&fimSem=${params.fimSem}&dataInicio=${dataInicio}`
        }

        if(dataInicio !== "" && dataFim !== ""){
            window.location.href = `./listarCotacoes.php?comSem=${params.comSem}&fimSem=${params.fimSem}&dataInicio=${dataInicio}&dataFim=${dataFim}`
        }

    }

    if(filtrosnulos){
        let titletable = document.querySelector(".table-title")
        let noFilteredQuotesMessage = document.createElement("button");

        noFilteredQuotesMessage.innerHTML = "Não há cotações filtradas";
        noFilteredQuotesMessage.classList = "buttonLimpar";
        noFilteredQuotesMessage.style.textAlign = "center";
        noFilteredQuotesMessage.setAttribute("onclick", "limparfiltros()")
        titletable.parentNode.insertBefore(noFilteredQuotesMessage, titletable.nextSibling);

        document.querySelectorAll("table , h2").forEach((element)=>{
            element.style.display = "none"
        })

        titletable.innerHTML = "Não Há Cotas Filtradas"
        titletable.style.textAlign = "center"
    }
</script>
</body>
</html>