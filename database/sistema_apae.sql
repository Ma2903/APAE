-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/10/2024 às 13:43
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
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cardapios`
--

INSERT INTO `cardapios` (`id`, `nutricionista_id`, `data_inicio`, `data_fim`, `descricao`, `data_criacao`) VALUES
(1, 3, '2024-09-18', '2024-09-24', 'Cardápio saudável para a semana.', '2024-09-18 01:39:59');

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
(1, 1, 1, 10.00),
(2, 1, 2, 5.00);

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
  `data_cotacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cotas`
--

INSERT INTO `cotas` (`id`, `produto_id`, `fornecedor_id`, `preco_unitario`, `quantidade`, `data_cotacao`) VALUES
(1, 1, 1, 4.50, 50.00, '2024-09-15'),
(2, 1, 2, 5.00, 50.00, '2024-09-15'),
(3, 2, 2, 10.90, 20.00, '2024-09-15'),
(4, 3, 3, 15.00, 10.00, '2024-09-15'),
(5, 1, 1, 4.50, 50.00, '2024-09-15'),
(6, 1, 2, 5.00, 50.00, '2024-09-15'),
(7, 2, 2, 10.90, 20.00, '2024-09-15'),
(8, 3, 3, 15.00, 10.00, '2024-09-15');

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
(1, 'Ceasa', 'Rua dos Alimentos, 123', '(18) 3333-3333', '(18) 99999-0000', 'ceasa@alimentos.com', 'Frutas e Verduras', '2024-09-18 01:39:19'),
(2, 'Supermercado Bom Preço', 'Av. Central, 456', '(18) 3444-4444', '(18) 98888-1111', 'contato@bompreco.com', 'Açougue', '2024-09-18 01:39:19'),
(3, 'Distribuidora Higiene', 'Rua Higiene, 321', '(18) 3555-5555', '(18) 97777-2222', 'vendas@higiene.com', 'Produtos de Limpeza', '2024-09-18 01:39:19');

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
(1, 2, 'A cotação de preços para a semana está atrasada. Por favor, faça a cotação.', '2024-09-18 01:40:06');

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
(1, 'Maçã', 'Verduras', 'KG', '2024-09-18 01:39:26'),
(2, 'Frango', 'Carnes', 'KG', '2024-09-18 01:39:26'),
(3, 'Sabão em Pó', 'Limpeza', 'CX', '2024-09-18 01:39:26');

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
  `tipo_usuario` enum('administrador','funcionario','nutricionista') NOT NULL,
  `crn` varchar(20) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `cpf`, `nome`, `sobrenome`, `data_nascimento`, `endereco`, `telefone`, `email`, `senha`, `tipo_usuario`, `crn`, `data_criacao`) VALUES
(1, '12345678901', 'Carlos', 'Silva', '1980-05-14', 'Rua das Flores, 123', '(18) 99999-9999', 'carlos@apae.org', 'admin123', 'administrador', NULL, '2024-09-18 01:39:03'),
(2, '98765432100', 'Maria', 'Oliveira', '1985-03-22', 'Av. Brasil, 456', '(18) 98888-8888', 'maria@apae.org', 'funcionario123', 'funcionario', NULL, '2024-09-18 01:39:03'),
(3, '11122233344', 'Ana', 'Santos', '1990-07-10', 'Rua da Saúde, 789', '(18) 97777-7777', 'ana@apae.org', 'nutri123', 'nutricionista', 'CRN-12345', '2024-09-18 01:39:03');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cardapio_produtos`
--
ALTER TABLE `cardapio_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cotas`
--
ALTER TABLE `cotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
