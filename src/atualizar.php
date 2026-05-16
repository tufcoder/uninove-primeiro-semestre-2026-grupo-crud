<?php

require_once 'sessao.php';
require_once 'db/mysql.php';
require_once 'validacao.php';

$error = null;
$titulo = null;
$ano = null;
$minutos = null;
$resumo = null;
$id = $_GET['id'] ?? 0;
$method = $_SERVER['REQUEST_METHOD'];

if ($id === 0) {
    header('Location: index.php');
    exit;
}

if ($method === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $minutos = $_POST['minutos'];
    $resumo = $_POST['resumo'];
    $id_usuario = $_SESSION['user']['id'];

    $campos = [
        'Titulo' => $titulo,
        'Ano' => $ano,
        'Minutos' => $minutos,
        'Resumo' => $resumo
    ];
    
    $error = validarDadosPost($campos);

    if (!$error) {
        try {
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
    
            if ($statement) {
                header('Location: index.php');
                exit;
            } else {
                $error = "Erro ao atualizar dados no banco.";
            }
        } catch (Exception $e) {
            $error = "Revise a instrução ou procure erros no banco de dados.";
        }
    }
}

require_once 'header.php';

$filme = null;
$tituloDB = null;
$anoDB = null;
$minutosDB = null;
$resumoDB = null;

try {
    $statement = $pdo->prepare('SELECT * FROM filmes WHERE id = ?;');
    $statement->execute([$id]);

    if ($statement->rowCount() > 0) {
        $filme = $statement->fetch();

        $tituloDB = htmlspecialchars($filme['titulo']);
        $anoDB = htmlspecialchars($filme['ano']);
        $minutosDB = htmlspecialchars($filme['minutos']);
        $resumoDB = htmlspecialchars($filme['resumo']);
    } else {
        echo "<p class='error'>Erro ao recuperar filme no banco de dados para o id: $id.</p>";
        require_once 'footer.php';
        exit;
    }
} catch (Exception $e) {
    $error = "Revise a instrução ou procure erros no banco de dados.";
}

?>

<h1>Atualizar</h1>

<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <label for="titulo">Título:</label>
    <input
        type="text"
        name="titulo"
        id="titulo"
        placeholder="Digite o título"
        value="<?= $method === 'POST' ? $titulo : $tituloDB  ?>"
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
        value="<?= $method === 'POST' ? $ano : $anoDB  ?>"
        required
    >
    <br>

    <label for="minutos">Duração (em Minutos):</label>
    <input
        type="number"
        name="minutos"
        id="minutos"
        placeholder="Digite o tempo em minutos"
        min="1"
        max="600"
        step="1"
        value="<?= $method === 'POST' ? $minutos : $minutosDB  ?>"
        required
    >
    <br>

    <label for="resumo">Resumo:</label>
    <textarea
        name="resumo"
        id="resumo"
        placeholder="Digite o resumo"
        required
    ><?= $method === 'POST' ? $resumo : $resumoDB ?></textarea>
    <br>

    <button type="submit">Atualizar</button>
</form>

<?php require_once 'footer.php'; ?>