<?php

require_once __DIR__ . '/../app/env/index.php';
use DevCoder\DotEnv;
(new DotEnv(__DIR__ . '/../.env'))->load();

$servername = trim(getenv('HOST'), '" ');
$port = trim(getenv('PORT'), '" ');
$username = trim(getenv('USERNAME'), '" ');
$password = trim(getenv('PASSWORD'), '" ');
$database = trim(getenv('DATABASE'), '" ');
$ssl_ca_path = 'certs\ca.pem';

try {
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => $ssl_ca_path, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 10
    ];

    $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8;port=$port", $username, $password);

    echo "Conexão SSL em PHP estabelecida com sucesso!";
} catch (PDOException $e) {
    error_log("Erro de Conexão: " . $e->getMessage());
}