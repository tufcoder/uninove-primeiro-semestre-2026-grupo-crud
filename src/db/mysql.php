<?php

$db_host = 'db';
$db_name = 'app_db';
$db_user = 'app_user';
$db_password = 'app_pass';
$data_source_name = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

try {
    $pdo = new PDO($data_source_name, $db_user, $db_password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

?>