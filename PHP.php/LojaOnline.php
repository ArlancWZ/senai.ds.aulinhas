<?php
// Conexão ao banco de dados
$conn = new mysqli('localhost', 'usuario', 'senha', 'LojaOnline');

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Selecionar todos os clientes cadastrados
$sql1 = "SELECT * FROM Clientes";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
        echo "Cliente: " . $row["nome"] . "<br>";
    }
}

// 2. Selecionar todos os pedidos feitos
$sql2 = "SELECT * FROM Pedidos";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        echo "Pedido ID: " . $row["id"] . "<br>";
    }
}

// 3. Exibir o nome dos clientes e o total de seus pedidos
$sql3 = "SELECT c.nome, SUM(p.valor_total) AS total_gasto 
         FROM Clientes c 
         JOIN Pedidos p ON c.id = p.cliente_id 
         GROUP BY c.id";
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc()) {
        echo $row["nome"] . " gastou R$" . $row["total_gasto"] . "<br>";
    }
}

// 4. Selecionar os pedidos com valor acima de 300
$sql4 = "SELECT * FROM Pedidos WHERE valor_total > 300";
$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
    while($row = $result4->fetch_assoc()) {
        echo "Pedido ID: " . $row["id"] . " - Valor: R$" . $row["valor_total"] . "<br>";
    }
}

// 5. Listar os clientes que têm "Silva" no sobrenome
$sql5 = "SELECT * FROM Clientes WHERE nome LIKE '%Silva%'";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) {
    while($row = $result5->fetch_assoc()) {
        echo "Cliente: " . $row["nome"] . "<br>";
    }
}

// 6. Exibir os pedidos feitos após '2024-07-01' ordenados pelo valor total de forma decrescente
$sql6 = "SELECT * FROM Pedidos WHERE data_pedido > '2024-07-01' ORDER BY valor_total DESC";
$result6 = $conn->query($sql6);
if ($result6->num_rows > 0) {
    while($row = $result6->fetch_assoc()) {
        echo "Pedido ID: " . $row["id"] . " - Valor: R$" . $row["valor_total"] . "<br>";
    }
}

// 7. Exibir os clientes que fizeram pedidos acima de 250 reais, ordenados pelo nome
$sql7 = "SELECT DISTINCT c.nome 
         FROM Clientes c 
         JOIN Pedidos p ON c.id = p.cliente_id 
         WHERE p.valor_total > 250 
         ORDER BY c.nome";
$result7 = $conn->query($sql7);
if ($result7->num_rows > 0) {
    while($row = $result7->fetch_assoc()) {
        echo "Cliente: " . $row["nome"] . "<br>";
    }
}

// 8. Contar quantos pedidos foram realizados por cada cliente
$sql8 = "SELECT c.nome, COUNT(p.id) AS num_pedidos 
         FROM Clientes c 
         LEFT JOIN Pedidos p ON c.id = p.cliente_id 
         GROUP BY c.id";
$result8 = $conn->query($sql8);
if ($result8->num_rows > 0) {
    while($row = $result8->fetch_assoc()) {
        echo $row["nome"] . " fez " . $row["num_pedidos"] . " pedidos.<br>";
    }
}

// 9. Calcular o valor total gasto por cada cliente em pedidos
$sql9 = "SELECT c.nome, SUM(p.valor_total) AS total_gasto 
         FROM Clientes c 
         LEFT JOIN Pedidos p ON c.id = p.cliente_id 
         GROUP BY c.id";
$result9 = $conn->query($sql9);
if ($result9->num_rows > 0) {
    while($row = $result9->fetch_assoc()) {
        echo $row["nome"] . " gastou R$" . $row["total_gasto"] . "<br>";
    }
}

// 10. Obter a média do valor dos pedidos realizados
$sql10 = "SELECT AVG(valor_total) AS media_pedido FROM Pedidos";
$result10 = $conn->query($sql10);
if ($row = $result10->fetch_assoc()) {
    echo "A média do valor dos pedidos é R$" . $row["media_pedido"] . "<br>";
}

// 11. Exibir todos os pedidos feitos no mês de março de 2024
$sql11 = "SELECT * FROM Pedidos WHERE data_pedido BETWEEN '2024-03-01' AND '2024-03-31'";
$result11 = $conn->query($sql11);
if ($result11->num_rows > 0) {
    while($row = $result11->fetch_assoc()) {
        echo "Pedido ID: " . $row["id"] . " - Data: " . $row["data_pedido"] . "<br>";
    }
}

// 12. Mostrar os clientes que fizeram pedidos nos últimos 30 dias
$sql12 = "SELECT DISTINCT c.nome 
          FROM Clientes c 
          JOIN Pedidos p ON c.id = p.cliente_id 
          WHERE p.data_pedido >= CURDATE() - INTERVAL 30 DAY";
$result12 = $conn->query($sql12);
if ($result12->num_rows > 0) {
    while($row = $result12->fetch_assoc()) {
        echo "Cliente: " . $row["nome"] . "<br>";
    }
}

// 13. Exibir os clientes que fizeram mais de 5 pedidos
$sql13 = "SELECT c.nome, COUNT(p.id) AS num_pedidos 
          FROM Clientes c 
          JOIN Pedidos p ON c.id = p.cliente_id 
          GROUP BY c.id 
          HAVING num_pedidos > 5";
$result13 = $conn->query($sql13);
if ($result13->num_rows > 0) {
    while($row = $result13->fetch_assoc()) {
        echo "Cliente: " . $row["nome"] . " fez " . $row["num_pedidos"] . " pedidos.<br>";
    }
}

// 14. Exibir a soma do valor total de pedidos por mês
$sql14 = "SELECT DATE_FORMAT(data_pedido, '%Y-%m') AS mes, SUM(valor_total) AS total_por_mes 
          FROM Pedidos 
          GROUP BY mes";
$result14 = $conn->query($sql14);
if ($result14->num_rows > 0) {
    while($row = $result14->fetch_assoc()) {
        echo "Mês: " . $row["mes"] . " - Total: R$" . $row["total_por_mes"] . "<br>";
    }
}

// Fecha a conexão
$conn->close();

