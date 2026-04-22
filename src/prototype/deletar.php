<?php

require_once 'sessao.php';
require_once 'db/mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $statement = $pdo->prepare('DELETE FROM filmes WHERE id = ?;');
    $statement->execute([$id]);

    header('Location: index.php');
    exit;
}

?>

<p>Ocorreu um erro ao tentar deletar o registro.</p>