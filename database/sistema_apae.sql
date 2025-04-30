-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Abr-2025 às 20:12
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_apae`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapios`
--

CREATE TABLE `cardapios` (
  `id` int(11) NOT NULL,
  `nutricionista_id` int(11) NOT NULL,
  `dataC` date NOT NULL,
  `periodo` text NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cardapios`
--

INSERT INTO `cardapios` (`id`, `nutricionista_id`, `dataC`, `periodo`, `descricao`, `data_criacao`) VALUES
(1, 3, '2024-09-18', '', 'Cardápio saudável para a semana.', '2024-09-18 01:39:59'),
(2, 3, '2024-11-11', 'manha', 'BLA BLA BLA ', '2024-11-11 17:13:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio_produtos`
--

CREATE TABLE `cardapio_produtos` (
  `id` int(11) NOT NULL,
  `cardapio_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cotas`
--

CREATE TABLE `cotas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `data_cotacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ramo_atuacao` varchar(100) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `endereco`, `telefone`, `whatsapp`, `email`, `ramo_atuacao`, `data_criacao`) VALUES
(31, 'Mercado Bom Preço', 'Rua das Laranjeiras, 120', '(18) 99999-1001', '(18) 99999-1001', 'contato@bompreco.com', 'Alimenticios', '2025-04-30 18:07:02'),
(32, 'Supermercado Popular', 'Av. Central, 550', '(18) 99999-1002', '(18) 99999-1002', 'vendas@superpopular.com', 'Alimenticios', '2025-04-30 18:07:02'),
(33, 'Distribuidora Central', 'Rua Dom Pedro, 210', '(18) 99999-1003', '(18) 99999-1003', 'comercial@distcentral.com', 'Frios', '2025-04-30 18:07:02'),
(34, 'Mercado da APAE', 'Rua Esperança, 300', '(18) 99999-1004', '(18) 99999-1004', 'mercado@apae.org', 'Outros', '2025-04-30 18:07:02'),
(35, 'Atacadão', 'Rodovia SP-270, km 452', '(18) 99999-1005', '(18) 99999-1005', 'compras@atacadao.com', 'Alimenticios', '2025-04-30 18:07:02'),
(36, 'Cooperativa São João', 'Estrada Rural, km 3', '(18) 99999-1006', '(18) 99999-1006', 'contato@coopsaojoao.com', 'Verduras', '2025-04-30 18:07:02'),
(37, 'Hortifruti Feliz', 'Rua das Flores, 80', '(18) 99999-1007', '(18) 99999-1007', 'vendas@hortifrutifeliz.com', 'Frutas', '2025-04-30 18:07:02'),
(38, 'Distribuidora Barato', 'Av. Brasil, 1020', '(18) 99999-1008', '(18) 99999-1008', 'barato@distribuidora.com', 'Limpeza', '2025-04-30 18:07:02'),
(39, 'Central do Alimento', 'Rua da Feira, 95', '(18) 99999-1009', '(18) 99999-1009', 'central@alimentos.com', 'Frios', '2025-04-30 18:07:02'),
(40, 'Estoque Total', 'Rua São João, 410', '(18) 99999-1010', '(18) 99999-1010', 'estoque@total.com', 'Descartáveis', '2025-04-30 18:07:02'),
(41, 'Comercial Hortifruti', 'Rua Verdejante, 78', '(18) 99999-1011', '(18) 99999-1011', 'comercial@hortifruti.com', 'Frutas', '2025-04-30 18:07:02'),
(42, 'Super Compra', 'Av. das Nações, 332', '(18) 99999-1012', '(18) 99999-1012', 'compras@supercompra.com', 'Alimenticios', '2025-04-30 18:07:02'),
(43, 'Fornecedor Local A', 'Rua Independência, 10', '(18) 99999-1013', '(18) 99999-1013', 'locala@fornecedor.com', 'Outros', '2025-04-30 18:07:02'),
(44, 'Fornecedor Local B', 'Rua dos Ipês, 250', '(18) 99999-1014', '(18) 99999-1014', 'localb@fornecedor.com', 'Outros', '2025-04-30 18:07:02'),
(45, 'Fornecedor Local C', 'Rua Primavera, 300', '(18) 99999-1015', '(18) 99999-1015', 'localc@fornecedor.com', 'Outros', '2025-04-30 18:07:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `data_notificacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `tipo_usuario` enum('administrador','funcionario','nutricionista') NOT NULL,
  `gerenciar_usuarios` tinyint(1) NOT NULL DEFAULT 0,
  `gerenciar_cardapios` tinyint(1) NOT NULL DEFAULT 0,
  `ver_cardapios` tinyint(1) NOT NULL DEFAULT 0,
  `gerenciar_produtos` tinyint(1) NOT NULL DEFAULT 0,
  `ver_produtos` tinyint(1) NOT NULL DEFAULT 0,
  `gerenciar_cotacoes` tinyint(1) NOT NULL DEFAULT 0,
  `ver_cotacoes` tinyint(1) NOT NULL DEFAULT 0,
  `gerenciar_fornecedores` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `tipo_usuario`, `gerenciar_usuarios`, `gerenciar_cardapios`, `ver_cardapios`, `gerenciar_produtos`, `ver_produtos`, `gerenciar_cotacoes`, `ver_cotacoes`, `gerenciar_fornecedores`) VALUES
(1, 'administrador', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'funcionario', 0, 0, 1, 1, 1, 1, 1, 1),
(3, 'nutricionista', 0, 1, 1, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `unidade_medida` enum('CX','UN','KG','MC','SC','BDJ','CBÇ') NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `unidade_medida`, `data_criacao`) VALUES
(1, 'ACEM MOÍDO', 'Açougue', 'KG', '2025-04-30 17:58:37'),
(2, 'ARROZ TIPO 1', 'Alimenticios', 'KG', '2025-04-30 17:58:37'),
(3, 'FEIJÃO CARIOCA', 'Alimenticios', 'KG', '2025-04-30 17:58:37'),
(4, 'BATATA INGLESA', 'Verduras', 'KG', '2025-04-30 17:58:37'),
(5, 'CEBOLA', 'Verduras', 'KG', '2025-04-30 17:58:37'),
(6, 'ALHO', 'Verduras', 'KG', '2025-04-30 17:58:37'),
(7, 'LEITE INTEGRAL', 'Frios', 'CX', '2025-04-30 17:58:37'),
(8, 'MACARRÃO ESPAGUETE', 'Alimenticios', 'UN', '2025-04-30 17:58:37'),
(9, 'PAPEL HIGIÊNICO', 'Higiene Pessoal', 'UN', '2025-04-30 17:58:37'),
(10, 'DETERGENTE', 'Limpeza', 'UN', '2025-04-30 17:58:37'),
(11, 'ÓLEO DE SOJA', 'Alimenticios', 'CX', '2025-04-30 17:58:37'),
(12, 'AÇÚCAR CRISTAL', 'Alimenticios', 'KG', '2025-04-30 17:58:37'),
(13, 'SAL REFINADO', 'Alimenticios', 'KG', '2025-04-30 17:58:37'),
(14, 'FARINHA DE TRIGO', 'Alimenticios', 'KG', '2025-04-30 17:58:37'),
(15, 'CAFÉ EM PÓ', 'Alimenticios', 'KG', '2025-04-30 17:58:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('administrador','contador','nutricionista') NOT NULL,
  `crn` varchar(20) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `cpf`, `nome`, `sobrenome`, `data_nascimento`, `endereco`, `telefone`, `email`, `senha`, `tipo_usuario`, `crn`, `data_criacao`) VALUES
(3, '11122233344', 'Ana', 'Santos', '1990-07-10', 'Rua da Saúde, 789', '(18) 97777-7777', 'ana@apae.org', 'nutri123', 'nutricionista', 'CRN-12345', '2024-09-18 01:39:03'),
(4, '487.677.598', 'Manoela', 'Pinheiro da Silva', '2006-03-29', 'Rua Ângelo Salvatore, 125', '(18) 99681-6585', 'manoela2903@outlook.com', '2903', 'administrador', NULL, '2024-10-02 02:58:40'),
(5, '456.765.098', 'Renata', 'Costa', '1992-05-12', 'Rua ABC N 12', '(18) 99215-9875', 'CostaRenata@apae.org', 'cont123', 'contador', '', '2024-11-06 12:28:24'),
(9, '123098456-1', 'João Pedro', 'Garcia Girotto', '2006-01-04', 'Rua bla bla bla', '18 998532901', 'joao.girotto@gmail.com', '0401', 'administrador', '', '2025-04-30 16:41:38'),
(10, '12345678900', 'Ana', 'Silva', '1985-03-12', 'Rua A, 123', '(18) 99999-1001', 'ana@exemplo.com', 'senha123', 'administrador', NULL, '2025-04-30 18:09:49'),
(11, '23456789011', 'Bruno', 'Souza', '1990-06-23', 'Rua B, 456', '(18) 99999-1002', 'bruno@exemplo.com', 'senha456', 'contador', NULL, '2025-04-30 18:09:49'),
(12, '34567890122', 'Carla', 'Pereira', '1992-11-05', 'Av. C, 789', '(18) 99999-1003', 'carla@exemplo.com', 'senha789', 'nutricionista', 'CRN12345', '2025-04-30 18:09:49'),
(13, '45678901233', 'Diego', 'Oliveira', '1988-08-15', 'Rua D, 101', '(18) 99999-1004', 'diego@exemplo.com', 'senha101', 'administrador', NULL, '2025-04-30 18:09:49'),
(14, '56789012344', 'Eduarda', 'Mendes', '1995-01-30', 'Rua E, 202', '(18) 99999-1005', 'eduarda@exemplo.com', 'senha202', 'nutricionista', 'CRN67890', '2025-04-30 18:09:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cardapios`
--
ALTER TABLE `cardapios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nutricionista_id` (`nutricionista_id`);

--
-- Índices para tabela `cardapio_produtos`
--
ALTER TABLE `cardapio_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cardapio_id` (`cardapio_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices para tabela `cotas`
--
ALTER TABLE `cotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `fornecedor_id` (`fornecedor_id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cardapios`
--
ALTER TABLE `cardapios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cardapio_produtos`
--
ALTER TABLE `cardapio_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cotas`
--
ALTER TABLE `cotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cardapios`
--
ALTER TABLE `cardapios`
  ADD CONSTRAINT `cardapios_ibfk_1` FOREIGN KEY (`nutricionista_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `cardapio_produtos`
--
ALTER TABLE `cardapio_produtos`
  ADD CONSTRAINT `cardapio_produtos_ibfk_1` FOREIGN KEY (`cardapio_id`) REFERENCES `cardapios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cardapio_produtos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `cotas`
--
ALTER TABLE `cotas`
  ADD CONSTRAINT `cotas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotas_ibfk_2` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
