<?php

require_once 'sessao.php';
require_once 'db/mysql.php';
require_once 'validacao.php';

$error = null;
$titulo = null;
$ano = null;
$minutos = null;
$resumo = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                INSERT INTO filmes
                    (titulo, ano, minutos, resumo, id_usuario)
                VALUES
                    (?, ?, ?, ?, ?);
            ');
            $statement->execute([$titulo, $ano, $minutos, $resumo, $id_usuario]);

            if ($statement) {
                header('Location: index.php');
                exit;
            } else {
                $error = "Erro ao inserir dados no banco.";
            }
        } catch (Exception $e) {
            $error = "Revise a instrução ou procure erros no banco de dados.";
        }
    }
}

require_once 'header.php';

?>

<h1>Criar</h1>

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
        value="<?= $titulo ?>"
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
        value="<?= $ano ?>"
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
        value="<?= $minutos ?>"
        required
    >
    <br>

    <label for="resumo">Resumo:</label>
    <textarea
        name="resumo"
        id="resumo"
        placeholder="Digite o resumo"
        required
    ><?= $resumo ?></textarea>
    <br>

    <button type="submit">Cadastrar</button>
</form>

<?php require_once 'footer.php'; ?>