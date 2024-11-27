<?php
// Configuração da conexão com o banco de dados
$host = 'localhost'; // Endereço do servidor MySQL
$user = 'root'; // Nome de usuário do MySQL
$password = ''; // Senha
$dbname = 'concessionaria'; // Nome do banco de dados   

// Criação da conexão
$conexao = new mysqli($host, $user, $password, $dbname);

// Verificação da conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Configuração para utilizar UTF-8, caso necessário
$conexao->set_charset("utf8");

// Exemplo de uso:
// echo "Conectado ao banco de dados com sucesso!";
?>
