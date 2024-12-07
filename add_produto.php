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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $nome = $_POST['nome'];
    
    $sql = "INSERT INTO produtos (nome) VALUES ('$nome')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Produto adicionado com sucesso!</p>";
    } else {
        echo "<p>Erro ao adicionar produto: " . $conn->error . "</p>";
    }
}

$conn->close();

// Redireciona de volta para a página principal
header('Location: produtos.php');
exit();
?>
