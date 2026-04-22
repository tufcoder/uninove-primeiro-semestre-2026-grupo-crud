<?php

require_once 'sessao.php';
require_once 'db/mysql.php';
require_once 'header.php';

$filmes = $pdo
    ->query('SELECT * FROM filmes ORDER BY titulo;')
    ->fetchAll();

if (count($filmes) === 0) {
    echo '<p>Nenhum filme encontrado. Clique em "Criar" para adicionar um novo filme.</p>';
    exit;
}
?>

<h1>Listar</h1>

<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Ano</th>
            <th>Duração (min)</th>
            <th>Resumo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filmes as $filme): ?>
        <tr>
            <td><?= htmlspecialchars($filme['titulo']); ?></td>
            <td><?= htmlspecialchars($filme['ano']); ?></td>
            <td><?= htmlspecialchars($filme['minutos']); ?></td>
            <td><?= htmlspecialchars($filme['resumo']); ?></td>
            <td>
                <form
                    action="atualizar.php"
                    method="get"
                    style="display:inline;"
                >
                    <button
                        type="submit"
                        name="id"
                        value="<?= $filme['id']; ?>"
                    >
                        Atualizar
                    </button>
                </form>
                <form
                    action="deletar.php"
                    method="post"
                    style="display:inline;"
                    onsubmit="return confirm('Tem certeza que deseja deletar este filme?');"
                >
                    <button
                        type="submit"
                        name="id"
                        value="<?= $filme['id']; ?>"
                    >
                        Deletar
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'footer.php'; ?>