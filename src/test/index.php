<?php

echo "ok";

// HTML é o esqueleto de uma página
// CSS é o enfeite
// JavaScript é a funcionalidade, é vc dar vida

// ---------------------prod-----------/
//          \-------hml               /
//              \--------dev---------/

// merge => junção
// versionamento por ramificação ou branch
// git checkout -b <nome-da-branch>

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $_POST["campo"];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <p>Isso é um parágrafo</p>
    <form method="post">
        <input type="text" name="campo">
        <button type="submit">Enviar</button>
    </form>





    
</body>
</html>