<?php
// Bloco PHP para inicializar o banco de dados e processar ações de CRUD
try {
  // Conecta ou cria o banco de dados SQLite chamado 'livraria.db'
  $pdo = new PDO('sqlite:livraria.db');
  
  // Cria a tabela 'livros' se ela ainda não existir
  $sql = "CREATE TABLE IF NOT EXISTS livros (
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              livro TEXT NOT NULL,
              autor TEXT NOT NULL,
              ano TEXT NOT NULL
          )";
  $pdo->exec($sql);
  
  // Determina a ação a ser executada com base no parâmetro 'action' na URL
  $action = isset($_GET['action']) ? $_GET['action'] : '';

  
  // Processa a ação de criação (CREATE)
  if ($action == 'create') {
     // Os dados vêm de uma requisição POST
     $livro = $_POST['livro'];
     $autor = $_POST['autor'];
     $ano = $_POST['ano'];
     $stmt = $pdo->prepare("INSERT INTO livros (livro, autor, ano) VALUES (:livro, :autor, :ano)");
     $stmt->bindParam(':livro', $livro);
     $stmt->bindParam(':autor', $autor);
     $stmt->bindParam(':ano', $ano);
    if ($stmt->execute()) {
        echo "Livro registrado com sucesso!";
    } else {
        echo "Erro em registrar o livro!";
    }
    // O script é encerrado para evitar o carregamento do HTML em requisições de API
    exit();
  }
  
    // Processa a ação de leitura (READ)
    if ($action == 'read') {
       // Seleciona todos os registros da tabela 'livros'
       $stmt = $pdo->query("SELECT * FROM livros");
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // Retorna os dados como JSON
       header('Content-Type: application/json');
       echo json_encode($result);
       // O script é encerrado para evitar o carregamento do HTML em requisições de API
       exit();
    }
  
    // Processa a ação de atualização (UPDATE)
    if ($action == 'update') {
       // Os dados vêm de uma requisição POST
       $id = $_POST['id'];
       $livro = $_POST['livro'];
       $autor = $_POST['autor'];
       $ano = $_POST['ano'];
       $stmt = $pdo->prepare("UPDATE livros SET livro = :livro, autor = :autor, ano = :ano WHERE id = :id");
       $stmt->bindParam(':id', $id);
       $stmt->bindParam(':livro', $livro);
       $stmt->bindParam(':autor', $autor);
       $stmt->bindParam(':ano', $ano);
       if ($stmt->execute()) {
          echo "Registro de livro atualizado com sucesso!";
       } else {
          echo "Erro em atualizar o registro de livro!";
       }
       // O script é encerrado para evitar o carregamento do HTML em requisições de API
       exit();
    }
    
    // Processa a ação de exclusão (DELETE)
    if ($action == 'delete') {
       // O ID vem da URL (GET)
       $id = $_GET['id'];
       $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
       $stmt->bindParam(':id', $id);
       if ($stmt->execute()) {
          echo "Registro de livro excluído com sucesso!";
       } else {
          echo "Erro ao excluir o registro de livro!";
       }
       // O script é encerrado para evitar o carregamento do HTML em requisições de API
       exit();
  }
} catch (PDOException $e) {
    // Exibe mensagem de erro em caso de falha na conexão ou execução do PDO
    echo "Erro: " . $e->getMessage();
}

//HTML/JavaScript
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados Livraria</title>
    <style>
      /* Estilos básicos para a página */
      body {
        background-color: lightblue;
        color: darkviolet;
        font-family: Arial, sans-serif;
      }
    </style>
    <script>
      // Função para carregar os dados da tabela via API (action=read)
      function loadData() {
        // A chamada é para o próprio arquivo, usando a action 'read'
        fetch('index.php?action=read')
        .then(response => response.json())
        .then(data => {
          let table = document.getElementById('data');
          table.innerHTML = ''; // Limpa a tabela antes de carregar novos dados
          // Itera sobre os dados e cria as linhas da tabela
          data.forEach(row => {
            table.innerHTML +=`
              <tr>
                <td>${row.id}</td>
                <td>${row.livro}</td>
                <td>${row.autor}</td>
                <td>${row.ano}</td>
                <td>
                  <button onclick="edit(${row.id}, '${row.livro}', '${row.autor}', '${row.ano}')">Editar</button>
                  <button onclick="remove(${row.id})">Excluir</button>
                </td>
              </tr>
              `
            ;
          });
        });
      }
      
      // Função para salvar (criar ou atualizar) um registro de livro
      function save() {
        let id = document.getElementById('id').value;
        let livro = document.getElementById('livro').value;
        let autor = document.getElementById('autor').value;
        let ano = document.getElementById('ano').value;

        let formData = new FormData();
        // Adiciona os dados do formulário ao objeto FormData
        formData.append('id', id);
        formData.append('livro', livro);
        formData.append('autor', autor);
        formData.append('ano', ano);

        // Define a ação: 'update' se houver um ID, 'create' caso contrário
        let action = id ? 'update' : 'create';

        // Envia a requisição POST para o próprio arquivo com a action apropriada
        fetch(`index.php?action=${action}`, {
             method: 'POST', 
             body: formData
        })
        .then(response => response.text())
        .then(data => {
          alert(data); // Exibe a mensagem de sucesso/erro retornada pelo PHP
          loadData(); // Recarrega a tabela de dados
          clearForm(); // Limpa o formulário
        });
      }
      
      // Função para preencher o formulário para edição
      function edit(id, livro, autor, ano) {
        document.getElementById('id').value = id;
        document.getElementById('livro').value = livro;
        document.getElementById('autor').value = autor;
        document.getElementById('ano').value = ano;
      }
      
      // Função para remover um livro
      function remove(id) {
        if (confirm('Tem certeza que deseja excluir este livro?')) {
          // Envia a requisição GET para o próprio arquivo com a action 'delete' e o ID
          fetch(`index.php?action=delete&id=${id}`)
          .then(response => response.text())
          .then(data => {
            alert(data); // Exibe a mensagem de sucesso/erro retornada pelo PHP
            loadData(); // Recarrega a tabela de dados
          })
        }
      }
      
      // Função para limpar os campos do formulário
      function clearForm() {
        document.getElementById('id').value = '';
        document.getElementById('livro').value = '';
        document.getElementById('autor').value = '';
        document.getElementById('ano').value = '';
      }
      
      // Carrega os dados da tabela assim que a página é carregada
      window.onload = loadData;
    </script>
  </head>
  <body>
      <h2>Banco de Dados Livraria</h2>
      
      <form onsubmit="event.preventDefault(); save();">
        <input type="hidden" id="id">
        <label for="livro">Livro:</label>
        <input type="text" id="livro" required><br><br>
        
        <label for="autor">Autor:</label>
        <input type="text" id="autor" required><br><br>
        
        <label for="ano">Ano Publicado:</label>
        <input type="text" id="ano" required><br><br>
        
        <input type="submit" value="Salvar">
        <button type="button" onclick="clearForm()">Limpar</button>
      </form>
    
      <h3>Livros Registrados</h3>
      <table border="1">
      <thead>
        <tr>
            <th>ID</th>
            <th>Livro</th>
            <th>Autor</th>
            <th>Ano Publicado</th>
            <th>Ações</th>
        </tr>
      </thead>
    <tbody id="data">
    </tbody>
  </table>
</body>
</html>