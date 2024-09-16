<?php
//config banco de dados
$host = 'localhost';
$bdName = 'livro';
$username = 'root';
$password = '';

//criar conexão com BD
$conn = new mysqli($host, $username, $password, $bdName);

if($conn-> connect_error){
    die("Falha na conexão".$conn -> connect_error);
}
echo "Conexão realizada com sucesso";

$sql = "INSERT INTO autrores (nome, nascionalidade, dataNascimento)
        VALUES (\"Machado de Assis\", \"Brasil\", \"1839/21/06\")";

if($conn->query($sql) === TRUE){
    echo "dados inseridos com sucesso";
}else{
    echo "Erro ao inserir dados".$conn->error;
}

$conn->close();
?>