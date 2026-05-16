<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="menu">
        <?php require_once 'nav.php'; ?>
        <p>Olá, <strong class="upper"><?= $_SESSION['user']['login'] ?></strong></p>
    </div>    