-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Nov-2024 às 20:42
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
(1, 3, '2024-09-18', '', 'Cardápio saudável para a semana.', '2024-09-18 01:39:59');

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

--
-- Extraindo dados da tabela `cardapio_produtos`
--

INSERT INTO `cardapio_produtos` (`id`, `cardapio_id`, `produto_id`, `quantidade`) VALUES
(1, 1, 1, '10.00'),
(2, 1, 2, '5.00');

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

--
-- Extraindo dados da tabela `cotas`
--

INSERT INTO `cotas` (`id`, `produto_id`, `fornecedor_id`, `preco_unitario`, `quantidade`, `data_cotacao`) VALUES
(1, 1, 1, '4.50', '50.00', '2024-09-15'),
(2, 1, 2, '5.00', '50.00', '2024-09-15'),
(3, 2, 2, '10.90', '20.00', '2024-09-15'),
(4, 3, 3, '15.00', '10.00', '2024-09-15'),
(5, 1, 1, '4.50', '50.00', '2024-09-15'),
(7, 2, 2, '10.90', '20.00', '2024-09-15'),
(8, 3, 3, '15.00', '10.00', '2024-09-15'),
(9, 1, 2, '4.00', '50.00', '2024-10-20'),
(10, 2, 2, '20.00', '50.00', '2024-11-05');

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
(1, 'Ceasa', 'Rua dos Alimentos, 123', '(18) 3333-3333', '(18) 99999-0000', 'ceasa@alimentos.com', 'Frutas e Verduras', '2024-09-18 01:39:19'),
(2, 'Supermercado Bom Preço', 'Av. Central, 456', '(18) 3444-4444', '(18) 98888-1111', 'contato@bompreco.com', 'Açougue', '2024-09-18 01:39:19'),
(3, 'Distribuidora Higiene', 'Rua Higiene, 321', '(18) 3555-5555', '(18) 97777-2222', 'vendas@higiene.com', 'Produtos de Limpeza', '2024-09-18 01:39:19'),
(6, 'Supermercado Estrela', 'Avenida Brasil, 35', '(18) 3226-0671', '(18) 3226-0671', 'Estrela@mercados.com', 'Alimenticio', '2024-11-06 11:59:07');

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
(1, 'Maçã', 'Verduras', 'KG', '2024-09-18 01:39:26'),
(2, 'Frango', 'Carnes', 'KG', '2024-09-18 01:39:26'),
(3, 'Sabão em Pó', 'Limpeza', 'CX', '2024-09-18 01:39:26'),
(7, 'Absorvente', 'Higiene Pessoal', 'UN', '2024-11-06 11:37:29'),
(8, 'Achocolatado em pó', 'Alimenticios', 'UN', '2024-11-06 11:42:20'),
(9, 'Creme Dental', 'Higiene Pessoal', 'UN', '2024-11-06 11:43:36'),
(10, 'Detergente', 'Limpeza', 'UN', '2024-11-06 11:44:02'),
(11, 'Farinha de Trigo', 'Alimenticios', 'UN', '2024-11-06 11:44:20'),
(12, 'Mussarela', 'Frios', 'KG', '2024-11-06 11:44:47'),
(13, 'Pães Frances', 'Outros', 'UN', '2024-11-06 11:45:33'),
(14, 'Banana', 'Frutas', 'KG', '2024-11-06 11:46:58');

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
(1, '12345678901', 'Carlos', 'Silva', '1980-05-14', 'Rua das Flores, 123', '(18) 99999-9999', 'carlos@apae.org', 'admin123', 'administrador', NULL, '2024-09-18 01:39:03'),
(3, '11122233344', 'Ana', 'Santos', '1990-07-10', 'Rua da Saúde, 789', '(18) 97777-7777', 'ana@apae.org', 'nutri123', 'nutricionista', 'CRN-12345', '2024-09-18 01:39:03'),
(4, '487.677.598', 'Manoela', 'Pinheiro da Silva', '2006-03-29', 'Rua Ângelo Salvatore, 125', '(18) 99681-6585', 'manoela2903@outlook.com', '0401', 'administrador', NULL, '2024-10-02 02:58:40'),
(5, '456.765.098', 'Renata', 'Costa', '1992-05-12', 'Rua ABC N 12', '(18) 99215-9875', 'CostaRenata@apae.org', 'cont123', 'contador', '', '2024-11-06 12:28:24'),
(6, '0987654321', 'Antônio', 'Santos', '1982-09-25', 'Rua XYZ N14', '(18) 1234-8756', 'SantosAntonio@apae.org', 'cont987', 'contador', '', '2024-11-06 12:35:48');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
