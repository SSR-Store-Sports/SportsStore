<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tatifit_database";
$port = 3306;

// stmt prepare gets

try {
    $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}