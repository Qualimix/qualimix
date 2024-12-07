<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Gerenciar Produtos</h1>

    <?php
    // Configuração do banco de dados
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'qualimix_db';

    // Conexão com o banco de dados
    $conn = new mysqli($host, $user, $password, $database);

    // Verifica conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Atualizar produto
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        

        $sql = "UPDATE produtos SET nome='$nome' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Produto atualizado com sucesso!</p>";
        } else {
            echo "<p>Erro ao atualizar produto: " . $conn->error . "</p>";
        }
    }

    // Excluir produto
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM produtos WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Produto excluído com sucesso!</p>";
        } else {
            echo "<p>Erro ao excluir produto: " . $conn->error . "</p>";
        }
    }

    // Recuperar dados da tabela
    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Ações</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>
                    <form method='POST' style='display: inline-block;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' size='60' name='nome' value='{$row['nome']}' required>
                        <button type='submit' name='update'>Atualizar</button>
                    </form>
                </td>
                <td>
                    <form method='POST' style='display: inline-block;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' name='delete'>Excluir</button>
                    </form>
                </td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nenhum produto encontrado.</p>";
    }

    $conn->close();
    ?>

    <h2>Adicionar Novo Produto</h2>
    <form method="POST" action="add_produto.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" size="50" required>
        <button type="submit" name="add">Adicionar</button>
    </form>
</body>
</html>
