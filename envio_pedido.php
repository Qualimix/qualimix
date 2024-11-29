<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];
    $produtos = $data['produtos'];

    $csv = "Nome do Produto,Quantidade,Preço Unitário\n";
    foreach ($produtos as $produto) {
        $csv .= "{$produto['nome']},{$produto['quantidade']},{$produto['preco']}\n";
    }

    $csvFile = "pedido_" . time() . ".csv";
    file_put_contents($csvFile, $csv);

    $to = $email;
    $subject = "Pedido de Produtos";
    $message = "Olá,\n\nSegue em anexo o pedido de produtos.\n\nAtenciosamente,\nEquipe de Vendas";
    $headers = "From: vendas@exemplo.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

    $body = "--boundary\r\n";
    $body .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n\r\n";
    $body .= "--boundary\r\n";
    $body .= "Content-Type: text/csv; name=\"$csvFile\"\r\n";
    $body .= "Content-Disposition: attachment; filename=\"$csvFile\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode(file_get_contents($csvFile))) . "\r\n";
    $body .= "--boundary--";

    if (mail($to, $subject, $body, $headers)) {
        echo "Pedido enviado com sucesso!";
    } else {
        echo "Erro ao enviar pedido.";
    }

    unlink($csvFile);
}
?>
<script>
javascript: setTimeout('window.close()',10000)
</script>
    
