<?php
include 'conexao.php'; // Inclui o arquivo de conexão

// Consulta para buscar dados dos automóveis e da concessionária associada
$sql = "SELECT automovel.ID_automovel, automovel.modelo, automovel.anoFabricacao, automovel.preco, concessionario.nome_concessionaria 
        FROM automovel 
        INNER JOIN concessionario ON automovel.ID_concessionaria = concessionario.ID_concessionaria";

$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    echo "<h1>Lista de Automóveis</h1>";
    while ($row = $resultado->fetch_assoc()) {
        echo "<div>";
        echo "Modelo: " . $row['modelo'] . "<br>";
        echo "Ano: " . $row['anoFabricacao'] . "<br>";
        echo "Preço: R$" . number_format($row['preco'], 2, ',', '.') . "<br>";
        echo "Concessionária: " . $row['nome_concessionaria'] . "<br>";
        echo "</div><hr>";
    }
} else {
    echo "Nenhum automóvel encontrado.";
}

// Fecha a conexão após a consulta
$conexao->close();
?>

