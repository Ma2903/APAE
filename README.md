# Sistema de Gestão para a APAE

<p align="center">
  <img alt="Status do Projeto" src="https://img.shields.io/badge/status-concluído-green">
  <img alt="Linguagem Principal" src="https://img.shields.io/github/languages/top/Ma2903/APAE?color=777BB4">
  <img alt="Licença" src="https://img.shields.io/badge/license-MIT-blue">
</p>

<p align="center">
  </p>

## 📜 Sobre o Projeto

O **Sistema de Gestão APAE** é uma aplicação web desenvolvida para otimizar a administração das atividades e recursos da **Associação de Pais e Amigos dos Excepcionais (APAE)**. O objetivo é centralizar e simplificar a gestão da instituição, oferecendo uma interface intuitiva para o controle de usuários, produtos, cotações e cardápios.

## ✨ Funcionalidades

O sistema conta com os seguintes módulos de gerenciamento:

-   ✅ **Gestão de Usuários:** Cadastro, edição, controle de permissões e autenticação de acesso.
-   ✅ **Gestão de Produtos:** Controle de itens de estoque ou de uso da instituição.
-   ✅ **Gestão de Fornecedores:** Cadastro e gerenciamento de informações de contato e serviços.
-   ✅ **Gestão de Cotações:** Ferramenta para registrar e comparar preços de produtos e serviços.
-   ✅ **Gestão de Cardápios:** Planejamento e organização dos cardápios oferecidos pela instituição.

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído utilizando as seguintes tecnologias:

-   **Frontend:** HTML, CSS, JavaScript
-   **Backend:** PHP
-   **Banco de Dados:** MySQL

## 👨‍💻 Autores

Este projeto foi desenvolvido por:

- **Daniel José Dantas Jacometo** - [DevZIKIII](https://github.com/DevZIKIII)
- **Manoela Pinheiro da Silva** - [Ma2903](https://github.com/Ma2903)
- **João Pedro Garcia Girotto** - [JP1005YT](https://github.com/JP1005YT)

## 🚀 Como Executar o Projeto

Para rodar este projeto em seu ambiente local, siga os passos abaixo.

### Pré-requisitos

Para executar este projeto, você precisará de um **ambiente de servidor local** que execute **PHP** e um servidor de banco de dados **MySQL**. Ferramentas como o [XAMPP](https://www.apachefriends.org/index.html) são recomendadas por incluírem tudo o que é necessário.

### Guia de Instalação

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/Ma2903/APAE.git
    ```

2.  **Mova o projeto para o diretório do servidor:**
    * Mova a pasta `APAE` para o diretório raiz do seu servidor web (geralmente `htdocs` no XAMPP).

3.  **Configure o Banco de Dados:**
    * Inicie os serviços do seu servidor (Apache e MySQL).
    * Acesse o `phpMyAdmin` (normalmente em `http://localhost/phpmyadmin`).
    * Crie um novo banco de dados (ex: `apae_db`).
    * Importe o arquivo de estrutura do banco de dados (`.sql`) para o banco recém-criado.
        4.  **Configure a Conexão:**
    * Encontre o arquivo de configuração da conexão com o banco no projeto (ex: `config.php` ou `conexao.php`).
    * Abra este arquivo e edite as variáveis com os dados do seu banco local (host, nome de usuário, senha e nome do banco de dados).

5.  **Acesse a Aplicação:**
    * Abra seu navegador e acesse o endereço do projeto.
    * Exemplo: `http://localhost/APAE`

## 📄 Licença

Este projeto é distribuído sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.
