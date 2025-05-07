-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/05/2025 às 15:54
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

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
-- Estrutura para tabela `cardapios`
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
-- Despejando dados para a tabela `cardapios`
--

INSERT INTO `cardapios` (`id`, `nutricionista_id`, `dataC`, `periodo`, `descricao`, `data_criacao`) VALUES
(16, 3, '2025-05-08', 'manha-tarde', 'Arroz, feijão, frango grelhado, macarrão com molho de tomate, salada de alface com cebola e sobremesa de creme de leite com frutas.', '2025-05-07 13:19:08'),
(18, 3, '2025-05-10', 'tarde', 'Arroz, feijão, frango grelhado.', '2025-05-07 13:38:36'),
(19, 3, '2025-05-11', 'manha', 'Sopa de legumes.', '2025-05-07 13:38:36');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio_produtos`
--

CREATE TABLE `cardapio_produtos` (
  `id` int(11) NOT NULL,
  `cardapio_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cardapio_produtos`
--

INSERT INTO `cardapio_produtos` (`id`, `cardapio_id`, `produto_id`, `quantidade`) VALUES
(20, 16, 20, 5.00),
(21, 16, 21, 3.00),
(22, 16, 22, 4.00),
(23, 16, 23, 2.00),
(31, 16, 24, 3.00),
(32, 16, 25, 2.00),
(33, 16, 26, 1.00),
(34, 16, 27, 0.50),
(35, 16, 28, 1.00),
(579, 18, 20, 3.00),
(580, 18, 21, 2.00),
(581, 18, 22, 1.50),
(582, 18, 28, 0.50),
(583, 18, 27, 0.10),
(584, 18, 26, 0.20),
(585, 19, 23, 2.00),
(586, 19, 24, 1.00),
(587, 19, 12, 0.50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cotas`
--

CREATE TABLE `cotas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `data_cotacao` date NOT NULL,
  `rel_un_peso` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cotas`
--

