<?php

require_once 'sessao.php';
require_once 'db/mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $minutos = $_POST['minutos'];
    $resumo = $_POST['resumo'];
    $id_usuario = $_SESSION['user']['id'];

    $statement = $pdo->prepare('
        INSERT INTO filmes (titulo, ano, minutos, resumo, id_usuario) VALUES (?, ?, ?, ?, ?);
    ');
    $statement->execute([$titulo, $ano, $minutos, $resumo, $id_usuario]);

    header('Location: index.php');
    exit;
}

require_once 'header.php';

?>

<h1>Criar</h1>

<form method="post">
    <label for="titulo">Título:</label>
    <input
        type="text"
        name="titulo"
        id="titulo"
        placeholder="Digite o título"
        required
    >
    <br>

    <label for="ano">Ano:</label>
    <input
        type="number"
        name="ano"
        id="ano"
        placeholder="Digite o ano"
        min="1800"
        max="2100"
        step="1"
        required
    >
    <br>

    <label for="minutos">Duração:</label>
    <input
        type="number"
        name="minutos"
        id="minutos"
        placeholder="Digite o tempo em minutos"
        min="1"
        max="600"
        step="1"
        required
    >
    <br>

    <label for="resumo">Resumo:</label>
    <textarea
        name="resumo"
        id="resumo"
        placeholder="Digite o resumo"
        required
    ></textarea>
    <br>

    <button type="submit">Cadastrar</button>
</form>

<?php require_once 'footer.php'; ?>