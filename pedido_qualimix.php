<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Produtos - Qualimix</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        button {
            background-color: #0088cc;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0077bb;
        }
        .product-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        .product-item input, .product-item select {
            flex: 1;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Pedido de Produtos Qualimix</h2>
    <form id="orderForm">
        <label for="name">Nome ou Empresa:</label>
        <input type="text" id="name" placeholder="Digite seu nome" required>
		
		
		
		
		
		

        <div id="product-list">
            <div class="product-item">
		
                <select class="product" required>
	<?php
                // Configurações do banco de dados
                $host = 'pbxvoip.ddns.net';
                $db = 'qualimix_db';
                $user = 'root'; // Altere para seu usuário do MySQL
                $password = ''; // Altere para sua senha do MySQL

                // Conexão com o banco de dados
                try {
                    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Query para buscar os produtos
                    $stmt = $conn->prepare("SELECT id, nome FROM Produtos");
                    $stmt->execute();

                    // Preenche o campo de seleção com os produtos
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nome']) . '</option>';
						
                    }
                } catch (PDOException $e) {
                    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                }
            ?>
				
                </select>

				
				
				
				
				
				
				
				
				
				
				
                <input type="number" class="quantity" min="1" placeholder="Quantidade" required>
            </div>
        </div>

        <button type="button" onclick="addProduct()">Adicionar Produto</button>
        <button type="button" onclick="sendOrder()">Enviar Pedido via Telegram</button>
    </form>
	  Após envio do pedido, pode fechar a página que irá abrir!
</div>

<script>
    // Função para adicionar um novo produto ao pedido
    function addProduct() {
        const productList = document.getElementById("product-list");
        const productItem = document.createElement("div");
        productItem.classList.add("product-item");
        productItem.innerHTML = `
            <select class="product" required>
                <?php
                // Configurações do banco de dados
                $host = 'pbxvoip.ddns.net';
                $db = 'qualimix_db';
                $user = 'root'; // Altere para seu usuário do MySQL
                $password = ''; // Altere para sua senha do MySQL

                // Conexão com o banco de dados
                try {
                    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Query para buscar os produtos
                    $stmt = $conn->prepare("SELECT id, nome FROM produtos");
                    $stmt->execute();

                    // Preenche o campo de seleção com os produtos
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nome']) . '</option>';
					}
                } catch (PDOException $e) {
                    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                }
            ?>
            </select>
			
            <input type="number" class="quantity" min="1" placeholder="Quantidade" required>
        `;
        productList.appendChild(productItem);
    }

    // Função para enviar o pedido via Telegram
    function sendOrder() {
        const name = document.getElementById("name").value;
        const productElements = document.querySelectorAll(".product");
        const quantityElements = document.querySelectorAll(".quantity");

        // Construir a mensagem do pedido
        let message = `Olá, meu nome é ${name}. Gostaria de pedir:\n`;
        for (let i = 0; i < productElements.length; i++) {
            const product = productElements[i].value;
            const quantity = quantityElements[i].value;
            message += `- ${product}: ${quantity} unidade(s)\n`;
        }

        // Número do Bot de Telegram (substitua com o token do bot e ID do chat)
        const botToken = "8115859320:AAE29auJ_nejimK1rJqdA_TTtNjiOj8ffHY";  // Substitua com o token do seu bot
        const chatId = "-1002276007218";      // Substitua com o ID do chat

        // URL da API do Telegram
        const url = `https://api.telegram.org/bot${botToken}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(message)}`;

        // Abrir o link para enviar a mensagem
        window.open(url, "_blank");
		close;
    }
</script>

</body>
</html>
