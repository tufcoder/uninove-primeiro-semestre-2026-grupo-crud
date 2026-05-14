<?php

require_once 'sessao.php';
require_once 'db/mysql.php';

$id = $_GET['id'] ?? 0;

if ($id === 0) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $minutos = $_POST['minutos'];
    $resumo = $_POST['resumo'];
    $id_usuario = $_SESSION['user']['id'];

    $statement = $pdo->prepare('
        UPDATE filmes
        SET titulo = ?,
            ano = ?,
            minutos = ?,
            resumo = ?,
            id_usuario = ?
        WHERE id = ?;
    ');
    $statement->execute([$titulo, $ano, $minutos, $resumo, $id_usuario, $id]);

    header('Location: index.php');
    exit;
}

require_once 'header.php';

$statement = $pdo->prepare('SELECT * FROM filmes WHERE id = ?;');
$statement->execute([$id]);

if ($statement->rowCount() === 0) {
    echo '<p>Filme não encontrado.</p>';
    exit;
}

$filme = $statement->fetch();

?>

<h1>Atualizar</h1>

<form method="post">
    <label for="titulo">Título:</label>
    <input
        type="text"
        name="titulo"
        id="titulo"
        placeholder="Digite o título"
        required
        value="<?= htmlspecialchars($filme['titulo']); ?>"
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
        value="<?= htmlspecialchars($filme['ano']); ?>"
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
        value="<?= htmlspecialchars($filme['minutos']); ?>"
    >
    <br>

    <label for="resumo">Resumo:</label>
    <textarea
        name="resumo"
        id="resumo"
        placeholder="Digite o resumo"
        required
    ><?= htmlspecialchars($filme['resumo']); ?></textarea>
    <br>

    <button type="submit">Atualizar</button>
</form>

<?php require_once 'footer.php'; ?>