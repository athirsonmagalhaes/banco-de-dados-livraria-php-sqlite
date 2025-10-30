# 📚 CRUD Livraria com PHP e SQLite

Este é um projeto simples de CRUD (Create, Read, Update, Delete) para gerenciar um catálogo de livros. Ele utiliza PHP para o backend (lógica de banco de dados) e JavaScript/HTML/CSS para o frontend. O banco de dados é um arquivo SQLite.

## ⚙️ Pré-requisitos

Para executar este projeto, você precisa de um ambiente que possa interpretar PHP e servir arquivos web. O mais comum é usar um servidor local como XAMPP, WAMP ou MAMP.

* **Servidor Web:** Apache (geralmente incluído no XAMPP/WAMP/MAMP).
* **PHP:** Versão 7.x ou superior.
* **Extensão PDO SQLite:** A extensão `php_pdo_sqlite` precisa estar habilitada no seu arquivo `php.ini` (geralmente já está ativada por padrão nesses pacotes de servidores locais).

## 🚀 Como Executar

1.  **Clone o Repositório**
    ```bash
    git clone [https://github.com/SEU-USUARIO/crud-livraria-sqlite-php.git](https://github.com/SEU-USUARIO/crud-livraria-sqlite-php.git)
    ```

2.  **Mova para a Pasta do Servidor**
    Mova a pasta clonada (`crud-livraria-sqlite-php`) para o diretório de documentos do seu servidor web (ex: `htdocs` no XAMPP, `www` no WAMP).

3.  **Inicie o Servidor Local**
    Certifique-se de que os módulos **Apache** e **PHP** estão rodando.

4.  **Acesse o Projeto no Navegador**
    Abra seu navegador e acesse:
    ```
    http://localhost/crud-livraria-sqlite-php/index.php
    ```

    > ⚠️ **Nota:** Na primeira vez que você acessar a página, o código PHP irá automaticamente criar o arquivo de banco de dados `livraria.db` no mesmo diretório.

## 💾 Detalhes do Projeto

* **Arquivo Único:** `index.php`
* **Banco de Dados:** `livraria.db` (SQLite)
* **Tabela:** `livros` (id, livro, autor, ano)
* **Operações:** As funções de CRUD são gerenciadas pelo PHP, sendo acionadas por requisições `fetch` do JavaScript, que passam o parâmetro `?action=` na URL.
