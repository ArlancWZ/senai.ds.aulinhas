<?php

// configuração do banco de dados
$host = "localhost";
$dbname = "livro";
$username = "root";
$password = "";

// conexão com dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão realizada com sucesso";
} catch (PDOException $e) {
    echo "Falha na conexão".$e->getMessage();
}

// dados a serem inseridos
$nome = "C.S. Lewis";
$nacionalidade = "Inglaterra";
$dataNascimento = "1892-01-03";

// query
$sql = "INSERT INTO autores(nome, nacionalidade, dataNascimento) VALUES (:nome, :nacionalidade, :dataNascimento)";

// prepara a conexão
$stmt = $conn->prepare($sql);

// associa valores aos parametros da consulta
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':nacionalidade', $nacionalidade);
$stmt->bindParam(':dataNascimento', $dataNascimento);

// executa consulta
if ($stmt->execute()) {
    echo "dados inseridos com sucesso";
} else {
    echo "Erro ao inserir dados";
}

// fecha a conexão
$conn = null;