# 📚 Banco de dados de Livraria

Projeto simples de CRUD (Create, Read, Update, Delete) para gerenciar um catálogo de livros. Ele foi desenvolvido com **PHP puro**, utilizando **SQLite** para o banco de dados. Toda a funcionalidade e interface estão contidas em um único arquivo PHP (`index.php`), o que facilita a configuração e execução.

## ✨ Funcionalidades

* **Registro de Livros:** Adicionar um novo livro com Título, Autor e Ano de Publicação.
* **Listagem de Dados:** Exibir todos os livros registrados em uma tabela.
* **Edição (Update):** Carregar os dados de um livro na área de formulário para modificação.
* **Exclusão (Delete):** Remover permanentemente um registro do banco de dados.
* **Banco de Dados Integrado:** Utiliza SQLite (`livraria.db`), sendo leve e não exigindo um servidor de banco de dados externo.

## 🛠️ Tecnologias Utilizadas

* **Linguagem Backend:** PHP
* **Banco de Dados:** SQLite (via PDO - PHP Data Objects)
* **Interface:** HTML, CSS básico e JavaScript (para interações assíncronas `fetch` sem recarregar a página).

## 🚀 Como Executar o Projeto

Para rodar este projeto, você precisa de um ambiente de servidor web que possa processar arquivos PHP. **XAMPP**, **WAMP** ou **MAMP** são as opções mais recomendadas.

### 1. Requisitos

* **PHP:** Versão 7.x ou superior.
* **Extensão PDO SQLite:** A extensão `pdo_sqlite` precisa estar habilitada no seu arquivo de configuração `php.ini`. (Geralmente vem ativada por padrão nos pacotes de servidores locais).

### 2. Configuração

1.  **Clone o Repositório:**
    ```bash
    git clone https://github.com/athirsonmagalhaes/banco-de-dados-livraria-php-sqlite.git
    cd banco-de-dados-livraria-php-sqlite
    
    ```

2.  **Posicione os Arquivos:**
    * Mova a pasta clonada (`banco-de-dados-livraria-php-sqlite`) para o diretório raiz de documentos do seu servidor web (por exemplo, a pasta `htdocs` do XAMPP ou `www` do WAMP).

3.  **Acesse no Navegador:**
    * Inicie o servidor Apache (e o PHP).
    * Abra o navegador e acesse o projeto através da URL:
        ```
        http://localhost/banco-de-dados-livraria-php-sqlite/index.php
        ```

### 3. Sobre o Banco de Dados

* O script PHP contido em `index.php` é configurado para criar e se conectar automaticamente ao banco de dados chamado **`livraria.db`**.
* Se o arquivo **`livraria.db`** não existir, ele será criado automaticamente na primeira vez que você acessar a página.
