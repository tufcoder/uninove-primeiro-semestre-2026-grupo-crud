<?php

require_once 'sessao.php';
require_once 'db/mysql.php';
require_once 'validacao.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $error = validarCampoPost($id);

    if (!$error) {
        try {
            $statement = $pdo->prepare('DELETE FROM filmes WHERE id = ?;');
            $statement->execute([$id]);

            if ($statement) {
                header('Location: index.php'); // redirect = redirecionamento
                exit;
            } else {
                $error = "Erro ao deletar dados no banco.";
            }
        } catch (Exception $e) {
            $error = "Revise a instrução ou procure erros no banco de dados.";
        }
    }
}

require_once 'header.php';

?>

<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<?php require_once 'footer.php'; ?>