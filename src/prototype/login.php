<?php

require_once 'db/mysql.php';

$error = null;

session_start();

if (isset($_SESSION['user'])) {
  header('Location: listar.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    try {
        $statement = $pdo->prepare('SELECT * FROM usuarios WHERE login = ?;');
        $statement->execute([$login]);

        if ($statement) {
            $usuario = $statement->fetch();

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['user'] = [
                    'id' => $usuario['id'],
                    'login' => $usuario['login'],
                ];

                header('Location: listar.php');
                exit;
            } else {
                $error = 'Login ou senha inválidos.';
            }
        }
    } catch (Exception $e) {
       $error = 'Erro no banco de dados.';
    }
}

?>

<style>
    /*
        o login é um caso a parte, não tem o header
        por isso ele precisa de um css próprio
    */
    .error {
        color: red;
        font-weight: bold;
    }

    form {
        max-width: 300px;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
</style>

<h1>Login</h1>

<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" placeholder="Digite seu login" required>
    <br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
    <br>

    <button type="submit">Entrar</button>
</form>