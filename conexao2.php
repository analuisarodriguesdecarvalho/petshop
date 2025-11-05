<?php
$host = 'localhost';
$dbname = 'pet2';
$username = 'root';
$password = '';

$conexao = new mysqli($host, $username, $password, $dbname);

if ($conexao-> connect_error){

    die("Falha na conexão ao banco de dados: " . $conexao->connect_error);
}

echo "Conexão realizada com sucesso!";
?>