INSERT INTO `cotas` (`id`, `produto_id`, `fornecedor_id`, `preco_unitario`, `quantidade`, `data_cotacao`, `rel_un_peso`) VALUES
(11, 8, 1, 19.99, 10.00, '2025-05-06', 50),
(13, 12, 1, 25.00, 5.00, '2025-05-06', 200),
(14, 14, 6, 10.00, 80.00, '2025-05-07', 1),
(15, 8, 1, 19.99, 10.00, '2025-05-06', 50),
(16, 12, 1, 25.00, 5.00, '2025-05-06', 200),
(17, 14, 6, 10.00, 80.00, '2025-05-07', 1),
(18, 20, 9, 5.99, 10.00, '2025-05-07', 100),
(19, 21, 9, 6.49, 10.00, '2025-05-07', 100),
(20, 22, 8, 12.90, 5.00, '2025-05-07', 100),
(21, 23, 7, 4.50, 6.00, '2025-05-07', 100),
(22, 24, 7, 2.99, 3.00, '2025-05-07', 200),
(23, 25, 7, 3.50, 4.00, '2025-05-07', 200),
(24, 26, 1, 2.00, 2.00, '2025-05-07', 300),
(25, 27, 1, 3.00, 1.00, '2025-05-07', 300),
(26, 28, 1, 4.50, 1.00, '2025-05-07', 200);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
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
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `endereco`, `telefone`, `whatsapp`, `email`, `ramo_atuacao`, `data_criacao`) VALUES
(1, 'Ceasa', 'Rua dos Alimentos, 123', '(18) 3333-3333', '(18) 99999-0000', 'ceasa@alimentos.com', 'Frutas', '2024-09-18 01:39:19'),
(2, 'Supermercado Bom Preço', 'Av. Central, 456', '(18) 3444-4444', '(18) 98888-1111', 'contato@bompreco.com', 'Açougue', '2024-09-18 01:39:19'),
(6, 'Supermercado Estrela', 'Avenida Brasil, 35', '(18) 3226-0671', '(18) 3226-0671', 'Estrela@mercados.com', 'Alimenticio', '2024-11-06 11:59:07'),
(7, 'Distribuidora Alimentar Sabor & Vida', 'Rua das Indústrias, 101', '(18) 3222-1234', '(18) 99876-5432', 'saborvida@distribuidora.com', 'Alimentos Secos', '2025-05-07 13:18:37'),
(8, 'Frango Forte Ltda.', 'Avenida das Aves, 1001', '(18) 3555-0001', '(18) 97777-8888', 'contato@frangoforte.com.br', 'Carnes', '2025-05-07 13:18:37'),
(9, 'Cerealista União', 'Estrada Rural, Km 25', '(18) 3000-4040', '(18) 91111-2222', 'uniao@cerealista.com', 'Grãos e Cereais', '2025-05-07 13:18:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `data_notificacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `usuario_id`, `mensagem`, `data_notificacao`) VALUES
(8, 10, 'Você não realizou cotações nesta semana. Não se esqueça de realizar suas cotações!', '2025-05-07 04:21:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `tipo_usuario` enum('administrador','contador','nutricionista') NOT NULL,
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
-- Despejando dados para a tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `tipo_usuario`, `gerenciar_usuarios`, `gerenciar_cardapios`, `ver_cardapios`, `gerenciar_produtos`, `ver_produtos`, `gerenciar_cotacoes`, `ver_cotacoes`, `gerenciar_fornecedores`) VALUES
(1, 'administrador', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'contador', 0, 0, 1, 1, 1, 1, 1, 1),
(3, 'nutricionista', 0, 1, 1, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `unidade_medida` enum('CX','UN','KG','MC','SC','BDJ','CBÇ') NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `unidade_medida`, `data_criacao`) VALUES
(8, 'Achocolatado em pó', 'Alimenticios', 'UN', '2024-11-06 11:42:20'),
(9, 'Creme Dental', 'Higiene Pessoal', 'UN', '2024-11-06 11:43:36'),
(10, 'Detergente', 'Limpeza', 'UN', '2024-11-06 11:44:02'),
(11, 'Farinha de Trigo', 'Alimenticios', 'UN', '2024-11-06 11:44:20'),
(12, 'Mussarela', 'Frios', 'KG', '2024-11-06 11:44:47'),
(13, 'Pães Frances', 'Outros', 'UN', '2024-11-06 11:45:33'),
(14, 'Banana', 'Frutas', 'KG', '2024-11-06 11:46:58'),
(20, 'Arroz Tipo 1', 'Cereais', 'KG', '2025-05-07 13:18:52'),
(21, 'Feijão Carioca', 'Cereais', 'KG', '2025-05-07 13:18:52'),
(22, 'Frango Congelado', 'Carnes', 'KG', '2025-05-07 13:18:52'),
(23, 'Macarrão Espaguete', 'Massas', 'KG', '2025-05-07 13:18:52'),
(24, 'Molho de Tomate', 'Molhos e Condimentos', 'UN', '2025-05-07 13:18:52'),
(25, 'Creme de Leite', 'Laticínios', 'UN', '2025-05-07 13:18:52'),
(26, 'Óleo de Soja', 'Óleos e Gorduras', 'UN', '2025-05-07 13:18:52'),
(27, 'Alho', 'Temperos', 'KG', '2025-05-07 13:18:52'),
(28, 'Cebola', 'Vegetais', 'KG', '2025-05-07 13:18:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
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
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `cpf`, `nome`, `sobrenome`, `data_nascimento`, `endereco`, `telefone`, `email`, `senha`, `tipo_usuario`, `crn`, `data_criacao`) VALUES
(3, '11122233344', 'Ana', 'Santos', '1990-07-10', 'Rua da Saúde, 789', '(18) 97777-7777', 'ana@apae.org', 'nutri123', 'nutricionista', 'CRN-12345', '2024-09-18 01:39:03'),
(4, '487.677.598', 'Manoela', 'Pinheiro da Silva', '2006-03-29', 'Rua Ângelo Salvatore, 125', '(18) 99681-6585', 'manoela2903@outlook.com', '2903', 'administrador', NULL, '2024-10-02 02:58:40'),
(10, '0987654321', 'Lorena', 'Andrade', '2000-02-07', 'Rua etc', '18 99875642', 'lorena@apae.org', 'admcompras123', 'contador', '', '2025-05-06 22:25:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cardapios`
--
ALTER TABLE `cardapios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nutricionista_id` (`nutricionista_id`);

--
-- Índices de tabela `cardapio_produtos`
--
ALTER TABLE `cardapio_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cardapio_id` (`cardapio_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `cotas`
--
ALTER TABLE `cotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `fornecedor_id` (`fornecedor_id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cardapios`
--
ALTER TABLE `cardapios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `cardapio_produtos`
--
ALTER TABLE `cardapio_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=588;

--
-- AUTO_INCREMENT de tabela `cotas`
--
ALTER TABLE `cotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cardapios`
--
ALTER TABLE `cardapios`
  ADD CONSTRAINT `cardapios_ibfk_1` FOREIGN KEY (`nutricionista_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cardapio_produtos`
--
ALTER TABLE `cardapio_produtos`
  ADD CONSTRAINT `cardapio_produtos_ibfk_1` FOREIGN KEY (`cardapio_id`) REFERENCES `cardapios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cardapio_produtos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cotas`
--
ALTER TABLE `cotas`
  ADD CONSTRAINT `cotas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotas_ibfk_2` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
